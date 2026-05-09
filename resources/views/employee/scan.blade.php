{{-- resources/views/employee/scan.blade.php --}}
@extends('layouts.employee')
@section('title', 'Input OTP Absensi')

@section('content')
<div class="relative min-h-screen flex flex-col bg-white"
     x-data="otpComponent"
     x-init="init()">

    {{-- Header --}}
    <div class="relative z-10 px-6 pt-12 pb-6 flex items-center justify-between">
        <a href="{{ route('employee.dashboard') }}" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <h1 class="text-slate-800 font-bold text-lg">Input OTP Absensi</h1>
        <div class="w-10 h-10"></div> {{-- Spacer --}}
    </div>

    {{-- Main Content --}}
    <div class="relative z-10 flex flex-col items-center justify-center flex-1 px-6">
        
        {{-- Icon --}}
        <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center mb-6">
            <i class="fa-solid fa-key text-[#035EA1] text-3xl"></i>
        </div>

        {{-- Instructions --}}
        <div class="text-center mb-8">
            <h2 class="text-xl font-bold text-slate-800 mb-2">Masukkan 4-Digit Kode</h2>
            <p class="text-sm text-slate-500">Masukkan kode yang ditampilkan di dashboard admin</p>
        </div>

        {{-- OTP Input --}}
        <div class="flex gap-4 mb-8">
            <template x-for="(digit, index) in otp" :key="index">
                <input type="text" 
                       maxlength="1" 
                       x-model="otp[index]"
                       @input="handleInput($event, index)"
                       @keydown.backspace="handleBackspace($event, index)"
                       class="w-14 h-14 border-2 rounded-xl text-center text-2xl font-bold text-slate-800 focus:outline-none focus:border-[#035EA1] focus:ring-2 focus:ring-blue-100 transition-all"
                       :class="otp[index] ? 'border-[#035EA1] bg-blue-50/50' : 'border-slate-200 bg-slate-50'"
                       :id="'otp-' + index"
                       inputmode="numeric"
                       pattern="[0-9]*">
            </template>
        </div>

        {{-- Submit Button (Manual fallback or status) --}}
        <button @click="submitOTP" 
                :disabled="isSubmitting || otp.join('').length < 4"
                class="w-full max-w-xs py-4 rounded-full font-bold text-white text-sm active:scale-95 transition-all flex items-center justify-center gap-2"
                :class="otp.join('').length === 4 && !isSubmitting ? 'bg-[#035EA1] hover:bg-[#024d85]' : 'bg-slate-300 cursor-not-allowed'">
            <template x-if="isSubmitting">
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
            </template>
            <span x-text="isSubmitting ? 'Memproses...' : 'Verifikasi'"></span>
        </button>

        <a href="{{ route('employee.dashboard') }}"
           class="mt-4 text-sm font-semibold text-slate-500 hover:text-slate-700">
            Batal
        </a>
    </div>

    {{-- ════════════════════════════════════════
         MODAL: SUCCESS
    ════════════════════════════════════════ --}}
    <div x-show="showSuccess" x-transition.opacity
         class="absolute inset-0 z-50 flex items-center justify-center bg-black/60 px-6">
        <div x-show="showSuccess"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white rounded-3xl p-8 w-full max-w-xs text-center shadow-2xl">

            {{-- Success animation ring --}}
            <div class="relative w-24 h-24 mx-auto mb-5">
                <div class="absolute inset-0 rounded-full bg-emerald-100 animate-ping opacity-30"></div>
                <div class="relative w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-5xl"></i>
                </div>
            </div>

            <h2 class="text-xl font-extrabold text-slate-800 mb-1" x-text="scanMessage || 'Presensi Berhasil!'"></h2>
            <p class="text-sm text-slate-400 mb-1">Tercatat</p>
            <p class="text-2xl font-bold text-[#1E2A5E] mb-6"><span x-text="scanTime"></span> WIB</p>

            <div class="bg-slate-50 rounded-xl p-3 mb-6 text-left space-y-2">
                <div class="flex justify-between text-xs">
                    <span class="text-slate-400">Nama</span>
                    <span class="font-semibold text-slate-700">{{ auth()->user()->name ?? 'Budi Santoso' }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-slate-400">Tanggal</span>
                    <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-slate-400">Tipe</span>
                    <span class="font-semibold text-emerald-600" x-text="scanType"></span>
                </div>
            </div>

            <button @click="showSuccess = false; window.location='{{ route('employee.dashboard') }}'"
                    class="w-full py-4 rounded-full font-bold text-white text-sm active:scale-95 transition-all bg-[#035EA1] hover:bg-[#024d85]">
                <i class="fa-solid fa-house mr-2"></i>OK, Kembali ke Beranda
            </button>
        </div>
    </div>

    {{-- ════════════════════════════════════════
         MODAL: FAIL
    ════════════════════════════════════════ --}}
    <div x-show="showFail" x-transition.opacity
         class="absolute inset-0 z-50 flex items-center justify-center bg-black/60 px-6">
        <div x-show="showFail"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white rounded-3xl p-8 w-full max-w-xs text-center shadow-2xl">

            {{-- Fail animation ring --}}
            <div class="relative w-24 h-24 mx-auto mb-5">
                <div class="absolute inset-0 rounded-full bg-red-100 animate-ping opacity-30"></div>
                <div class="relative w-24 h-24 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fa-solid fa-circle-xmark text-red-500 text-5xl"></i>
                </div>
            </div>

            <p class="text-xs font-bold tracking-widest text-red-400 uppercase mb-1">MAAF</p>
            <h2 class="text-xl font-extrabold text-slate-800 mb-2">Presensi Gagal</h2>
            <p class="text-sm text-slate-400 mb-6">OTP tidak valid atau sudah kedaluwarsa.<br>Coba lagi dengan kode yang baru.</p>

            <div class="space-y-3">
                <button @click="showFail = false; resetOTP()"
                        class="w-full py-4 rounded-full font-bold text-white text-sm active:scale-95 transition-all bg-red-500 hover:bg-red-600">
                    <i class="fa-solid fa-rotate-right mr-2"></i>Coba Lagi
                </button>
                <a href="{{ route('employee.dashboard') }}"
                   class="block w-full py-3.5 rounded-full font-semibold text-slate-500 text-sm border border-slate-200 active:scale-95 transition-all">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('otpComponent', () => ({
        otp: ['', '', '', ''],
        isSubmitting: false,
        showSuccess: false,
        showFail: false,
        scanMessage: '',
        scanTime: '',
        scanType: '',
        
        init() {
            this.$nextTick(() => {
                const el = document.getElementById('otp-0');
                if (el) el.focus();
            });
        },
        
        handleInput(e, index) {
            const value = e.target.value;
            // Only allow numbers
            if (!/^[0-9]$/.test(value)) {
                this.otp[index] = '';
                return;
            }
            
            this.otp[index] = value;
            
            // Auto focus next
            if (index < 3 && value) {
                const nextEl = document.getElementById(`otp-${index + 1}`);
                if (nextEl) nextEl.focus();
            }
            
            // Auto submit
            if (this.otp.join('').length === 4) {
                this.submitOTP();
            }
        },
        
        handleBackspace(e, index) {
            if (e.key === 'Backspace' && !this.otp[index] && index > 0) {
                const prevEl = document.getElementById(`otp-${index - 1}`);
                if (prevEl) prevEl.focus();
            }
        },
        
        resetOTP() {
            this.otp = ['', '', '', ''];
            this.$nextTick(() => {
                const el = document.getElementById('otp-0');
                if (el) el.focus();
            });
        },
        
        async submitOTP() {
            if (this.isSubmitting) return;
            
            this.isSubmitting = true;
            const code = this.otp.join('');
            
            try {
                const res = await fetch('{{ route("employee.verify-otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ otp: code })
                });
                
                const data = await res.json();
                
                if (data.success) {
                    this.scanMessage = data.message;
                    this.scanTime = data.time;
                    this.scanType = data.type;
                    this.showSuccess = true;
                } else {
                    this.showFail = true;
                }
            } catch (err) {
                console.error(err);
                this.showFail = true;
            } finally {
                this.isSubmitting = false;
            }
        }
    }));
});
</script>
@endpush
