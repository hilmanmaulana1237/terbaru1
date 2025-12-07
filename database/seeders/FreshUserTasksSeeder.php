<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\UserTask;

class FreshUserTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing user tasks
        UserTask::truncate();

        $user = User::where('email', 'test@gmail.com')->first();

        if (!$user) {
            $this->command->error('Test user not found!');
            return;
        }

        $tasks = Task::limit(15)->get();

        if ($tasks->isEmpty()) {
            $this->command->error('No tasks found!');
            return;
        }

        // Don't create any "taken" tasks - users should take tasks themselves
        // This prevents auto-redirect on dashboard

        // Create 3 pending verification 1 (already submitted, waiting for admin)
        foreach ($tasks->take(3) as $task) {
            UserTask::factory()->pendingVerification()->create([
                'task_id' => $task->id,
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('Created 3 pending verification 1 tasks');

        // Create 2 completed tasks
        foreach ($tasks->skip(3)->take(2) as $task) {
            UserTask::factory()->completed()->create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'payment_verified_by_admin_id' => User::where('role', 'admin')->first()->id,
            ]);
        }

        $this->command->info('Created 2 completed tasks');
        $this->command->info('Total: 5 user tasks created successfully!');
        $this->command->info('Users can now freely take tasks from dashboard.');
    }
}
