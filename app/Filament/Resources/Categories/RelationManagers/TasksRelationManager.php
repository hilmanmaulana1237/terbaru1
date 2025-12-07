<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use App\Models\Task;
use App\Models\UserTask;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';
    protected static ?string $recordTitleAttribute = 'title';

    // ⬇️ v4: Schema, bukan Form - Synced with TaskForm.php
    public function form(Schema $schema): Schema
    {
        $isLocked = fn(?Task $record) => $record?->isTaken() === true;

        return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255)
                ->disabled($isLocked)
                ->columnSpanFull(),

            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required()
                ->rows(3)
                ->disabled($isLocked)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('whatsapp_group_link')
                ->label('Whatsapp group link')
                ->required()
                ->url()
                ->maxLength(2048)
                ->disabled($isLocked),

            Forms\Components\Select::make('difficulty_level')
                ->label('Difficulty level')
                ->options(Task::DIFFICULTIES)
                ->required()
                ->default('easy')
                ->disabled($isLocked),

            Forms\Components\TextInput::make('estimated_amount')
                ->label('Estimasi Nominal (Rp)')
                ->numeric()
                ->prefix('Rp')
                ->placeholder('Contoh: 50000')
                ->helperText('Perkiraan bayaran untuk task ini. User akan melihat nominal ini.')
                ->disabled($isLocked)
                ->columnSpanFull(),

            Forms\Components\DateTimePicker::make('expired_at')
                ->label('Expired at')
                ->required()
                ->seconds(false)
                ->native(false)
                ->disabled($isLocked),

            Forms\Components\Toggle::make('is_expired')
                ->label('Is expired')
                ->required()
                ->inline(false)
                ->disabled($isLocked),

            Forms\Components\TextInput::make('priority_order')
                ->label('Priority order')
                ->required()
                ->numeric()
                ->default(0)
                ->disabled($isLocked),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('priority_order')
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('estimated_amount')
                    ->label('Est. Nominal')
                    ->money('IDR', true)
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('difficulty_level')
                    ->label('Kesulitan')
                    ->badge()
                    ->formatStateUsing(fn($state) => Task::DIFFICULTIES[$state] ?? $state)
                    ->color(fn(Task $r) => $r->getDifficultyBadgeColorAttribute()),
                Tables\Columns\IconColumn::make('is_expired')->label('Expired?')->boolean(),
                Tables\Columns\TextColumn::make('expired_at')->label('Expired At')->dateTime('d M Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('priority_order')->label('Prioritas')->sortable(),
                Tables\Columns\TextColumn::make('activeUserTask.count')->label('Active Taken')->counts('activeUserTask'),
            ])
            ->filters([
                Tables\Filters\Filter::make('available')->label('Hanya Available')->query(fn(Builder $q) => $q->available()),
                Tables\Filters\TernaryFilter::make('expired')->label('Status Expired')->trueLabel('Sudah')->falseLabel('Belum')
                    ->queries(
                        true: fn(Builder $q) => $q->expired(),
                        false: fn(Builder $q) => $q->active(),
                        blank: fn(Builder $q) => $q
                    ),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah Task')
                    ->mutateFormDataUsing(function (array $data): array {
                        // Pastikan admin_id selalu terisi dengan user yang sedang login
                        $currentUserId = Auth::id();

                        if (!$currentUserId) {
                            // Jika tidak ada user yang login, ambil admin pertama dari database
                            $adminUser = \App\Models\User::whereIn('role', ['admin', 'superadmin'])->first();
                            $currentUserId = $adminUser?->id ?? 1;
                        }

                        $data['admin_id'] = $currentUserId;
                        $data['expired_at'] = $data['expired_at'] ?? now()->addDays(3);
                        return $data;
                    })
                    ->after(fn() => $this->js('window.location.reload()')),
                
                // Import CSV Action
                Action::make('import_csv')
                    ->label('📥 Import CSV')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('success')
                    ->form([
                        FileUpload::make('csv_file')
                            ->label('File CSV')
                            ->acceptedFileTypes(['text/csv', 'application/vnd.ms-excel', 'text/plain', '.csv'])
                            ->required()
                            ->disk('local')
                            ->directory('csv-imports')
                            ->visibility('private')
                            ->helperText('Format: title,description,whatsapp_group_link,difficulty_level,estimated_amount,expired_at,priority_order'),
                    ])
                    ->action(function (array $data): void {
                        $categoryId = $this->getOwnerRecord()->id;
                        $currentUserId = Auth::id();

                        if (!$currentUserId) {
                            $adminUser = \App\Models\User::whereIn('role', ['admin', 'superadmin'])->first();
                            $currentUserId = $adminUser?->id ?? 1;
                        }

                        // Handle file path - FileUpload returns path string or array
                        $filePath = $data['csv_file'];
                        if (is_array($filePath)) {
                            $filePath = reset($filePath); // Get first file if array
                        }
                        
                        // Try to get full path from local disk
                        $fullPath = Storage::disk('local')->path($filePath);
                        
                        if (!file_exists($fullPath)) {
                            // Try public disk as fallback
                            $fullPath = Storage::disk('public')->path($filePath);
                        }
                        
                        if (!file_exists($fullPath)) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('Path: ' . $filePath)
                                ->danger()
                                ->send();
                            return;
                        }

                        $handle = fopen($fullPath, 'r');
                        $header = fgetcsv($handle); // Skip header row
                        
                        $successCount = 0;
                        $errorCount = 0;
                        $errors = [];

                        while (($row = fgetcsv($handle)) !== false) {
                            try {
                                // Map CSV columns to database fields
                                // Expected columns: title,description,whatsapp_group_link,difficulty_level,estimated_amount,expired_at,priority_order
                                if (count($row) < 4) {
                                    $errorCount++;
                                    $errors[] = "Row skipped: insufficient columns";
                                    continue;
                                }

                                $taskData = [
                                    'category_id' => $categoryId,
                                    'admin_id' => $currentUserId,
                                    'created_by' => $currentUserId,
                                    'title' => $row[0] ?? '',
                                    'description' => $row[1] ?? '',
                                    'whatsapp_group_link' => $row[2] ?? '',
                                    'difficulty_level' => $row[3] ?? 'easy',
                                    'estimated_amount' => !empty($row[4]) ? (float)$row[4] : null,
                                    'expired_at' => !empty($row[5]) ? \Carbon\Carbon::parse($row[5]) : now()->addDays(3),
                                    'priority_order' => !empty($row[6]) ? (int)$row[6] : 0,
                                    'is_expired' => false,
                                ];

                                // Validate required fields
                                if (empty($taskData['title']) || empty($taskData['description']) || empty($taskData['whatsapp_group_link'])) {
                                    $errorCount++;
                                    $errors[] = "Row skipped: missing required fields (title, description, or whatsapp_group_link)";
                                    continue;
                                }

                                Task::create($taskData);
                                $successCount++;
                            } catch (\Exception $e) {
                                $errorCount++;
                                $errors[] = "Error: " . $e->getMessage();
                            }
                        }

                        fclose($handle);

                        // Delete uploaded file after processing
                        Storage::disk('local')->delete($filePath);

                        if ($successCount > 0) {
                            Notification::make()
                                ->title('Import Berhasil')
                                ->body("$successCount task berhasil diimport" . ($errorCount > 0 ? ", $errorCount gagal" : ""))
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Import Gagal')
                                ->body("Tidak ada task yang berhasil diimport. " . implode('; ', array_slice($errors, 0, 3)))
                                ->danger()
                                ->send();
                        }
                    })
                    ->modalHeading('Import Tasks dari CSV')
                    ->modalDescription('Upload file CSV dengan format yang sesuai. Lihat contoh di folder public/sample_tasks.csv'),
            ])
            ->actions([
                EditAction::make()
                    ->visible(fn(Task $r) => $r->canBeEdited())
                    ->mutateFormDataUsing(function (array $data): array {
                        // Pastikan admin_id tetap terisi saat edit
                        if (!isset($data['admin_id']) || !$data['admin_id']) {
                            $currentUserId = Auth::id();

                            if (!$currentUserId) {
                                $adminUser = \App\Models\User::whereIn('role', ['admin', 'superadmin'])->first();
                                $currentUserId = $adminUser?->id ?? 1;
                            }

                            $data['admin_id'] = $currentUserId;
                        }
                        return $data;
                    }),
                DeleteAction::make()->requiresConfirmation()->visible(fn(Task $r) => !$r->isTaken()),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->visible(fn($records) => collect($records)->every(fn(Task $t) => !$t->isTaken())),
            ]);
    }
}
