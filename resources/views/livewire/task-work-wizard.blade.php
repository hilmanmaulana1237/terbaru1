<div class="min-h-screen dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950">
  <!-- Flash Messages -->
  @if (session()->has('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-5 right-5 left-5 sm:left-auto z-50 max-w-md">
      <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 shadow-lg">
        <div class="flex items-start">
          <svg class="w-5 h-5 text-green-500 dark:text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
          </div>
          <button @click="show = false" class="ml-4 text-green-500 hover:text-green-700">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/></svg>
          </button>
        </div>
      </div>
    </div>
  @endif

  @if (session()->has('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-5 right-5 left-5 sm:left-auto z-50 max-w-md">
      <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 shadow-lg">
        <div class="flex items-start">
          <svg class="w-5 h-5 text-red-500 dark:text-red-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
          </div>
          <button @click="show = false" class="ml-4 text-red-500 hover:text-red-700">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/></svg>
          </button>
        </div>
      </div>
    </div>
  @endif

  <!-- Android/Mobile View -->
  <div class="block sm:hidden">
    <div class="container mx-auto px-4 py-6 max-w-md">
      <!-- Page Header with Gradient -->
      <header class="mb-6">
        <div class="relative overflow-hidden bg-gradient-to-br from-green-600 via-green-700 to-emerald-700 dark:from-green-900 dark:via-emerald-900 dark:to-teal-900 rounded-2xl p-6 shadow-2xl shadow-green-500/20">
          <!-- Decorative Elements -->
          <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
          <div class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-400/10 rounded-full -ml-12 -mb-12 blur-2xl"></div>
          
          <div class="relative z-10">
            <div class="flex items-start gap-3 mb-4">
              <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <h1 class="text-xl font-bold text-white leading-tight mb-1">
                  {{ optional($task)->title ?? 'Task Wizard' }}
                </h1>
                <p class="text-sm text-green-100">Selesaikan langkah-langkah untuk menyelesaikan tugas</p>
              </div>
            </div>
            
            <!-- Cancel Button -->
            @if($this->canCancelTask())
              <button
                wire:click="cancelTask"
                wire:confirm="Apakah Anda yakin ingin membatalkan dan kembali ke dashboard?"
                wire:loading.attr="disabled"
                wire:target="cancelTask"
                wire:loading.class="opacity-50 cursor-not-allowed"
                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 text-white rounded-xl font-semibold text-sm transition-all">
                <svg wire:loading.remove wire:target="cancelTask" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <svg wire:loading wire:target="cancelTask" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Batalkan
              </button>
            @else
              <div class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white/10 backdrop-blur-sm border border-white/20 text-white/60 rounded-xl font-semibold text-sm cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                Tidak Dapat Dibatalkan
              </div>
            @endif
          </div>
        </div>
      </header>
      
      <!-- Modern Progress Stepper -->
      <div class="mb-6 bg-white dark:bg-zinc-800/50 rounded-2xl p-5 shadow-lg border border-zinc-200 dark:border-zinc-700/50">
        <ul class="relative flex flex-row gap-x-2">
          @for($i = 1; $i <= 4; $i++)
            <li class="shrink basis-0 flex-1 group">
              <div class="min-w-7 min-h-7 w-full inline-flex flex-col items-center text-xs">
                <span class="size-10 flex justify-center items-center shrink-0 font-bold rounded-xl transition-all duration-300 shadow-md
                  @if($currentStep > $i) bg-gradient-to-br from-green-500 to-green-600 text-white shadow-green-500/30
                  @elseif($currentStep === $i) bg-gradient-to-br from-green-600 to-green-700 text-white ring-4 ring-green-200 dark:ring-green-500/30 shadow-green-500/40
                  @else bg-zinc-100 text-zinc-400 dark:bg-zinc-700 dark:text-zinc-500 @endif">
                  @if($currentStep > $i)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                  @else
                    {{ $i }}
                  @endif
                </span>
                <span class="block text-xs font-semibold mt-2 text-center leading-tight
                  @if($currentStep === $i) text-green-600 dark:text-green-400
                  @elseif($currentStep > $i) text-green-600 dark:text-green-400
                  @else text-zinc-400 dark:text-zinc-500 @endif">
                  {{ $this->getStepLabel($i) }}
                </span>
              </div>
            </li>
          @endfor
        </ul>
        
        <!-- Progress Bar -->
        <div class="mt-4 relative h-2 bg-zinc-100 dark:bg-zinc-700 rounded-full overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-r from-green-500 via-green-600 to-emerald-600 transition-all duration-500 ease-out"
               style="width: {{ (($currentStep - 1) / 3) * 100 }}%"></div>
        </div>
      </div>
      
      <!-- Main Content Card -->
      <div class="bg-white dark:bg-zinc-800/50 rounded-2xl shadow-lg border border-zinc-200 dark:border-zinc-700/50 overflow-hidden">
        @if($currentStep === 1)
          <!-- Step 1: Instructions -->
          <div class="p-5">
            <div class="space-y-5">
              <div class="text-center">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-1">Instruksi Tugas</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Baca dengan teliti sebelum melanjutkan.</p>
              </div>
              
              <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                <h3 class="font-semibold text-green-900 dark:text-green-200 mb-2 text-base">Deskripsi Tugas</h3>
                <div class="prose prose-blue dark:prose-invert max-w-none text-green-800 dark:text-green-300 text-sm">
                  {!! optional($task)->description !!}
                </div>
              </div>
            
              
              @if(optional($task)->whatsapp_group_link)
                <div x-data="{ copied: false }" class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                  <div class="flex flex-col items-center justify-between gap-3">
                    <div class="text-center">
                      <h3 class="font-semibold text-green-900 dark:text-green-200 text-base">Grup WhatsApp</h3>
                      <p class="text-green-800 dark:text-green-300 mt-1 text-sm">Bergabung ke grup koordinasi untuk tugas ini.</p>
                    </div>
                    <div class="w-full flex flex-col gap-2 items-stretch">
                      <a href="{{ $task->whatsapp_group_link }}" target="_blank" rel="noopener noreferrer" aria-label="Buka Grup WhatsApp" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.148z"/></svg>
                        Gabung Grup
                      </a>
                        <button aria-label="Salin link grup WhatsApp" @click.prevent="(async () => { try { await navigator.clipboard.writeText('{{ $task->whatsapp_group_link }}'); copied = true; setTimeout(() => copied = false, 2000); } catch(e) { const ta = document.createElement('textarea'); ta.value = '{{ $task->whatsapp_group_link }}'; document.body.appendChild(ta); ta.select(); try { document.execCommand('copy'); copied = true; setTimeout(() => copied = false, 2000); } catch(e) { alert('Tidak dapat menyalin link. Silakan salin secara manual.'); } document.body.removeChild(ta); } })()" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-white border border-green-200 dark:bg-zinc-800 dark:border-zinc-700 text-green-700 dark:text-green-200 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M12 8h4"></path></svg>
                        <span x-text="copied ? 'Disalin!' : 'Salin Link'">Salin Link</span>
                      </button>
                      <!-- Share/Kirimkan Link button removed for mobile -->
                    </div>
                  </div>
                </div>
              @endif
              
              <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4" x-data="{ understood: @entangle('understoodInstructions') }">
                <label class="flex items-start gap-3 cursor-pointer group">
                  <div class="flex-shrink-0 mt-1">
                    <input type="checkbox" x-model="understood" class="w-5 h-5 text-green-600 border-2 border-amber-300 dark:border-amber-600 rounded focus:ring-green-500 focus:ring-offset-2 dark:bg-zinc-700 dark:checked:bg-green-600 transition-all">
                  </div>
                  <div class="flex-1">
                    <span class="text-amber-800 dark:text-amber-200 font-semibold text-sm group-hover:text-amber-900 dark:group-hover:text-amber-100 transition-colors">
                      Saya sudah membaca dan memahami semua instruksi tugas.
                    </span>
                    <p class="text-amber-700 dark:text-amber-400 text-xs">Anda harus menyetujui untuk melanjutkan.</p>
                  </div>
                </label>
                
                <div class="mt-4">
                  <button wire:click="nextStep" x-bind:disabled="!understood"
                          wire:loading.attr="disabled"
                          wire:loading.class="opacity-50 cursor-wait"
                          wire:target="nextStep"
                          class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 disabled:bg-gray-300 dark:disabled:bg-zinc-600 disabled:cursor-not-allowed text-white rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-green-500/30">
                    <!-- Loading spinner -->
                    <svg wire:loading wire:target="nextStep" style="display: none;" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="nextStep">Lanjutkan ke Langkah Berikutnya</span>
                    <span wire:loading wire:target="nextStep" style="display: none;">Memproses...</span>
                    <svg wire:loading.remove wire:target="nextStep" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        
        @elseif(in_array($currentStep, [2, 3]))
          <!-- Step 2 & 3: Upload Proofs -->
          @php
            $isStep2 = $currentStep === 2;
            $canSubmit = $isStep2 ? $this->canSubmitProof1() : $this->canSubmitProof2();
            
            // Check if user has submitted proof and is waiting for verification
            $hasSubmittedProof1 = optional($userTask)->verification_1_status && 
                                   strpos($userTask->verification_1_status, 'Submitted') !== false &&
                                   strpos($userTask->verification_1_status, 'Approved') === false &&
                                   strpos($userTask->verification_1_status, 'Rejected') === false;
            
            $hasSubmittedProof2 = optional($userTask)->verification_2_status && 
                                   strpos($userTask->verification_2_status, 'Submitted') !== false &&
                                   strpos($userTask->verification_2_status, 'Approved') === false &&
                                   strpos($userTask->verification_2_status, 'Rejected') === false;
            
            $isWaiting = $isStep2 ? $hasSubmittedProof1 : $hasSubmittedProof2;
            
            $rejectionMessage = null;
            if ($isStep2 && optional($userTask)->verification_1_status && strpos($userTask->verification_1_status, 'Rejected') !== false) {
              $rejectionMessage = $userTask->verification_1_status;
            } elseif (!$isStep2 && optional($userTask)->verification_2_status && strpos($userTask->verification_2_status, 'Rejected') !== false) {
              $rejectionMessage = $userTask->verification_2_status;
            }
          @endphp
          <!-- Wrapper with x-data for upload state -->
          <div x-data="{ isUploading: false, progress: 0 }"
               x-on:livewire-upload-start="isUploading = true"
               x-on:livewire-upload-finish="isUploading = false"
               x-on:livewire-upload-error="isUploading = false"
               x-on:livewire-upload-progress="progress = $event.detail.progress">
            
            <div class="p-5">
              <div class="space-y-6">
                <!-- Title -->
                <div class="text-center">
                  <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-1">Upload Bukti Tahap {{ $isStep2 ? 1 : 2 }}</h2>
                  <p class="text-sm text-zinc-600 dark:text-zinc-400">Kirimkan bukti pekerjaan Anda untuk diverifikasi.</p>
                </div>
                
                @if($isStep2 && $userTask->status === 'taken' && $proof1Deadline)
                  <!-- Timer Countdown for Proof 1 -->
                  <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 border-2 border-yellow-300 dark:border-yellow-700 rounded-xl p-4" 
                       x-data="{ 
                         deadline: new Date('{{ $proof1Deadline->toIso8601String() }}').getTime(),
                         timeLeft: 0,
                         minutes: 0,
                         seconds: 0,
                         hasReloaded: false,
                         interval: null,
                         init() {
                           this.calculateTimeLeft();
                           this.updateDisplay();
                           if (this.timeLeft <= 0) { window.location.reload(); return; }
                           this.interval = setInterval(() => {
                             this.calculateTimeLeft();
                             if (this.timeLeft > 0) { this.updateDisplay(); } 
                             else if (!this.hasReloaded) { this.hasReloaded = true; clearInterval(this.interval); window.location.reload(); }
                           }, 1000);
                         },
                         calculateTimeLeft() { this.timeLeft = Math.max(0, Math.floor((this.deadline - Date.now()) / 1000)); },
                         updateDisplay() { this.minutes = Math.floor(this.timeLeft / 60); this.seconds = Math.floor(this.timeLeft % 60); }
                       }">
                    <div class="flex items-center justify-center gap-3">
                      <div class="text-center">
                        <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-300 mb-1">⚠️ Waktu Submit Proof 1</p>
                        <p class="text-xs text-yellow-700 dark:text-yellow-400 mb-2">Segera upload bukti!</p>
                        <div class="flex items-center gap-2 justify-center">
                          <div class="bg-white dark:bg-zinc-800 rounded-lg px-3 py-1.5 border-2 border-yellow-400 dark:border-yellow-600">
                            <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 tabular-nums" x-text="minutes.toString().padStart(2, '0')">00</span>
                            <span class="text-xs text-yellow-700 dark:text-yellow-500 block">Menit</span>
                          </div>
                          <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">:</span>
                          <div class="bg-white dark:bg-zinc-800 rounded-lg px-3 py-1.5 border-2 border-yellow-400 dark:border-yellow-600">
                            <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 tabular-nums" x-text="seconds.toString().padStart(2, '0')">00</span>
                            <span class="text-xs text-yellow-700 dark:text-yellow-500 block">Detik</span>
                          </div>
                        </div>
                        <p class="text-xs text-red-600 dark:text-red-400 mt-2 font-medium">⚠️ Task otomatis dibatalkan jika waktu habis!</p>
                      </div>
                    </div>
                  </div>
                @endif
                
                @if($canSubmit)
                  @if($rejectionMessage)
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                      <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 text-red-500"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg></div>
                        <div class="flex-1">
                          <h3 class="font-semibold text-red-900 dark:text-red-200 text-base">Catatan dari Admin</h3>
                          <p class="text-red-800 dark:text-red-300 mt-1 text-sm">{{ $rejectionMessage }}</p>
                          <p class="text-red-700 dark:text-red-400 mt-2 text-xs">Silakan perbaiki dan kirim ulang.</p>
                        </div>
                      </div>
                    </div>
                  @endif

                  <form wire:submit="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}" class="space-y-6">
                    <!-- Option 1: File Upload -->
                    <div class="space-y-3">
                      <label class="block text-sm font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-700 text-xs text-center dark:bg-green-900 dark:text-green-300">1</span>
                        Upload File Bukti (Utama)
                      </label>
                      <div class="relative group">
                        <input type="file" wire:model="{{ $isStep2 ? 'proof1Files' : 'proof2Files' }}" multiple accept="image/*,application/pdf,.doc,.docx" 
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-zinc-700 dark:file:text-zinc-300 dark:hover:file:bg-zinc-600 transition-all border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl hover:border-green-500 dark:hover:border-green-500 p-2"/>
                        
                        <!-- Upload Overlay -->
                        <div x-show="isUploading" class="absolute inset-0 w-full h-full bg-white/80 dark:bg-zinc-800/80 backdrop-blur-sm rounded-xl z-10 transition-all">
                          <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-6">
                            <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700 overflow-hidden">
                              <div class="bg-green-600 h-3 rounded-full transition-all duration-300 ease-out" :style="`width: ${progress}%`"></div>
                            </div>
                            <p class="text-center text-xs font-medium text-gray-600 dark:text-gray-300 mt-2" x-text="`Mengupload... ${progress}%`"></p>
                          </div>
                        </div>
                      </div>
                      @error($isStep2 ? 'proof1Files.*' : 'proof2Files.*') <p class="text-red-600 dark:text-red-400 text-xs ml-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Divider -->
                    <div class="relative py-2">
                      <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200 dark:border-zinc-700"></div>
                      </div>
                      <div class="relative flex justify-center">
                        <span class="px-3 bg-white dark:bg-zinc-900 text-xs font-bold text-gray-400 uppercase tracking-wider">ATAU JIKA UPLOAD GAGAL</span>
                      </div>
                    </div>

                    <!-- Option 2: External Link -->
                    <div class="space-y-3">
                      <label for="description" class="block text-sm font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-700 text-xs text-center dark:bg-zinc-700 dark:text-zinc-300">2</span>
                        Kirim Link Eksternal
                      </label>
                      <p class="text-xs text-gray-500 dark:text-gray-400 ml-8">Gunakan opsi ini jika file Anda terlalu besar atau gagal diupload. (Google Drive, Dropbox, dll)</p>
                      <textarea wire:model="{{ $isStep2 ? 'proof1Description' : 'proof2Description' }}" id="description" rows="3" 
                                placeholder="Tempel link bukti Anda di sini atau tambahkan catatan..." 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all text-sm"></textarea>
                      @error($isStep2 ? 'proof1Description' : 'proof2Description') <p class="text-red-600 dark:text-red-400 text-xs ml-1">{{ $message }}</p> @enderror
                    </div>
                  </form>
                @else
                  <!-- Awaiting Verification UI -->
                  <div class="text-center py-6">
                    <!-- Status Icon -->
                    <div class="relative mx-auto mb-5">
                      <div class="w-20 h-20 bg-gradient-to-br from-orange-100 to-amber-100 dark:from-orange-900/40 dark:to-amber-900/40 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                        <svg class="w-10 h-10 text-orange-500 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                      </div>
                      <!-- Animated pulse -->
                      <div class="absolute inset-0 w-20 h-20 mx-auto bg-orange-400 rounded-2xl animate-ping opacity-20"></div>
                    </div>
                    
                    <!-- Status Text -->
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">Menunggu Verifikasi</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4 px-4">Bukti Anda sudah terkirim dan sedang direview oleh admin</p>
                    
                    <!-- Status Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 dark:bg-orange-900/30 rounded-full mb-6">
                      <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
                      </span>
                      <span class="text-xs font-semibold text-orange-700 dark:text-orange-300">Proses Verifikasi</span>
                    </div>
                  </div>
                  
                  <!-- Tip Card -->
                  <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-4 mx-2">
                    <div class="flex items-start gap-3">
                      <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                        <span class="text-lg">💡</span>
                      </div>
                      <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-green-900 dark:text-green-200 text-sm mb-1">Sambil Menunggu Verifikasi</h4>
                        <p class="text-green-700 dark:text-green-300 text-xs leading-relaxed">Anda bisa mengambil dan mengerjakan task lain untuk mendapatkan lebih banyak reward!</p>
                      </div>
                    </div>
                    
                    <!-- Dashboard Button -->
                    <a href="{{ route('user.dashboard') }}" wire:navigate
                       class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-green-500/20">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                      Kembali ke Dashboard
                    </a>
                  </div>
                @endif
              </div>
            </div>
            
            <div class="bg-gray-50 dark:bg-zinc-800 px-5 py-4 border-t border-zinc-200 dark:border-zinc-700">
              @if($canSubmit)
              <div class="flex justify-end">
                <button 
                  wire:click="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}"
                  wire:loading.attr="disabled"
                  wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}"
                  :disabled="isUploading"
                  class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 disabled:bg-blue-400 disabled:cursor-not-allowed text-white rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-green-500/30">
                  <svg wire:loading wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}" style="display: none;" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span wire:loading.remove wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}">Submit for Verification</span>
                  <span wire:loading wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}" style="display: none;">Processing...</span>
                  <span x-show="isUploading" style="display: none;" class="ml-2 text-xs opacity-90">(Mengupload...)</span>
                </button>
              </div>
              @endif
            </div>
          </div>
        
        @else
          <!-- Step 4: Completed OR Failed -->
          <div class="p-5">
            @if($this->isTaskRejectedAndCancelled())
              <div class="text-center py-10">
                <div class="w-20 h-20 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-5">
                  <svg class="w-10 h-10 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-red-600 dark:text-red-400 mb-2">Tugas Ditolak</h2>
                <p class="text-base text-zinc-600 dark:text-zinc-400 mb-5 max-w-md mx-auto">Pengiriman Anda ditolak oleh admin dan tugas telah dikembalikan ke daftar tersedia.</p>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 max-w-lg mx-auto">
                  <h3 class="font-semibold text-red-900 dark:text-red-200 text-base flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Catatan Admin:
                  </h3>
                  <p class="text-red-800 dark:text-red-300 mt-2 text-left text-sm">{{ $this->getRejectionFeedback() ?: 'Pengiriman Anda tidak memenuhi persyaratan.' }}</p>
                </div>
              </div>
            @else
              <div class="text-center py-10">
                @if($this->isCompletedButAwaitingPayment())
                  <!-- Completed but awaiting payment -->
                  <div class="w-20 h-20 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-10 h-10 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </div>
                  <h2 class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">⏳ Tugas Selesai!</h2>
                  <p class="text-base text-zinc-600 dark:text-zinc-400 mb-5 max-w-md mx-auto">Pekerjaan Anda telah diverifikasi dan disetujui. Pembayaran sedang diproses.</p>
                @else
                  <!-- Fully completed with payment -->
                  <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-10 h-10 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                  </div>
                  <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">🎉 Tugas Selesai!</h2>
                  <p class="text-base text-zinc-600 dark:text-zinc-400 mb-5 max-w-md mx-auto">Selamat! Anda berhasil menyelesaikan tugas ini dan telah menerima pembayaran.</p>
                @endif
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 max-w-lg mx-auto space-y-3">
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-green-800 dark:text-green-300 text-sm">Status Akhir:</span>
                    <span class="px-3 py-1 bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-xs font-medium">{{ \App\Models\UserTask::STATUSES[optional($userTask)->status] ?? 'Completed' }}</span>
                  </div>
                  @if(optional($userTask)->payment_amount)
                    <div class="flex justify-between items-center">
                      <span class="font-semibold text-green-800 dark:text-green-300 text-sm">Hadiah:</span>
                      <span class="text-lg font-bold text-green-700 dark:text-green-300">Rp {{ number_format($userTask->payment_amount, 0, ',', '.') }}</span>
                    </div>
                  @endif
                  @if(optional($userTask)->payment_amount)
                    <div class="flex justify-between items-center">
                      <span class="font-semibold text-green-800 dark:text-green-300 text-sm">Status Pembayaran:</span>
                      @if(optional($userTask)->payment_status === 'success')
                        <span class="px-3 py-1 bg-emerald-200 dark:bg-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-full text-xs font-medium flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                          Berhasil Dibayar
                        </span>
                      @elseif(optional($userTask)->payment_status === 'failed')
                        <span class="px-3 py-1 bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-200 rounded-full text-xs font-medium flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                          Pembayaran Gagal
                        </span>
                      @else
                        <span class="px-3 py-1 bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-full text-xs font-medium flex items-center gap-2">
                          <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                          Memproses Pembayaran
                        </span>
                      @endif
                    </div>
                    @if(optional($userTask)->payment_verified_at)
                      <div class="text-center pt-2 border-t border-green-200 dark:border-green-700">
                        <p class="text-xs text-green-700 dark:text-green-400">
                          Pembayaran diverifikasi pada {{ $userTask->payment_verified_at->format('d M Y \p\u\k\u\l H:i') }}
                        </p>
                      </div>
                    @endif
                  @endif
                </div>
              </div>
            @endif
          </div>
          <div class="bg-gray-50 dark:bg-zinc-800 px-5 py-4 border-t border-zinc-200 dark:border-zinc-700">
            <div class="flex justify-center">
              <a href="{{ route('user.dashboard') }}" wire:navigate class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 hover:bg-green-700 active:scale-95 text-white rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-green-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Kembali ke Dashboard
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Desktop View -->
  <div class="hidden sm:block">
    <div class="container mx-auto px-4 py-8 sm:py-12 max-w-5xl">
      
      <!-- Page Header -->
      <header class="mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white leading-tight tracking-tight">
              {{ optional($task)->title ?? 'Task Wizard' }}
            </h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
              Selesaikan langkah-langkah di bawah untuk menyelesaikan tugas Anda.
            </p>
          </div>
          <div class="flex-shrink-0">
            @if($this->canCancelTask())
              <button
                wire:click="cancelTask"
                wire:confirm="Are you sure you want to cancel and return to the dashboard?"
                wire:loading.attr="disabled"
                wire:target="cancelTask"
                wire:loading.class="opacity-50 cursor-not-allowed"
                title="Cancel and return to dashboard"
                aria-label="Cancel task and return to dashboard"
                class="inline-flex items-center gap-2 px-3 py-1.5 bg-transparent dark:bg-transparent border border-gray-200 dark:border-zinc-700 text-gray-700 dark:text-gray-300 rounded-md font-semibold text-sm hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg wire:loading.remove wire:target="cancelTask" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                <svg wire:loading wire:target="cancelTask" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span class="hidden sm:inline">Cancel</span>
              </button>
            @else
              <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 text-gray-400 dark:text-gray-500 rounded-md font-semibold text-sm cursor-not-allowed" title="Cannot cancel after submitting proof">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <span class="hidden sm:inline">Tidak Dapat Dibatalkan</span>
              </div>
            @endif
          </div>
        </div>
      </header>
      <!-- Progress Stepper -->
      <div class="mb-8">
        <ul class="relative flex flex-row gap-x-2 justify-center max-w-3xl mx-auto">
          @for($i = 1; $i <= 4; $i++)
            <li class="shrink basis-0 flex-1 group">
              <div class="min-w-8 min-h-8 w-full inline-flex flex-col items-center text-xs align-middle">
                <div class="flex items-center w-full">
                  <div class="flex-1 h-1 bg-gray-200 dark:bg-zinc-700 group-first:invisible">
                    <div class="h-1 rounded-full transition-all duration-500
                      @if($currentStep >= $i) bg-green-600 w-full
                      @else bg-gray-200 dark:bg-zinc-700 w-0 @endif">
                    </div>
                  </div>
                  <span class="size-8 flex justify-center items-center shrink-0 font-bold rounded-full transition-all duration-300 mx-1
                    @if($currentStep > $i) bg-green-600 text-white
                    @elseif($currentStep === $i) bg-green-600 text-white ring-4 ring-green-200 dark:ring-green-500/30
                    @else bg-gray-200 text-gray-600 dark:bg-zinc-700 dark:text-zinc-300 @endif">
                    @if($currentStep > $i)
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                    @else
                      {{ $i }}
                    @endif
                  </span>
                  <div class="flex-1 h-1 bg-gray-200 dark:bg-zinc-700 group-last:invisible">
                    <div class="h-1 rounded-full transition-all duration-500
                      @if($currentStep > $i) bg-green-600 w-full
                      @elseif($currentStep === $i) bg-green-600 w-1/2
                      @else bg-gray-200 dark:bg-zinc-700 w-0 @endif">
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-3">
                <span class="block text-sm font-medium text-center
                  @if($currentStep === $i) text-green-600 dark:text-green-400
                  @elseif($currentStep > $i) text-zinc-800 dark:text-zinc-200
                  @else text-zinc-500 dark:text-zinc-400 @endif">
                  {{ $this->getStepLabel($i) }}
                </span>
              </div>
            </li>
          @endfor
        </ul>
      </div>
      
      <!-- Main Content Card -->
      <div class="bg-white dark:bg-zinc-800/50 rounded-2xl shadow-xl border border-zinc-200 dark:border-zinc-700/50 overflow-hidden">
        @if($currentStep === 1)
          <!-- Step 1: Instructions -->
          <div class="p-6 sm:p-8">
            <div class="space-y-6">
              <div class="text-center">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-1">Instruksi Tugas</h2>
                <p class="text-md text-zinc-600 dark:text-zinc-400">Baca dengan teliti sebelum melanjutkan.</p>
              </div>
              
              <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-5">
                <h3 class="font-semibold text-green-900 dark:text-green-200 mb-3 text-lg">Deskripsi Tugas</h3>
                <div class="prose prose-blue dark:prose-invert max-w-none text-green-800 dark:text-green-300">
                  {!! optional($task)->description !!}
                </div>
              </div>
              
              <!-- Admin Contact Info -->
              <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">
                <h3 class="font-semibold text-blue-900 dark:text-blue-200 mb-4 text-lg flex items-center gap-2">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                  Admin yang Membuat Task
                </h3>
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                      <span class="text-white text-lg font-bold">{{ substr(optional(optional($task)->creator)->name ?? 'A', 0, 1) }}</span>
                    </div>
                    <div>
                      <p class="font-semibold text-blue-900 dark:text-blue-200 text-lg">{{ optional(optional($task)->creator)->name ?? 'Admin' }}</p>
                      @if(optional(optional($task)->creator)->badge === 'premium_admin')
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 rounded text-xs font-medium">
                          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                          Premium Admin
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="flex gap-2">
                    @if(optional(optional($task)->creator)->whatsapp)
                      <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', optional(optional($task)->creator)->whatsapp) }}" target="_blank" 
                         class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.148z"/></svg>
                        Hubungi via WhatsApp
                      </a>
                    @elseif(optional(optional($task)->creator)->phone)
                      <a href="tel:{{ optional(optional($task)->creator)->phone }}" 
                         class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Telepon: {{ optional(optional($task)->creator)->phone }}
                      </a>
                    @else
                      <span class="text-sm text-blue-700 dark:text-blue-300 italic">Kontak admin tidak tersedia</span>
                    @endif
                  </div>
                </div>
              </div>
              
              @if(optional($task)->whatsapp_group_link)
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-5">
                  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                      <h3 class="font-semibold text-green-900 dark:text-green-200 text-lg">Grup WhatsApp</h3>
                      <p class="text-green-800 dark:text-green-300 mt-1">Bergabung ke grup koordinasi untuk tugas ini.</p>
                    </div>
                    <div x-data="{ copied: false }" class="inline-flex items-center gap-2">
                      <a href="{{ $task->whatsapp_group_link }}" target="_blank" rel="noopener noreferrer" aria-label="Buka Grup WhatsApp" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors transform hover:scale-105 flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.148z"/></svg>
                        Gabung Grup
                      </a>
                      <button aria-label="Salin link grup WhatsApp" @click.prevent="(async () => { try { await navigator.clipboard.writeText('{{ $task->whatsapp_group_link }}'); copied = true; setTimeout(() => copied = false, 2000); } catch(e) { const ta = document.createElement('textarea'); ta.value = '{{ $task->whatsapp_group_link }}'; document.body.appendChild(ta); ta.select(); try { document.execCommand('copy'); copied = true; setTimeout(() => copied = false, 2000); } catch(e) { alert('Tidak dapat menyalin link. Silakan salin secara manual.'); } document.body.removeChild(ta); } })()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-green-200 dark:bg-zinc-800 dark:border-zinc-700 text-green-700 dark:text-green-200 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M12 8h4"></path></svg>
                        <span x-text="copied ? 'Disalin!' : 'Salin Link'">Salin Link</span>
                      </button>
                      <!-- Share/Kirimkan Link button removed for desktop -->
                    </div>
                  </div>
                </div>
              @endif
              
              <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-5" x-data="{ understood: @entangle('understoodInstructions') }">
                <label class="flex items-start gap-4 cursor-pointer group">
                  <div class="flex-shrink-0 mt-1">
                    <input type="checkbox" x-model="understood" class="w-5 h-5 text-green-600 border-2 border-amber-300 dark:border-amber-600 rounded focus:ring-green-500 focus:ring-offset-2 dark:bg-zinc-700 dark:checked:bg-green-600 transition-all">
                  </div>
                  <div class="flex-1">
                    <span class="text-amber-800 dark:text-amber-200 font-semibold text-base group-hover:text-amber-900 dark:group-hover:text-amber-100 transition-colors">
                      Saya sudah membaca dan memahami semua instruksi tugas.
                    </span>
                    <p class="text-amber-700 dark:text-amber-400 text-sm">Anda harus menyetujui untuk melanjutkan.</p>
                  </div>
                </label>
                
                <div class="mt-4">
                  <button wire:click="nextStep" x-bind:disabled="!understood"
                          wire:loading.attr="disabled"
                          wire:loading.class="opacity-50 cursor-wait"
                          wire:target="nextStep"
                          class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 disabled:bg-gray-300 dark:disabled:bg-zinc-600 disabled:cursor-not-allowed text-white rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-green-500/30 disabled:transform-none disabled:shadow-none">
                    <!-- Loading spinner -->
                    <svg wire:loading wire:target="nextStep" style="display: none;" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="nextStep">Lanjutkan ke Langkah Berikutnya</span>
                    <span wire:loading wire:target="nextStep" style="display: none;">Memproses...</span>
                    <svg wire:loading.remove wire:target="nextStep" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        
        @elseif(in_array($currentStep, [2, 3]))
          <!-- Step 2 & 3: Upload Proofs -->
          @php
            $isStep2 = $currentStep === 2;
            $canSubmit = $isStep2 ? $this->canSubmitProof1() : $this->canSubmitProof2();
            
            // Check if user has submitted proof and is waiting for verification
            $hasSubmittedProof1 = optional($userTask)->verification_1_status && 
                                   strpos($userTask->verification_1_status, 'Submitted') !== false &&
                                   strpos($userTask->verification_1_status, 'Approved') === false &&
                                   strpos($userTask->verification_1_status, 'Rejected') === false;
            
            $hasSubmittedProof2 = optional($userTask)->verification_2_status && 
                                   strpos($userTask->verification_2_status, 'Submitted') !== false &&
                                   strpos($userTask->verification_2_status, 'Approved') === false &&
                                   strpos($userTask->verification_2_status, 'Rejected') === false;
            
            $isWaiting = $isStep2 ? $hasSubmittedProof1 : $hasSubmittedProof2;
            
            $rejectionMessage = null;
            if ($isStep2 && optional($userTask)->verification_1_status && strpos($userTask->verification_1_status, 'Rejected') !== false) {
              $rejectionMessage = $userTask->verification_1_status;
            } elseif (!$isStep2 && optional($userTask)->verification_2_status && strpos($userTask->verification_2_status, 'Rejected') !== false) {
              $rejectionMessage = $userTask->verification_2_status;
            }
          @endphp
          <!-- Wrapper with x-data for upload state -->
          <div x-data="{ isUploading: false, progress: 0 }"
               x-on:livewire-upload-start="isUploading = true"
               x-on:livewire-upload-finish="isUploading = false"
               x-on:livewire-upload-error="isUploading = false"
               x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="p-6 sm:p-8">
            <div class="space-y-6">
              <div class="text-center">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-1">Upload Bukti Tahap {{ $isStep2 ? 1 : 2 }}</h2>
                <p class="text-md text-zinc-600 dark:text-zinc-400">Kirimkan bukti pekerjaan Anda untuk diverifikasi.</p>
              </div>
              
              <!-- Timer for Proof 1 (Desktop) -->
              @if($currentStep === 2 && $userTask && $userTask->status === \App\Models\UserTask::STATUS_TAKEN && $proof1Deadline)
                <div x-data="{ 
                  deadline: new Date('{{ $proof1Deadline->toIso8601String() }}').getTime(),
                  timeLeft: 0,
                  minutes: 0,
                  seconds: 0,
                  isExpired: false,
                  hasReloaded: false,
                  interval: null,
                  
                  init() {
                    this.updateTimer();
                    if (this.timeLeft <= 0) {
                      window.location.reload();
                      return;
                    }
                    this.interval = setInterval(() => this.updateTimer(), 1000);
                  },
                  
                  updateTimer() {
                    this.timeLeft = Math.max(0, Math.floor((this.deadline - Date.now()) / 1000));
                    this.minutes = Math.floor(this.timeLeft / 60);
                    this.seconds = this.timeLeft % 60;
                    this.isExpired = this.timeLeft === 0;
                    if (this.isExpired && !this.hasReloaded) {
                      this.hasReloaded = true;
                      clearInterval(this.interval);
                      setTimeout(() => window.location.reload(), 500);
                    }
                  },
                  
                  formatTime() {
                    return this.minutes.toString().padStart(2, '0') + ':' + this.seconds.toString().padStart(2, '0');
                  }
                }"
                class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 border border-yellow-300 dark:border-yellow-700 rounded-xl p-5">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                      <div class="flex-shrink-0 text-yellow-600 dark:text-yellow-400">
                        <svg class="w-6 h-6 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                      </div>
                      <div>
                        <h3 class="font-semibold text-yellow-900 dark:text-yellow-200 text-lg">Waktu Submit Proof 1</h3>
                        <p class="text-yellow-700 dark:text-yellow-400 text-sm">Segera upload bukti sebelum waktu habis!</p>
                      </div>
                    </div>
                    <div class="text-right">
                      <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 tabular-nums tracking-wider" x-text="formatTime()"></div>
                      <p class="text-xs text-yellow-600 dark:text-yellow-500 mt-1">tersisa</p>
                    </div>
                  </div>
                </div>
              @endif
              
              @if($canSubmit)
                @if($rejectionMessage)
                  <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-5">
                    <div class="flex items-start gap-4">
                      <div class="flex-shrink-0 text-red-500"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg></div>
                      <div class="flex-1">
                        <h3 class="font-semibold text-red-900 dark:text-red-200 text-lg">Catatan dari Admin</h3>
                        <p class="text-red-800 dark:text-red-300 mt-1">{{ $rejectionMessage }}</p>
                        <p class="text-red-700 dark:text-red-400 mt-2 text-sm">Silakan perbaiki dan kirim ulang.</p>
                      </div>
                    </div>
                  </div>
                @endif
                <form wire:submit="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}" class="space-y-8">
                  <!-- Option 1: File Upload -->
                  <div class="space-y-4">
                    <label class="block text-base font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
                      <span class="flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-700 text-sm text-center dark:bg-green-900 dark:text-green-300 shadow-sm">1</span>
                      Upload File Bukti (Utama)
                    </label>
                    <div class="relative group">
                      <input type="file" wire:model="{{ $isStep2 ? 'proof1Files' : 'proof2Files' }}" multiple accept="image/*,application/pdf,.doc,.docx" 
                             class="block w-full text-base text-gray-500 file:mr-5 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-zinc-700 dark:file:text-zinc-300 dark:hover:file:bg-zinc-600 transition-all border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-xl hover:border-green-500 dark:hover:border-green-500 p-3"/>
                      
                      <!-- Upload Overlay -->
                      <div x-show="isUploading" class="absolute inset-0 w-full h-full bg-white/80 dark:bg-zinc-800/80 backdrop-blur-sm rounded-xl z-10 transition-all">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full px-8">
                          <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700 overflow-hidden shadow-inner">
                            <div class="bg-green-600 h-4 rounded-full transition-all duration-300 ease-out" :style="`width: ${progress}%`"></div>
                          </div>
                          <p class="text-center text-sm font-semibold text-gray-700 dark:text-gray-300 mt-3" x-text="`Mengupload file... ${progress}%`"></p>
                        </div>
                      </div>
                    </div>
                    @error($isStep2 ? 'proof1Files.*' : 'proof2Files.*') <p class="text-red-600 dark:text-red-400 text-sm ml-1 font-medium">{{ $message }}</p> @enderror
                  </div>
                  
                  <!-- Divider -->
                  <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                      <div class="w-full border-t border-gray-300 dark:border-zinc-600"></div>
                    </div>
                    <div class="relative flex justify-center">
                      <span class="px-4 bg-white dark:bg-zinc-900 text-sm font-bold text-gray-500 uppercase tracking-widest shadow-sm border border-gray-100 dark:border-zinc-800 rounded-full py-1">ATAU JIKA UPLOAD GAGAL</span>
                    </div>
                  </div>

                  <!-- Option 2: External Link -->
                  <div class="space-y-4">
                    <label for="description" class="block text-base font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
                      <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-700 text-sm text-center dark:bg-zinc-700 dark:text-zinc-300 shadow-sm">2</span>
                      Kirim Link Eksternal
                    </label>
                    <p class="text-sm text-gray-600 dark:text-gray-400 ml-11 -mt-2">Gunakan opsi ini jika file Anda terlalu besar atau gagal diupload. (Google Drive, Dropbox, dll)</p>
                    <textarea wire:model="{{ $isStep2 ? 'proof1Description' : 'proof2Description' }}" id="description" rows="3" 
                              placeholder="Tempel link bukti Anda di sini atau tambahkan catatan..." 
                              class="w-full px-5 py-4 border border-gray-300 dark:border-zinc-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all text-base shadow-sm hover:border-gray-400"></textarea>
                    @error($isStep2 ? 'proof1Description' : 'proof2Description') <p class="text-red-600 dark:text-red-400 text-sm ml-1 font-medium">{{ $message }}</p> @enderror
                  </div>
                </form>
              @else
                <!-- Awaiting Admin Verification (Desktop) -->
                <div class="py-10">
                  <div class="max-w-lg mx-auto text-center">
                    <!-- Status Icon with Animation -->
                    <div class="relative mx-auto mb-6 w-24 h-24">
                      <div class="w-24 h-24 bg-gradient-to-br from-orange-100 to-amber-100 dark:from-orange-900/40 dark:to-amber-900/40 rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-orange-500 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                      </div>
                      <!-- Animated ring -->
                      <div class="absolute inset-0 w-24 h-24 bg-orange-400 rounded-2xl animate-ping opacity-20"></div>
                    </div>
                    
                    <!-- Status Text -->
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">Menunggu Verifikasi Admin</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-5">Bukti Anda telah terkirim dan sedang dalam proses review oleh admin</p>
                    
                    <!-- Status Badge -->
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-orange-100 dark:bg-orange-900/30 rounded-full mb-8">
                      <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                      </span>
                      <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Sedang Diverifikasi</span>
                    </div>
                  </div>
                  
                  <!-- Tip Card -->
                  <div class="max-w-xl mx-auto bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                      <div class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-xl">💡</span>
                      </div>
                      <div class="flex-1">
                        <h4 class="font-bold text-green-900 dark:text-green-200 text-lg mb-2">Sambil Menunggu Verifikasi</h4>
                        <p class="text-green-700 dark:text-green-300 text-sm leading-relaxed mb-4">Anda bisa mengambil dan mengerjakan task lain sambil menunggu. Maksimalkan waktu Anda untuk mendapatkan lebih banyak reward!</p>
                        
                        <!-- Dashboard Button -->
                        <a href="{{ route('user.dashboard') }}" wire:navigate
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-green-500/20 hover:scale-105">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                          Kembali ke Dashboard
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="bg-gray-50 dark:bg-zinc-800 px-6 sm:px-8 py-4 border-t border-zinc-200 dark:border-zinc-700">
            @if($canSubmit)
            <div class="flex justify-end">
              <button 
                wire:click="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}"
                wire:loading.attr="disabled"
                wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}"
                :disabled="isUploading"
                class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 disabled:bg-blue-400 disabled:cursor-not-allowed text-white rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-green-500/30 disabled:transform-none">
                <svg wire:loading wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}" style="display: none;" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}">Kirim untuk Verifikasi</span>
                <span wire:loading wire:target="{{ $isStep2 ? 'submitProof1' : 'submitProof2' }}" style="display: none;">Memproses...</span>
              </button>
            </div>
            @endif
          </div>
        </div>        @else
          <!-- Step 4: Completed OR Failed -->
          <div class="p-6 sm:p-8">
            @if($this->isTaskRejectedAndCancelled())
              <div class="text-center py-12">
                <div class="w-24 h-24 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                  <svg class="w-12 h-12 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                </div>
                <h2 class="text-3xl font-bold text-red-600 dark:text-red-400 mb-2">Tugas Ditolak</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-6 max-w-md mx-auto">Pengiriman Anda ditolak oleh admin dan tugas telah dikembalikan ke daftar tersedia.</p>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-5 max-w-lg mx-auto">
                  <h3 class="font-semibold text-red-900 dark:text-red-200 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Catatan Admin:
                  </h3>
                  <p class="text-red-800 dark:text-red-300 mt-2 text-left">{{ $this->getRejectionFeedback() ?: 'Pengiriman Anda tidak memenuhi persyaratan.' }}</p>
                </div>
                <div class="mt-8">
                  <a href="{{ route('user.dashboard') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 active:scale-95 text-white rounded-lg font-medium transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Dashboard
                  </a>
                </div>
              </div>
            @else
              <div class="text-center py-12">
                @if($this->isCompletedButAwaitingPayment())
                  <!-- Completed but awaiting payment -->
                  <div class="w-24 h-24 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </div>
                  <h2 class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">⏳ Tugas Selesai!</h2>
                  <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-6 max-w-md mx-auto">Pekerjaan Anda telah diverifikasi dan disetujui. Pembayaran sedang diproses.</p>
                @else
                  <!-- Fully completed with payment -->
                  <div class="w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                  </div>
                  <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">🎉 Tugas Selesai!</h2>
                  <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-6 max-w-md mx-auto">Selamat! Anda berhasil menyelesaikan tugas ini dan telah menerima pembayaran.</p>
                @endif
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-5 max-w-lg mx-auto space-y-3">
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-green-800 dark:text-green-300">Status Akhir:</span>
                    <span class="px-3 py-1 bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">{{ \App\Models\UserTask::STATUSES[optional($userTask)->status] ?? 'Completed' }}</span>
                  </div>
                  @if(optional($userTask)->payment_amount)
                    <div class="flex justify-between items-center">
                      <span class="font-semibold text-green-800 dark:text-green-300">Hadiah:</span>
                      <span class="text-xl font-bold text-green-700 dark:text-green-300">Rp {{ number_format($userTask->payment_amount, 0, ',', '.') }}</span>
                    </div>
                  @endif
                  @if(optional($userTask)->payment_amount)
                    <div class="flex justify-between items-center">
                      <span class="font-semibold text-green-800 dark:text-green-300">Status Pembayaran:</span>
                      @if(optional($userTask)->payment_status === 'success')
                        <span class="px-3 py-1 bg-emerald-200 dark:bg-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-full text-sm font-medium flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                          Berhasil Dibayar
                        </span>
                      @elseif(optional($userTask)->payment_status === 'failed')
                        <span class="px-3 py-1 bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-200 rounded-full text-sm font-medium flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                          Pembayaran Gagal
                        </span>
                      @else
                        <span class="px-3 py-1 bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-full text-sm font-medium flex items-center gap-2">
                          <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                          Memproses Pembayaran
                        </span>
                      @endif
                    </div>
                    @if(optional($userTask)->payment_verified_at)
                      <div class="text-center pt-2 border-t border-green-200 dark:border-green-700">
                        <p class="text-xs text-green-700 dark:text-green-400">
                          Pembayaran diverifikasi pada {{ $userTask->payment_verified_at->format('d M Y \p\u\k\u\l H:i') }}
                        </p>
                      </div>
                    @endif
                  @endif
                </div>
              </div>
            @endif
          </div>
          <div class="bg-gray-50 dark:bg-zinc-800 px-6 sm:px-8 py-4 border-t border-zinc-200 dark:border-zinc-700">
            <div class="flex justify-center">
              <a href="{{ route('user.dashboard') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 active:scale-95 text-white rounded-lg font-semibold transition-all duration-200 shadow-lg hover:shadow-green-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Kembali ke Dashboard
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Floating Admin Contact Widget - Always Visible -->
  <div x-data="{ open: false }" class="fixed bottom-4 right-4 z-40">
    <!-- Floating Button (text only) -->
    <button 
      @click="open = !open" 
      class="inline-flex items-center justify-center px-4 py-2 min-w-[120px] sm:min-w-[160px] bg-gradient-to-br from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
      :class="{ 'ring-4 ring-green-300 dark:ring-green-700': open }"
      title="Butuh Bantuan?"
      aria-label="Butuh Bantuan?"
      :aria-expanded="open"
    >
      <span class="text-sm font-semibold tracking-tight">Butuh Bantuan?</span>
    </button>

    <!-- Contact Panel -->
    <div 
      x-show="open" 
      x-cloak
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 scale-95 translate-y-4"
      x-transition:enter-end="opacity-100 scale-100 translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 scale-100 translate-y-0"
      x-transition:leave-end="opacity-0 scale-95 translate-y-4"
      class="absolute bottom-16 right-0 w-80 sm:w-96 bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl border border-zinc-200 dark:border-zinc-700 overflow-hidden"
    >
      <!-- Header -->
      <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-white font-bold">Butuh Bantuan?</h3>
            <p class="text-green-100 text-sm">Hubungi admin jika ada kendala</p>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="p-4 space-y-4">
        <!-- Admin Info -->
        <div class="flex items-center gap-3 p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-xl">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-white text-lg font-bold">{{ substr(optional(optional($task)->creator)->name ?? 'A', 0, 1) }}</span>
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-semibold text-zinc-900 dark:text-white truncate">{{ optional(optional($task)->creator)->name ?? 'Admin' }}</p>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Admin Task</p>
            @if(optional(optional($task)->creator)->badge === 'premium_admin')
              <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 rounded text-xs font-medium mt-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                Premium Admin
              </span>
            @endif
          </div>
        </div>

        <!-- Contact Options -->
        <div class="space-y-2">
          @if(optional(optional($task)->creator)->whatsapp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', optional(optional($task)->creator)->whatsapp) }}?text={{ urlencode('Halo Admin, saya butuh bantuan untuk task: ' . optional($task)->title) }}" 
               target="_blank" 
               class="flex items-center gap-3 w-full px-4 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl font-medium transition-colors">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.148z"/></svg>
              <span>Chat via WhatsApp</span>
            </a>
          @endif

          @if(optional(optional($task)->creator)->phone)
            <a href="tel:{{ optional(optional($task)->creator)->phone }}" 
               class="flex items-center gap-3 w-full px-4 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-medium transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
              <span>Telepon: {{ optional(optional($task)->creator)->phone }}</span>
            </a>
          @endif

          @if(!optional(optional($task)->creator)->whatsapp && !optional(optional($task)->creator)->phone)
            <div class="text-center py-4 text-zinc-500 dark:text-zinc-400">
              <svg class="w-8 h-8 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p class="text-sm">Kontak admin belum tersedia</p>
              <p class="text-xs mt-1">Hubungi via grup WhatsApp task</p>
            </div>
          @endif
        </div>

        <!-- Help Tips -->
        <div class="pt-3 border-t border-zinc-200 dark:border-zinc-700">
          <p class="text-xs text-zinc-500 dark:text-zinc-400 text-center">
            💡 Jelaskan masalahmu dengan detail agar admin bisa membantu dengan cepat
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('livewire:init', function () {
    Livewire.on('redirect-to-dashboard', function () {
        window.location.href = '{{ route('user.dashboard') }}';
    });
});
</script>
