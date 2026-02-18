<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password - Admin GKSYB</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="bg-[#FCFAF7] fs-style-manrope">
    @include('sweetalert::alert')
    
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md p-8 bg-white shadow-xl rounded-2xl border border-gray-100">
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-4 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-900">Password Baru</h2>
                <p class="text-sm text-gray-500 mt-2">Buat password baru yang kuat untuk akun Anda.</p>
            </div>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Password Baru</label>
                    <div class="relative">
                        <input 
                            id="password"
                            type="password" 
                            name="password"
                            required
                            onfocus="showTooltip()" onblur="hideTooltip()" oninput="validate(this.value)"
                            class="w-full px-4 py-3 pr-12 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] transition-all"
                            placeholder="••••••••"
                        />
                        <button type="button" onclick="toggleOnePassword('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                    <div id="tooltip" class="hidden mt-3 bg-gray-50 rounded-xl p-4 border border-gray-100 transition-all">
                        <p class="text-[11px] font-semibold text-gray-700 mb-2">Syarat Password:</p>
                        <ul class="space-y-1.5 text-[11px]">
                            <li id="req_min" class="flex items-center gap-2 text-gray-400 transition-colors">
                                <span class="ict text-[10px]">○</span> <span>Minimal 8 Karakter</span>
                            </li>
                            <li id="req_upper" class="flex items-center gap-2 text-gray-400 transition-colors">
                                <span class="ict text-[10px]">○</span> <span>Huruf Besar (A-Z)</span>
                            </li>
                            <li id="req_num" class="flex items-center gap-2 text-gray-400 transition-colors">
                                <span class="ict text-[10px]">○</span> <span>Angka (0-9)</span>
                            </li>
                            <li id="req_sym" class="flex items-center gap-2 text-gray-400 transition-colors">
                                <span class="ict text-[10px]">○</span> <span>Simbol (@#$)</span>
                            </li>
                            <li id="req_space" class="flex items-center gap-2 text-gray-400 transition-colors">
                                <span class="ict text-[10px]">○</span> <span>Tidak ada spasi</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input 
                            id="password_confirmation"
                            type="password" 
                            name="password_confirmation"
                            required
                            class="w-full px-4 py-3 pr-12 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] transition-all"
                            placeholder="••••••••"
                        />
                        <button type="button" onclick="toggleOnePassword('password_confirmation', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#8C1007] text-white font-semibold py-3 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-[#8C1007]/20 mt-4">
                    Update Password
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleOnePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            }
        }

        function showTooltip() { document.getElementById('tooltip').classList.remove('hidden'); }
        function hideTooltip() { document.getElementById('tooltip').classList.add('hidden'); }
        
        function validate(val) {
            const reqs = {
                min: val.length >= 8,
                upper: /[A-Z]/.test(val),
                num: /[0-9]/.test(val),
                sym: /[^A-Za-z0-9]/.test(val),
                space: !/\s/.test(val) && val.length > 0
            };

            Object.keys(reqs).forEach(key => {
                const el = document.getElementById('req_' + key);
                if (!el) return;
                const icon = el.querySelector('.ict');
                if (reqs[key]) {
                    el.classList.replace('text-gray-400', 'text-green-600');
                    el.classList.add('font-bold');
                    if (icon) icon.innerText = '●';
                } else {
                    el.classList.replace('text-green-600', 'text-gray-400');
                    el.classList.remove('font-bold');
                    if (icon) icon.innerText = '○';
                }
            });
        }
    </script>
</body>
</html>

