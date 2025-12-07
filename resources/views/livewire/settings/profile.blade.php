<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';
    public ?string $phone = null;
    public ?string $whatsapp = null;
    public ?string $ewallet_type = null;
    public ?string $ewallet_number = null;
    public ?string $ewallet_name = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->phone;
        $this->whatsapp = Auth::user()->whatsapp;
        $this->ewallet_type = Auth::user()->ewallet_type;
        $this->ewallet_number = Auth::user()->ewallet_number;
        $this->ewallet_name = Auth::user()->ewallet_name;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            
            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'ewallet_type' => ['nullable', 'string', Rule::in(array_keys(User::EWALLETS))],
            'ewallet_number' => ['nullable', 'string', 'max:20'],
            'ewallet_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your personal information and e-wallet details')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Contact Information Section -->
            <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                        <span class="text-xl">📞</span>
                        Contact Information
                    </h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">
                        Add your phone and WhatsApp number for task-related communication
                    </p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                            Phone Number
                        </label>
                        <input 
                            type="tel"
                            wire:model="phone"
                            placeholder="08123456789"
                            autocomplete="tel"
                            class="w-full px-4 py-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-zinc-700 dark:text-white transition-all"
                        />
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Your phone number for task support contact</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.148z"/></svg>
                            WhatsApp Number
                        </label>
                        <input 
                            type="tel"
                            wire:model="whatsapp"
                            placeholder="6281234567890 (with country code)"
                            autocomplete="tel"
                            class="w-full px-4 py-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-zinc-700 dark:text-white transition-all"
                        />
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Your WhatsApp number for direct chat support (with country code, e.g. 628xxx)</p>
                    </div>

                    @if($phone || $whatsapp)
                        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-green-900 dark:text-green-100">Contact Info Configured</h4>
                                    <p class="text-xs text-green-700 dark:text-green-300 mt-1">
                                        @if($phone)
                                            📞 Phone: {{ $phone }}<br>
                                        @endif
                                        @if($whatsapp)
                                            💬 WhatsApp: {{ $whatsapp }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- E-Wallet Section -->
            <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                        <span class="text-xl">💳</span>
                        E-Wallet Information
                    </h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">
                        Update your e-wallet for payment disbursement
                    </p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                            E-Wallet Type
                        </label>
                        <select 
                            wire:model="ewallet_type" 
                            class="w-full px-4 py-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-zinc-700 dark:text-white transition-all"
                        >
                            <option value="">Choose e-wallet...</option>
                            @foreach(\App\Models\User::EWALLETS as $key => $label)
                                <option value="{{ $key }}">
                                    @switch($key)
                                        @case('gopay')
                                            💚 {{ $label }}
                                            @break
                                        @case('ovo')
                                            💜 {{ $label }}
                                            @break
                                        @case('dana')
                                            💙 {{ $label }}
                                            @break
                                        @case('shopeepay')
                                            🧡 {{ $label }}
                                            @break
                                        @case('linkaja')
                                            ❤️ {{ $label }}
                                            @break
                                    @endswitch
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                            E-Wallet Number/Phone
                        </label>
                        <input 
                            type="text"
                            wire:model="ewallet_number"
                            placeholder="08123456789"
                            autocomplete="tel"
                            class="w-full px-4 py-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-zinc-700 dark:text-white transition-all"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                            E-Wallet Account Name
                        </label>
                        <input 
                            type="text"
                            wire:model="ewallet_name"
                            placeholder="Enter name registered to e-wallet"
                            autocomplete="name"
                            class="w-full px-4 py-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-zinc-700 dark:text-white transition-all"
                        />
                    </div>

                    @if($ewallet_type && $ewallet_number)
                        <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-green-900 dark:text-green-100">E-Wallet Configured</h4>
                                    <p class="text-xs text-green-700 dark:text-green-300 mt-1">
                                        {{ \App\Models\User::EWALLETS[$ewallet_type] ?? $ewallet_type }} - {{ $ewallet_number }}
                                        @if($ewallet_name)
                                            <br>Account: {{ $ewallet_name }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-yellow-900 dark:text-yellow-100">No E-Wallet Set</h4>
                                    <p class="text-xs text-yellow-700 dark:text-yellow-300 mt-1">
                                        Please configure your e-wallet to receive payments
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
