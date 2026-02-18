<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $identitasGlobal->nama_website ?? 'GK - Santo Yusup Bintaran' }}</title>

    @if(isset($identitasGlobal) && $identitasGlobal->logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $identitasGlobal->logo) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo-short.png') }}">
    @endif

    
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/carousels.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        html {
            overflow-y: scroll;
            overflow-x: hidden;
        }
        body {
            overflow: visible;
        }
    </style>
</head>
<body class="bg-clr-dominant flex flex-col min-h-screen">

@include('sweetalert::alert')
@include('components.navbar')

<section class="hero-section relative flex flex-col items-center justify-center pt-[120px] pb-[50px] md:pt-[100px] md:pb-[60px] @yield('hero-class', 'min-h-[180px] md:min-h-[250px] h-auto md:h-auto lg:h-auto') overflow-hidden" data-aos="fade-up">
    <div class="hero-overlay absolute inset-0 bg-secondary/85 mix-blend-multiply"></div>

    <div class="hero-inner relative z-10 w-full px-6 md:px-12 lg:px-20 text-center flex flex-col items-center justify-center flex-grow !min-h-0">
        <div class="hero-content text-light max-w-4xl text-white">

            @hasSection('hero-subtitle')
                <p class="hero-subtitle mb-4 fs-style-manrope uppercase tracking-[0.2em] opacity-85 text-xs md:text-xs">
                    @yield('hero-subtitle')
                </p>
            @endif

            <h1 class="hero-title fs-style-manrope text-xl sm:text-2xl md:text-3xl lg:text-4xl font-semibold max-w-4xl mx-auto">
                @yield('hero-title')
            </h1>

            @hasSection('hero-desc')
                <div class="hero-desc mt-2 md:mt-6 fs-style-manrope text-sm md:text-sm lg:text-base leading-snug md:leading-relaxed opacity-90 max-w-xl mx-auto">
                    @yield('hero-desc')
                </div>
            @endif

            @hasSection('hero-action')
                <div class="mt-8">
                    @yield('hero-action')
                </div>
            @endif

        </div>
    </div>
</section>

<main class="flex-grow">
    @yield('content')
</main>

@include('components.footer')

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    AOS.init();
</script>

@if(session('swal_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('swal_success') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#059669',
            customClass: {
                popup: 'colored-toast',
                title: 'text-[#3E0703] font-bold',
                htmlContainer: 'text-[#3E0703]/80'
            }
        });
    </script>
@endif

@if(session('swal_error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('swal_error') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#8C1007',
             customClass: {
                popup: 'colored-toast',
                title: 'text-[#8C1007] font-bold',
                htmlContainer: 'text-[#8C1007]/80'
            }
        });
    </script>
@endif

</body>
</html>

