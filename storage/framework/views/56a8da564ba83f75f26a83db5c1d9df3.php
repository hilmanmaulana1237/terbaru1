<div class="min-h-screen bg-gradient-to-br from-white via-white to-white dark:from-zinc-800 dark:via-zinc-800 dark:to-zinc-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Sederhana -->
    <div class="mb-6">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
          <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white flex items-center gap-3">
            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Riwayat Tugas Saya
          </h1>
          <p class="text-zinc-600 dark:text-zinc-400 mt-1 text-sm sm:text-base">Lihat semua tugas yang pernah kamu kerjakan</p>
        </div>
        <a href="<?php echo e(route('user.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-all shadow-sm hover:shadow-md">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          Kembali
        </a>
      </div>
    </div>

    <!-- Filter Sederhana -->
    <div class="bg-white dark:bg-zinc-800 rounded-2xl p-4 sm:p-5 border border-zinc-200 dark:border-zinc-700 mb-6 shadow-sm">
      <div class="space-y-4">
        <!-- Search Box -->
        <div>
          <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Tugas
          </label>
          <input type="text" wire:model.live.debounce.300ms="search" placeholder="Ketik nama tugas..." class="w-full px-4 py-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-zinc-700 dark:text-white transition-all">
        </div>

        <!-- Filter Buttons dengan Info Stats -->
        <div class="flex flex-wrap gap-2">
          <button wire:click="$set('filterStatus', 'all')" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 <?php echo e($filterStatus === 'all' ? 'bg-green-600 text-white shadow-md' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-600'); ?>">
            📋 Semua
            <span class="px-2 py-0.5 rounded-full text-xs font-bold <?php echo e($filterStatus === 'all' ? 'bg-white/20' : 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300'); ?>"><?php echo e($stats['total']); ?></span>
          </button>
          <button wire:click="$set('filterStatus', 'in_progress')" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 <?php echo e($filterStatus === 'in_progress' ? 'bg-orange-600 text-white shadow-md' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-600'); ?>">
            ⏳ Dikerjakan
            <span class="px-2 py-0.5 rounded-full text-xs font-bold <?php echo e($filterStatus === 'in_progress' ? 'bg-white/20' : 'bg-orange-100 dark:bg-orange-900 text-orange-700 dark:text-orange-300'); ?>"><?php echo e($stats['in_progress']); ?></span>
          </button>
          <button wire:click="$set('filterStatus', '<?php echo e(\App\Models\UserTask::STATUS_COMPLETED); ?>')" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 <?php echo e($filterStatus === \App\Models\UserTask::STATUS_COMPLETED ? 'bg-green-600 text-white shadow-md' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-600'); ?>">
            ✅ Selesai
            <span class="px-2 py-0.5 rounded-full text-xs font-bold <?php echo e($filterStatus === \App\Models\UserTask::STATUS_COMPLETED ? 'bg-white/20' : 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300'); ?>"><?php echo e($stats['completed']); ?></span>
          </button>
          <button wire:click="$set('filterStatus', '<?php echo e(\App\Models\UserTask::STATUS_FAILED); ?>')" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all flex items-center gap-2 <?php echo e($filterStatus === \App\Models\UserTask::STATUS_FAILED ? 'bg-red-600 text-white shadow-md' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-600'); ?>">
            ❌ Gagal
            <span class="px-2 py-0.5 rounded-full text-xs font-bold <?php echo e($filterStatus === \App\Models\UserTask::STATUS_FAILED ? 'bg-white/20' : 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300'); ?>"><?php echo e($stats['failed']); ?></span>
          </button>
          <!--[if BLOCK]><![endif]--><?php if($filterStatus !== 'all' || $search): ?>
          <button wire:click="clearFilters" class="px-4 py-2 rounded-xl text-sm font-semibold bg-zinc-200 dark:bg-zinc-600 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-500 transition-all">
            🔄 Reset
          </button>
          <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
      </div>
    </div>

    <!-- Daftar Tugas (Card View Sederhana) -->
    <!--[if BLOCK]><![endif]--><?php if($tasks->count() > 0): ?>
      <div class="space-y-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $canContinue = in_array($userTask->status, [\App\Models\UserTask::STATUS_TAKEN, \App\Models\UserTask::STATUS_PENDING_VERIFICATION_1, \App\Models\UserTask::STATUS_PENDING_VERIFICATION_2]) && !$userTask->isOverdue();
            $progress = 0;
            if ($userTask->status === \App\Models\UserTask::STATUS_TAKEN) $progress = 25;
            elseif ($userTask->status === \App\Models\UserTask::STATUS_PENDING_VERIFICATION_1) $progress = 50;
            elseif ($userTask->status === \App\Models\UserTask::STATUS_PENDING_VERIFICATION_2) $progress = 75;
            elseif ($userTask->status === \App\Models\UserTask::STATUS_COMPLETED) $progress = 100;
            
            $statusInfo = match($userTask->status) {
              \App\Models\UserTask::STATUS_TAKEN => ['label' => 'Sedang Dikerjakan', 'color' => 'orange', 'icon' => '⏳'],
              \App\Models\UserTask::STATUS_PENDING_VERIFICATION_1 => ['label' => 'Menunggu Pengecekan 1', 'color' => 'yellow', 'icon' => '⏱️'],
              \App\Models\UserTask::STATUS_PENDING_VERIFICATION_2 => ['label' => 'Menunggu Pengecekan 2', 'color' => 'yellow', 'icon' => '⏱️'],
              \App\Models\UserTask::STATUS_COMPLETED => ['label' => 'Selesai', 'color' => 'green', 'icon' => '✅'],
              \App\Models\UserTask::STATUS_FAILED => ['label' => 'Gagal', 'color' => 'red', 'icon' => '❌'],
              \App\Models\UserTask::STATUS_CANCELLED => ['label' => 'Dibatalkan', 'color' => 'gray', 'icon' => '🚫'],
              default => ['label' => 'Tidak Diketahui', 'color' => 'gray', 'icon' => '❓']
            };

            // Override label and color if the task is overdue and still in an active review/taken status
            if ($userTask->isOverdue() && in_array($userTask->status, [\App\Models\UserTask::STATUS_TAKEN, \App\Models\UserTask::STATUS_PENDING_VERIFICATION_1, \App\Models\UserTask::STATUS_PENDING_VERIFICATION_2])) {
              // Show as failed in UI (for display purposes) but also indicate it was due to deadline
              $statusInfo = ['label' => 'Gagal (Kadaluarsa)', 'color' => 'red', 'icon' => '❌'];
            }
          ?>
          
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-md transition-all duration-200">
            <!-- Card Header - Status Bar -->
            <div class="px-4 py-2.5 border-b border-zinc-100 dark:border-zinc-700 bg-<?php echo e($statusInfo['color']); ?>-50 dark:bg-<?php echo e($statusInfo['color']); ?>-950/20 flex items-center justify-between">
              <div class="flex-1 min-w-0 mr-3">
                <h3 class="font-bold text-sm text-zinc-900 dark:text-white mb-1 line-clamp-1 leading-tight">
                  <?php echo e($userTask->task->title); ?>

                </h3>
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="text-xs text-zinc-500 dark:text-zinc-400">🏷️ <?php echo e($userTask->task->category->name); ?></span>
                </div>
              </div>
            </div>

            <!-- Card Body - Enhanced Info -->
            <div class="p-4 space-y-3">
              
              <!-- Info Grid -->
              <div class="grid grid-cols-2 gap-3 text-xs">
                <!-- Waktu Diambil -->
                <div class="flex items-start gap-2">
                  <span class="text-zinc-400 dark:text-zinc-500">🕐</span>
                  <div class="flex-1">
                    <p class="text-zinc-500 dark:text-zinc-400 leading-tight">Diambil</p>
                    <p class="font-semibold text-zinc-900 dark:text-white"><?php echo e($userTask->taken_at?->format('d M Y') ?? '-'); ?></p>
                  </div>
                </div>
                
                <!-- Waktu Selesai/Deadline -->
                <div class="flex items-start gap-2">
                  <!--[if BLOCK]><![endif]--><?php if($userTask->status === \App\Models\UserTask::STATUS_COMPLETED): ?>
                    <span class="text-zinc-400 dark:text-zinc-500">✅</span>
                    <div class="flex-1">
                      <p class="text-zinc-500 dark:text-zinc-400 leading-tight">Selesai</p>
                      <p class="font-semibold text-green-700 dark:text-green-400"><?php echo e($userTask->completed_at?->format('d M Y') ?? '-'); ?></p>
                    </div>
                  <?php else: ?>
                    <span class="text-zinc-400 dark:text-zinc-500">⏰</span>
                    <div class="flex-1">
                      <p class="text-zinc-500 dark:text-zinc-400 leading-tight">Deadline</p>
                      <p class="font-semibold <?php echo e($userTask->isOverdue() ? 'text-red-600 dark:text-red-400' : 'text-zinc-900 dark:text-white'); ?>">
                        <?php echo e($userTask->deadline_at?->format('d M Y') ?? '-'); ?>

                      </p>
                    </div>
                  <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                
                <!-- Jumlah Pembayaran -->
                <div class="flex items-start gap-2">
                  <span class="text-zinc-400 dark:text-zinc-500">💰</span>
                  <div class="flex-1">
                    <p class="text-zinc-500 dark:text-zinc-400 leading-tight">Nominal</p>
                    <p class="font-bold text-green-700 dark:text-green-400">
                      <!--[if BLOCK]><![endif]--><?php if($userTask->payment_amount): ?>
                        Rp <?php echo e(number_format($userTask->payment_amount, 0, ',', '.')); ?>

                      <?php elseif($userTask->task->payment_amount): ?>
                        Rp <?php echo e(number_format($userTask->task->payment_amount, 0, ',', '.')); ?>

                      <?php else: ?>
                        -
                      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </p>
                  </div>
                </div>
                
                <!-- Status Pembayaran -->
                <div class="flex items-start gap-2">
                  <span class="text-zinc-400 dark:text-zinc-500">💳</span>
                  <div class="flex-1">
                    <p class="text-zinc-500 dark:text-zinc-400 leading-tight">Pembayaran</p>
                    <!--[if BLOCK]><![endif]--><?php if($userTask->status === \App\Models\UserTask::STATUS_COMPLETED): ?>
                      <!--[if BLOCK]><![endif]--><?php if($userTask->payment_status === 'success'): ?>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-md font-bold text-xs">
                          ✓ Sudah Dibayar
                        </span>
                      <?php elseif($userTask->payment_status === 'failed'): ?>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-md font-bold text-xs">
                          ✗ Gagal
                        </span>
                      <?php else: ?>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-md font-bold text-xs">
                          ⏱ Menunggu
                        </span>
                      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php else: ?>
                      <span class="text-xs text-zinc-400 dark:text-zinc-500 font-medium">-</span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                  </div>
                </div>
              </div>
              
              <!-- Admin Feedback jika Gagal -->
              <?php
                $rejectionFeedback = null;
                if ($userTask->status === \App\Models\UserTask::STATUS_FAILED) {
                  if ($userTask->verification_1_status && strpos($userTask->verification_1_status, 'Rejected by admin') !== false) {
                    preg_match('/Reason: (.+)$/', $userTask->verification_1_status, $matches);
                    $rejectionFeedback = isset($matches[1]) ? $matches[1] : null;
                  } elseif ($userTask->verification_2_status && strpos($userTask->verification_2_status, 'Rejected by admin') !== false) {
                    preg_match('/Reason: (.+)$/', $userTask->verification_2_status, $matches);
                    $rejectionFeedback = isset($matches[1]) ? $matches[1] : null;
                  }
                }
              ?>
              
              <!--[if BLOCK]><![endif]--><?php if($rejectionFeedback): ?>
              <div class="p-3 bg-red-50 dark:bg-red-950/30 border-l-4 border-red-500 rounded-r text-sm text-red-700 dark:text-red-300">
                <p class="font-semibold mb-1">⚠️ Alasan ditolak:</p>
                <p class="text-xs leading-relaxed"><?php echo e($rejectionFeedback); ?></p>
              </div>
              <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

              <!-- Action Button -->
              <div>
                <!--[if BLOCK]><![endif]--><?php if($canContinue): ?>
                  <a href="<?php echo e(route('user.task.work', $userTask->task)); ?>" 
                     class="w-full flex items-center justify-between gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold text-sm transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                    <span class="flex items-center gap-2">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                      Lanjutkan Mengerjakan
                    </span>
                    <span class="px-2.5 py-1 bg-white/20 rounded-md text-xs font-bold">
                      <?php echo e($progress); ?>%
                    </span>
                  </a>
                <?php elseif($userTask->status === \App\Models\UserTask::STATUS_COMPLETED): ?>
                  <div class="flex items-center justify-between px-4 py-3 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-lg font-semibold text-sm">
                    <span class="flex items-center gap-2">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                      Selesai
                    </span>
                    <span class="flex items-center gap-2 text-xs">
                      <!--[if BLOCK]><![endif]--><?php if($userTask->payment_amount): ?>
                      <span class="font-bold">💰 Rp <?php echo e(number_format($userTask->payment_amount, 0, ',', '.')); ?></span>
                      <?php elseif($userTask->task->payment_amount): ?>
                      <span>💰 Rp <?php echo e(number_format($userTask->task->payment_amount, 0, ',', '.')); ?></span>
                      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </span>
                  </div>
                <?php elseif($userTask->status === \App\Models\UserTask::STATUS_FAILED): ?>
                  <div class="flex items-center justify-center px-4 py-3 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-lg font-semibold text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Gagal
                  </div>
                <?php else: ?>
                  <div class="flex items-center justify-between px-4 py-3 bg-zinc-50 dark:bg-zinc-700/50 text-zinc-700 dark:text-zinc-300 rounded-lg font-semibold text-sm">
                    <span><?php echo e($statusInfo['icon']); ?> <?php echo e($statusInfo['label']); ?></span>
                    <span class="flex items-center gap-2 text-xs">
                      <!--[if BLOCK]><![endif]--><?php if($userTask->task->payment_amount): ?>
                      <span>💰 <?php echo e(number_format($userTask->task->payment_amount / 1000, 0)); ?>k</span>
                      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                      <!--[if BLOCK]><![endif]--><?php if($progress > 0): ?>
                      <span class="px-2 py-0.5 bg-zinc-200 dark:bg-zinc-600 rounded"><?php echo e($progress); ?>%</span>
                      <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </span>
                  </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
      </div>

      <!-- Pagination -->
      <div class="mt-6">
        <?php echo e($tasks->links()); ?>

      </div>
    <?php else: ?>
      <!-- Empty State -->
      <div class="bg-white dark:bg-zinc-800 rounded-2xl p-12 text-center border-2 border-dashed border-zinc-300 dark:border-zinc-600">
        <div class="w-20 h-20 mx-auto bg-zinc-100 dark:bg-zinc-700 rounded-full flex items-center justify-center mb-4">
          <span class="text-4xl">📋</span>
        </div>
        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">Belum Ada Tugas</h3>
        <p class="text-zinc-600 dark:text-zinc-400 mb-6">Kamu belum mengerjakan tugas apapun</p>
        <a href="<?php echo e(route('user.dashboard')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold transition-all shadow-md hover:shadow-lg">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
          Lihat Tugas Tersedia
        </a>
      </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
  </div>
</div>
<?php /**PATH C:\laragon\www\template_design\resources\views/livewire/task-history.blade.php ENDPATH**/ ?>