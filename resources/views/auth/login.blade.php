<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication Page</title>

    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body >
    @include('sweetalert::alert')
    
    <main >
        <div class="min-h-screen bg-[#FCFAF7] flex items-center justify-center p-4 fs-style-manrope ">
            <div class="w-full max-w-md p-8 bg-white shadow-xl rounded-xl">
                <div class="flex flex-col items-center justify-center ">
                    <img src="{{ asset('assets/logogereja.png') }}" class="mb-2 w-25 h-25" alt="Logo">
                    <h2 class="text-2xl font-semibold text-center text-gray-900">Admin Panel</h2>
                    <p class="font-thin text-center text-gray-900 text-md ">Gereja Santo Yusup Bintaran</p>
                </div>
                
                <form class="space-y-4" method="POST" action="{{ route('login.authenticate') }}">
                    @csrf
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                        <input 
                        type="email" 
                        name="email"
                        class="w-full px-4 py-2 transition-all border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="your@email.com"
                        />
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>

                        <div class="relative">
                            <input 
                                id="password"
                                type="password" 
                                name="password"
                                class="w-full px-4 py-2 pr-10 transition-all border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="••••••••"
                            />

                            <span 
                                onclick="togglePassword()"
                                class="absolute inset-y-0 flex items-center cursor-pointer right-3"
                            >
                                <svg id="eyeOpen" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="eyeClose" class="hidden w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold text-[#8C1007] hover:underline transition-all">
                            Lupa Password?
                        </a>
                    </div>

                    <button type="submit" class="w-full bg-[#3E0703] hover:bg-[#5A0A06]/30 text-white font-medium py-2.5 rounded-lg transition-colors">
                        Masuk
                    </button>
                </form>
            </div>
            </div>
    </main>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();

        function togglePassword() {
            const password = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClose = document.getElementById('eyeClose');

            if (password.type === "password") {
                password.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClose.classList.remove("hidden");
            } else {
                password.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClose.classList.add("hidden");
            }
        }
    </script>
</body>
</html>
