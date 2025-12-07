<div class="min-h-screen bg-gradient-to-br from-white-50 via-white to-white dark:from-zinc-800 dark:via-zinc-800 dark:to-zinc-800" x-data="{ 
    activeTab: 'overview'
}">
    <div class="flex h-full w-full flex-1 flex-col gap-6 p-4 md:p-6">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-zinc-900 dark:text-white flex items-center gap-3">Dashboard Tugas</h1>
                    <p class="text-zinc-600 dark:text-zinc-400 mt-1">Pantau progres tugas dan penghasilan Anda</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button @click="activeTab = 'overview'" 
                        class="px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
                        :class="activeTab === 'overview' ? 'bg-green-600 text-white shadow-lg' : 'bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-green-50 dark:hover:bg-zinc-700'">
                        Ringkasan
                    </button>
                    <button @click="activeTab = 'analytics'" 
                        class="px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
                        :class="activeTab === 'analytics' ? 'bg-green-600 text-white shadow-lg' : 'bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-green-50 dark:hover:bg-zinc-700'">
                        Analitik
                    </button>
                </div>
            </div>
            
            <!-- Call to Action Banner -->
            <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-700 dark:from-green-900 dark:via-green-800 dark:to-emerald-900 rounded-2xl p-6 shadow-xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-emerald-400/10 rounded-full -ml-24 -mb-24 blur-3xl"></div>
                
                <div class="relative flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold text-white mb-1">Ada <?php echo e($stats['available_tasks']); ?> Tugas Baru Menunggu!</h3>
                            <p class="text-green-100 text-sm md:text-base">Ambil tugas sekarang dan mulai hasilkan uang 💰</p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="flex-shrink-0 inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-green-50 text-green-700 font-bold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group">
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Ambil Tugas Sekarang
                    </a>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Total Tasks Card -->
                <div class="relative overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full -mr-12 -mt-12 group-hover:bg-blue-500/20 transition-colors duration-300"></div>
                    <div class="flex items-start justify-between relative">
                        <div>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-1 text-sm">Total Tugas</p>
                            <h3 class="text-3xl font-bold text-blue-600 dark:text-blue-400" x-data="{ count: 0 }" x-init="setTimeout(() => { let target = <?php echo e($stats['total_tasks']); ?>; let increment = target / 50; let timer = setInterval(() => { count += increment; if (count >= target) { count = target; clearInterval(timer); } }, 20); }, 100)">
                                <span x-text="Math.floor(count)">0</span>
                            </h3>
                            <div class="flex items-center mt-2">
                                <span class="text-zinc-600 dark:text-zinc-400 text-xs">Sepanjang waktu</span>
                            </div>
                        </div>
                        <div class="bg-blue-500/20 p-3 rounded-lg group-hover:bg-blue-500/30 transition-colors duration-300">
                            <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- In Progress Card -->
                <div class="relative overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-500/10 rounded-full -mr-12 -mt-12 group-hover:bg-orange-500/20 transition-colors duration-300"></div>
                    <div class="flex items-start justify-between relative">
                        <div>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-1 text-sm">Dikerjakan</p>
                            <h3 class="text-3xl font-bold text-orange-600 dark:text-orange-400" x-data="{ count: 0 }" x-init="setTimeout(() => { let target = <?php echo e($stats['in_progress']); ?>; let increment = target / 50; let timer = setInterval(() => { count += increment; if (count >= target) { count = target; clearInterval(timer); } }, 20); }, 200)">
                                <span x-text="Math.floor(count)">0</span>
                            </h3>
                            <div class="flex items-center mt-2">
                                <a href="<?php echo e(route('user.history')); ?>?filter=my_tasks" class="text-green-600 dark:text-green-400 text-xs hover:underline">
                                    Lihat Tugas →
                                </a>
                            </div>
                        </div>
                        <div class="bg-orange-500/20 p-3 rounded-lg group-hover:bg-orange-500/30 transition-colors duration-300">
                            <svg class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Completed Tasks Card -->
                <div class="relative overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-green-500/10 rounded-full -mr-12 -mt-12 group-hover:bg-green-500/20 transition-colors duration-300"></div>
                    <div class="flex items-start justify-between relative">
                        <div>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-1 text-sm">Selesai</p>
                            <h3 class="text-3xl font-bold text-green-600 dark:text-green-400" x-data="{ count: 0 }" x-init="setTimeout(() => { let target = <?php echo e($stats['completed']); ?>; let increment = target / 50; let timer = setInterval(() => { count += increment; if (count >= target) { count = target; clearInterval(timer); } }, 20); }, 300)">
                                <span x-text="Math.floor(count)">0</span>
                            </h3>
                            <div class="flex items-center mt-2">
                                <a href="<?php echo e(route('user.history')); ?>?filter=completed" class="text-green-600 dark:text-green-400 text-xs hover:underline">
                                    Lihat Selesai →
                                </a>
                            </div>
                        </div>
                        <div class="bg-green-500/20 p-3 rounded-lg group-hover:bg-green-500/30 transition-colors duration-300">
                            <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Total Earnings Card -->
                <div class="relative overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-full -mr-12 -mt-12 group-hover:bg-amber-500/20 transition-colors duration-300"></div>
                    <div class="flex items-start justify-between relative">
                        <div>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-1 text-sm">Total Penghasilan</p>
                            <h3 class="text-3xl font-bold text-amber-600 dark:text-amber-400" x-data="{ amount: 0 }" x-init="setTimeout(() => { let target = <?php echo e($stats['total_earnings']); ?>; let increment = target / 50; let timer = setInterval(() => { amount += increment; if (amount >= target) { amount = target; clearInterval(timer); } }, 20); }, 400)">
                                Rp <span x-text="Math.floor(amount).toLocaleString('id-ID')">0</span>
                            </h3>
                            <div class="flex items-center mt-2">
                                <!--[if BLOCK]><![endif]--><?php if($stats['pending_payment'] > 0): ?>
                                    <span class="text-zinc-600 dark:text-zinc-400 text-xs">
                                        +Rp <?php echo e(number_format($stats['pending_payment'], 0, ',', '.')); ?> menunggu
                                    </span>
                                <?php else: ?>
                                    <span class="text-zinc-600 dark:text-zinc-400 text-xs">Sudah dibayar</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="bg-amber-500/20 p-3 rounded-lg group-hover:bg-amber-500/30 transition-colors duration-300">
                            <svg class="h-8 w-8 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="relative flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-4 md:p-6">
                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" class="h-full">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                        <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Aktivitas Mingguan</h2>
                        <div class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            7 hari terakhir
                        </div>
                    </div>
                    
                    <!-- Weekly Chart -->
                    <div class="h-64 bg-zinc-50 dark:bg-zinc-900/30 rounded-xl p-4 mb-6">
                        <div class="flex items-end h-full gap-2 md:gap-3">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $weeklyActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $maxCount = max(array_column($weeklyActivity, 'count'));
                                    $height = $maxCount > 0 ? ($day['count'] / $maxCount) * 100 : 0;
                                ?>
                                <div class="flex-1 flex flex-col items-center group" x-data="{ animated: false }" x-intersect="animated = true">
                                    <div class="w-full relative h-48">
                                        <div class="w-full absolute bottom-0 rounded-t-lg transition-all duration-1000 ease-out <?php echo e($day['count'] > 0 ? 'bg-gradient-to-t from-green-500 to-green-600' : 'bg-zinc-200 dark:bg-zinc-700'); ?>"
                                             :style="animated ? 'height: <?php echo e(number_format($height, 2)); ?>%' : 'height: 0%'">
                                        </div>
                                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 px-2 py-1 rounded text-xs whitespace-nowrap">
                                            <?php echo e($day['count']); ?> tugas
                                        </div>
                                    </div>
                                    <span class="text-xs text-zinc-600 dark:text-zinc-400 mt-2"><?php echo e($day['day']); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    
                    <!-- Recent Tasks -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Tugas Terbaru</h3>
                        <a href="<?php echo e(route('user.history')); ?>" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $recentTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-900/30 rounded-lg transition-all duration-300 hover:bg-zinc-100 dark:hover:bg-zinc-900/50 hover:shadow-md">
                                <div class="flex items-center gap-4 flex-1 min-w-0">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                        <?php echo e(strtoupper(substr($userTask->task->category->name ?? 'T', 0, 2))); ?>

                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-medium text-zinc-900 dark:text-white truncate"><?php echo e($userTask->task->title); ?></h4>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                            <?php echo e($userTask->created_at->diffForHumans()); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                               <?php if($userTask->status === 'taken'): ?> bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                               <?php elseif($userTask->status === 'pending_verification_1' || $userTask->status === 'pending_verification_2'): ?> bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400
                                               <?php elseif($userTask->status === 'completed'): ?> bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                               <?php elseif($userTask->status === 'failed'): ?> bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                               <?php else: ?> bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400 <?php endif; ?>">
                                        <?php echo e(\App\Models\UserTask::STATUSES[$userTask->status]); ?>

                                    </span>
                                    <!--[if BLOCK]><![endif]--><?php if($userTask->isOverdue()): ?>
                                        <span class="inline-flex items-center gap-2 px-2 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-xs font-semibold">❌ Gagal (Kadaluarsa)</span>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('user.task.work', $userTask->task_id)); ?>" class="text-zinc-600 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-12">
                                <div class="w-24 h-24 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Belum ada tugas</h3>
                                <p class="text-zinc-600 dark:text-zinc-400 mb-4">Mulai ambil tugas untuk melihatnya di sini</p>
                                <a href="<?php echo e(route('user.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                                    Jelajahi Tugas Tersedia
                                </a>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
                
                <!-- Analytics Tab -->
                <div x-show="activeTab === 'analytics'" class="h-full">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Analitik Kinerja</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Task Completion Rate -->
                        <div class="bg-zinc-50 dark:bg-zinc-900/30 rounded-xl p-5 border border-zinc-200 dark:border-zinc-700 transition-all duration-300 hover:shadow-md">
                            <h3 class="font-semibold text-zinc-900 dark:text-white mb-4">Tingkat Penyelesaian Tugas</h3>
                            <div class="flex items-center justify-center h-48" x-data="{ 
                                completionRate: <?php echo e($stats['total_tasks'] > 0 ? round(($stats['completed'] / $stats['total_tasks']) * 100) : 0); ?>,
                                animated: false,
                                circumference: 440,
                                get offset() {
                                    return this.animated ? this.circumference - (this.completionRate / 100 * this.circumference) : this.circumference;
                                }
                            }" x-intersect="setTimeout(() => animated = true, 100)">
                                <div class="relative w-40 h-40">
                                    <svg class="w-full h-full transform -rotate-90">
                                        <circle cx="80" cy="80" r="70" stroke="currentColor" stroke-width="12" fill="none" class="text-zinc-200 dark:text-zinc-700" />
                                        <circle cx="80" cy="80" r="70" stroke="currentColor" stroke-width="12" fill="none" 
                                                class="text-green-600 dark:text-green-400 transition-all duration-1000 ease-out"
                                                stroke-dasharray="440"
                                                :stroke-dashoffset="offset"
                                                stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-3xl font-bold text-zinc-900 dark:text-white" x-text="completionRate + '%'">0%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    <?php echo e($stats['completed']); ?> dari <?php echo e($stats['total_tasks']); ?> tugas selesai
                                </p>
                            </div>
                        </div>
                        
                        <!-- Payment Status -->
                        <div class="bg-zinc-50 dark:bg-zinc-900/30 rounded-xl p-5 border border-zinc-200 dark:border-zinc-700 transition-all duration-300 hover:shadow-md">
                            <h3 class="font-semibold text-zinc-900 dark:text-white mb-4">Status Pembayaran</h3>
                            <div class="space-y-4">
                                <div x-data="{ animated: false }" x-intersect="animated = true">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-zinc-700 dark:text-zinc-300">Dibayar</span>
                                        <span class="font-medium text-green-600 dark:text-green-400"><?php echo e($paymentStats['paid']); ?></span>
                                    </div>
                                    <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-1000 ease-out"
                                             :style="animated ? 'width: <?php echo e($stats['completed'] > 0 ? min(100, ($paymentStats['paid'] / $stats['completed']) * 100) : 0); ?>%' : 'width: 0%'"></div>
                                    </div>
                                </div>
                                <div x-data="{ animated: false }" x-intersect="animated = true">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-zinc-700 dark:text-zinc-300">Menunggu</span>
                                        <span class="font-medium text-yellow-600 dark:text-yellow-400"><?php echo e($paymentStats['pending']); ?></span>
                                    </div>
                                    <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-3 rounded-full transition-all duration-1000 ease-out"
                                             :style="animated ? 'width: <?php echo e($stats['completed'] > 0 ? min(100, ($paymentStats['pending'] / $stats['completed']) * 100) : 0); ?>%' : 'width: 0%'"></div>
                                    </div>
                                </div>
                                <div x-data="{ animated: false }" x-intersect="animated = true">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-zinc-700 dark:text-zinc-300">Gagal</span>
                                        <span class="font-medium text-red-600 dark:text-red-400"><?php echo e($paymentStats['failed']); ?></span>
                                    </div>
                                    <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-red-500 to-red-600 h-3 rounded-full transition-all duration-1000 ease-out"
                                             :style="animated ? 'width: <?php echo e($stats['completed'] > 0 ? min(100, ($paymentStats['failed'] / $stats['completed']) * 100) : 0); ?>%' : 'width: 0%'"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="bg-zinc-50 dark:bg-zinc-900/30 rounded-xl p-5 border border-zinc-200 dark:border-zinc-700 transition-all duration-300 hover:shadow-md md:col-span-2">
                            <h3 class="font-semibold text-zinc-900 dark:text-white mb-4">Statistik Cepat</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-white dark:bg-zinc-800 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-1">Tugas Tersedia</p>
                                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400"><?php echo e($stats['available_tasks']); ?></p>
                                </div>
                                <div class="bg-white dark:bg-zinc-800 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-1">Tingkat Sukses</p>
                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        <?php echo e($stats['total_tasks'] > 0 ? round(($stats['completed'] / $stats['total_tasks']) * 100) : 0); ?>%
                                    </p>
                                </div>
                                <div class="bg-white dark:bg-zinc-800 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-1">Tugas Gagal</p>
                                    <p class="text-2xl font-bold text-red-600 dark:text-red-400"><?php echo e($stats['failed']); ?></p>
                                </div>
                                <div class="bg-white dark:bg-zinc-800 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700">
                                    <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-1">Rata-rata Penghasilan</p>
                                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">
                                        Rp <?php echo e($stats['completed'] > 0 ? number_format($stats['total_earnings'] / $stats['completed'], 0, ',', '.') : 0); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\template_design\resources\views/livewire/user-dashboard.blade.php ENDPATH**/ ?>