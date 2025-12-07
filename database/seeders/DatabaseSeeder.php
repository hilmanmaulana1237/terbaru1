<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create superadmin (full access to all resources)
        $superadmin = \App\Models\User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'role' => 'superadmin',
                'badge' => 'premium_admin',
                'password' => bcrypt('password'),
                'phone' => '081234567890',
                'whatsapp' => '6281234567890',
                'email_verified_at' => now(),
            ]
        );

        // Create regular admin 1 (limited access - can only manage their own tasks/categories)
        $admin1 = \App\Models\User::updateOrCreate(
            ['email' => 'admin1@gmail.com'],
            [
                'name' => 'Admin Satu',
                'role' => 'admin',
                'badge' => 'premium_admin', // Premium admin for VIP priority
                'password' => bcrypt('password'),
                'phone' => '081111222333',
                'whatsapp' => '6281111222333',
                'email_verified_at' => now(),
            ]
        );

        // Create regular admin 2 (limited access - can only manage their own tasks/categories)
        $admin2 = \App\Models\User::updateOrCreate(
            ['email' => 'admin2@gmail.com'],
            [
                'name' => 'Admin Dua',
                'role' => 'admin',
                'badge' => 'senior',
                'password' => bcrypt('password'),
                'phone' => '082222333444',
                'whatsapp' => '6282222333444',
                'email_verified_at' => now(),
            ]
        );

        $user = \App\Models\User::updateOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'name' => 'Test User',
                'role' => 'user',
                'password' => bcrypt('password'),
                'phone' => '083333444555',
                'whatsapp' => '6283333444555',
                'email_verified_at' => now(),
            ]
        );

        // Create WhatsApp-related categories
        // Categories created by different admins to test permissions
        $categories = [
            [
                'name' => 'WhatsApp Community',
                'description' => 'Ajak orang untuk bergabung ke grup WhatsApp komunitas. Setiap orang yang berhasil join akan mendapat reward.',
                'created_by' => $admin1->id, // Created by Admin 1
            ],
            [
                'name' => 'WhatsApp Business',
                'description' => 'Promosikan grup WhatsApp bisnis dan dapatkan komisi untuk setiap member baru yang join.',
                'created_by' => $admin2->id, // Created by Admin 2
            ],
            [
                'name' => 'WhatsApp Marketing',
                'description' => 'Bantu tingkatkan member grup WhatsApp untuk keperluan marketing dan promosi produk.',
                'created_by' => $superadmin->id, // Created by Superadmin
            ],
        ];

        $createdCategories = collect();
        foreach ($categories as $categoryData) {
            $createdCategories->push(\App\Models\Category::factory()->create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'created_by' => $categoryData['created_by'],
                'is_active' => true,
                'expired_at' => now()->addMonths(2),
            ]));
        }

        // Create WhatsApp group invitation tasks
        // Tasks are distributed among different admins to test permissions
        $whatsappTasks = [
            // Community groups - created by Admin 1
            [
                'category_id' => $createdCategories[0]->id,
                'admin_id' => $admin1->id,
                'created_by' => $admin1->id,
                'title' => 'Komunitas Freelancer Indonesia',
                'description' => "Ajak minimal 5 orang untuk join ke grup WhatsApp Komunitas Freelancer Indonesia.\n\nSyarat:\n- Screenshot bukti 5 orang yang berhasil join\n- Konfirmasi dari member baru di grup\n- Member harus aktif minimal 3 hari",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_EASY,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/ABC123XYZ',
                'estimated_amount' => 15000,
            ],
            [
                'category_id' => $createdCategories[0]->id,
                'admin_id' => $admin1->id,
                'created_by' => $admin1->id,
                'title' => 'Grup Belajar Digital Marketing',
                'description' => "Undang 10 orang untuk bergabung ke grup belajar digital marketing.\n\nTarget:\n- 10 member baru\n- Upload screenshot daftar member\n- Pastikan mereka mengisi form registrasi",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_MEDIUM,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/DEF456UVW',
                'estimated_amount' => 25000,
            ],
            [
                'category_id' => $createdCategories[0]->id,
                'admin_id' => $admin1->id,
                'created_by' => $admin1->id,
                'title' => 'Komunitas Pengusaha Muda',
                'description' => "Rekrut 15 pengusaha muda untuk join grup diskusi bisnis.\n\nKriteria:\n- Minimal 15 member\n- Usia 18-35 tahun\n- Punya usaha/bisnis\n- Upload bukti chat perkenalan mereka",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_HARD,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/GHI789RST',
                'estimated_amount' => 35000,
            ],

            // Business groups - created by Admin 2
            [
                'category_id' => $createdCategories[1]->id,
                'admin_id' => $admin2->id,
                'created_by' => $admin2->id,
                'title' => 'Reseller Produk Fashion',
                'description' => "Cari reseller untuk bergabung di grup bisnis fashion.\n\nTarget:\n- 8 reseller baru\n- Screenshot konfirmasi join\n- Data kontak reseller",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_MEDIUM,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/JKL012MNO',
                'estimated_amount' => 20000,
            ],
            [
                'category_id' => $createdCategories[1]->id,
                'admin_id' => $admin2->id,
                'created_by' => $admin2->id,
                'title' => 'Supplier & Dropshipper Network',
                'description' => "Undang supplier dan dropshipper ke grup network bisnis online.\n\nRequirement:\n- Minimal 12 member\n- Verifikasi usaha mereka\n- Screenshot bukti join grup",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_HARD,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/PQR345STU',
                'estimated_amount' => 30000,
            ],

            // Marketing groups - created by Superadmin
            [
                'category_id' => $createdCategories[2]->id,
                'admin_id' => $superadmin->id,
                'created_by' => $superadmin->id,
                'title' => 'Tim Marketing & Sales',
                'description' => "Rekrut tim marketing untuk join grup koordinasi sales.\n\nDetail:\n- 6 member baru\n- Pengalaman marketing/sales\n- Upload CV singkat\n- Konfirmasi join grup",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_EASY,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/VWX678YZA',
                'estimated_amount' => 10000,
            ],
            [
                'category_id' => $createdCategories[2]->id,
                'admin_id' => $superadmin->id,
                'created_by' => $superadmin->id,
                'title' => 'Affiliate Marketing Group',
                'description' => "Ajak affiliate marketer join grup untuk belajar strategi marketing.\n\nTarget:\n- 10 affiliate marketer\n- Screenshot profile mereka\n- Bukti join grup",
                'difficulty_level' => \App\Models\Task::DIFFICULTY_MEDIUM,
                'whatsapp_group_link' => 'https://chat.whatsapp.com/BCD901EFG',
                'estimated_amount' => 20000,
            ],
        ];

        $tasks = collect();
        foreach ($whatsappTasks as $taskData) {
            $tasks->push(\App\Models\Task::factory()->create([
                'category_id' => $taskData['category_id'],
                'admin_id' => $taskData['admin_id'],
                'created_by' => $taskData['created_by'],
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'vcf_data' => "BEGIN:VCARD\nVERSION:3.0\nN:Doe;John;;;\nFN:John Doe\nORG:Example Corp\nTEL:123456789\nEND:VCARD",
                'difficulty_level' => $taskData['difficulty_level'],
                'whatsapp_group_link' => $taskData['whatsapp_group_link'],
                'estimated_amount' => $taskData['estimated_amount'],
                'expired_at' => now()->addWeeks(3),
                'is_expired' => false,
                'priority_order' => $tasks->count() + 1,
            ]));
        }

        // Create some additional random tasks for each admin
        $admins = [$admin1, $admin2, $superadmin];
        foreach ($createdCategories as $index => $category) {
            $admin = $admins[$index % count($admins)];
            for ($i = 0; $i < 3; $i++) {
                // Nominal bulat antara 10rb - 30rb
                $estimatedAmounts = [10000, 15000, 20000, 25000, 30000];
                $tasks->push(\App\Models\Task::factory()->create([
                    'category_id' => $category->id,
                    'admin_id' => $admin->id,
                    'created_by' => $admin->id,
                    'title' => 'Grup WhatsApp ' . fake()->words(3, true),
                    'description' => "Ajak orang untuk join grup WhatsApp ini.\n\nSyarat:\n- Minimal " . rand(5, 15) . " orang\n- Screenshot bukti join\n- Member aktif minimal 2 hari",
                    'vcf_data' => "BEGIN:VCARD\nVERSION:3.0\nN:Smith;Jane;;;\nFN:Jane Smith\nORG:Random Inc\nTEL:987654321\nEND:VCARD",
                    'whatsapp_group_link' => 'https://chat.whatsapp.com/' . strtoupper(fake()->bothify('???###???')),
                    'estimated_amount' => $estimatedAmounts[array_rand($estimatedAmounts)],
                ]));
            }
        }

        // Don't create any tasks in "taken" status - let users take tasks themselves
        // This prevents the redirect issue on dashboard

        // Create some completed user tasks for history
        foreach ($tasks->skip(0)->take(3) as $task) {
            \App\Models\UserTask::factory()->completed()->create([
                'task_id' => $task->id,
                'user_id' => $user->id,
                'payment_verified_by_admin_id' => $superadmin->id,
            ]);
        }

        // Create some pending verification user tasks (already submitted, waiting for admin)
        foreach ($tasks->skip(3)->take(2) as $task) {
            \App\Models\UserTask::factory()->pendingVerification()->create([
                'task_id' => $task->id,
                'user_id' => $user->id,
            ]);
        }

        // Output summary for testing
        echo "\n=== SEEDER COMPLETED ===\n";
        echo "Superadmin: superadmin@gmail.com (password: password) - Full access\n";
        echo "Admin 1: admin1@gmail.com (password: password) - Limited to own tasks/categories\n";
        echo "Admin 2: admin2@gmail.com (password: password) - Limited to own tasks/categories\n";
        echo "User: test@gmail.com (password: password) - Regular user\n";
        echo "\nPermission Test:\n";
        echo "- Admin 1 created: Category 'WhatsApp Community' + 3 tasks\n";
        echo "- Admin 2 created: Category 'WhatsApp Business' + 2 tasks\n";
        echo "- Superadmin created: Category 'WhatsApp Marketing' + 2 tasks\n";
        echo "========================\n";
    }
}
