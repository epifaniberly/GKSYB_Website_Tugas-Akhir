<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Admin GKSYB</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="bg-[#FCFAF7] fs-style-manrope">
    @include('sweetalert::alert')
    
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md p-8 bg-white shadow-xl rounded-2xl border border-gray-100">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 bg-[#FDF2F2] rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-[#8C1007]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-900">Lupa Password?</h2>
                <p class="text-sm text-gray-500 text-center mt-2 px-2">
                    Masukkan email Anda untuk menerima kode verifikasi pemulihan akun.
                </p>
            </div>

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Email Terdaftar</label>
                    <input 
                        type="email" 
                        name="email"
                        required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#8C1007]/20 focus:border-[#8C1007] transition-all"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full bg-[#3E0703] text-white font-semibold py-3 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-[#3E0703]/10">
                        Kirim Kode Verifikasi
                    </button>
                    <a href="{{ route('login.index') }}" class="text-center text-sm font-semibold text-gray-400 hover:text-gray-600 transition-colors py-2">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

