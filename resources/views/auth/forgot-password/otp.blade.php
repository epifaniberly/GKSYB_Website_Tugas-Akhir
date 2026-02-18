<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikasi Kode - Admin GKSYB</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="bg-[#FCFAF7] fs-style-manrope">
    @include('sweetalert::alert')
    
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md p-8 bg-white shadow-xl rounded-2xl border border-gray-100">
            <div class="flex flex-col items-center mb-8 text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-900">Verifikasi Kode</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Kami telah mengirimkan 6 digit kode ke:<br>
                    <span class="font-semibold text-gray-900">{{ $email }}</span>
                </p>
            </div>

            <form action="{{ route('password.verify_otp') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Kode OTP</label>
                    <input 
                        type="text" 
                        name="otp"
                        maxlength="6"
                        required
                        autofocus
                        class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-center text-2xl font-semibold tracking-[0.5em]"
                        placeholder="000000"
                    />
                    @error('otp')
                        <p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full bg-[#3E0703] text-white font-semibold py-3 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-[#3E0703]/10">
                        Verifikasi Kode
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-500">
                    Tidak menerima kode? 
                </p>
                <form action="{{ route('password.email') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="text-sm font-semibold text-[#8C1007] hover:underline">
                        Kirim Ulang Kode
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

