<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    </style>
    <style>
        body, html {
            font-family: 'Manrope', sans-serif !important;
            font-weight: 500 !important;
            overflow-x: hidden !important; 
            width: 100%;
        }
        
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        textarea:-webkit-autofill:active,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus,
        select:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
            -webkit-text-fill-color: inherit !important;
            transition: background-color 5000s ease-in-out 0s;
        }
        
        input.border-red-500:-webkit-autofill,
        input.border-red-500:-webkit-autofill:hover,
        input.border-red-500:-webkit-autofill:focus,
        textarea.border-red-500:-webkit-autofill,
        textarea.border-red-500:-webkit-autofill:hover,
        textarea.border-red-500:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #fef2f2 inset !important;
            -webkit-text-fill-color: #7f1d1d !important;
        }
        
        button:focus, a:focus, input:focus, select:focus, textarea:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        @media (max-width: 767px) {
            select, input, textarea {
                max-width: 100% !important;
                min-width: 0 !important;
                font-size: 16px !important; 
            }
            
            .overflow-x-auto {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .overflow-x-auto::-webkit-scrollbar {
                display: none;
            }
            
            main, .container {
                transform: none !important;
            }
            
            select, input, textarea {
                font-size: 13px !important; 
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .swal2-popup {
                padding: 1rem !important;
                width: 90% !important;
                border-radius: 1.25rem !important;
            }
            .swal2-title {
                font-size: 1.15rem !important;
                margin-bottom: 0.5rem !important;
            }
            .swal2-html-container {
                font-size: 0.85rem !important;
                margin: 0.5rem 0 0 !important;
            }
            .swal2-icon {
                transform: scale(0.6) !important;
                margin: -0.5rem auto 0.5rem !important;
            }
            .swal2-actions {
                margin-top: 1rem !important;
                gap: 0.5rem !important;
            }
            .swal2-styled {
                padding: 0.5rem 1.25rem !important;
                font-size: 0.85rem !important;
            }
        }
        .admin-page-title {
            font-family: 'Manrope', sans-serif !important;
            color: #3E0703 !important;
            font-weight: 800 !important;
            font-size: 20px !important;
        }
        @media (min-width: 768px) {
            .admin-page-title {
                font-size: 26px !important;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{asset('assets/admin/css/tailwind.output.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/tailwind.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"
      defer
    ></script>
    <script>
    function data() {
      function getThemeFromLocalStorage() {
        if (window.localStorage.getItem('dark')) {
          return JSON.parse(window.localStorage.getItem('dark'))
        }
        return (
          !!window.matchMedia &&
          window.matchMedia('(prefers-color-scheme: dark)').matches
        )
      }

      function setThemeToLocalStorage(value) {
        window.localStorage.setItem('dark', value)
      }

      return {
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
          this.dark = !this.dark
          setThemeToLocalStorage(this.dark)
        },
        isDesktopSidebarCollapsed: false,
        toggleDesktopSidebar() {
            this.isDesktopSidebarCollapsed = !this.isDesktopSidebarCollapsed
            this.isSideMenuOpen = false
        },
        toggleSidebar() {
            console.log('toggleSidebar called. Width:', window.innerWidth);
            if (window.innerWidth >= 768) {
                console.log('Toggling Desktop Sidebar');
                this.toggleDesktopSidebar()
            } else {
                console.log('Toggling Mobile Sidebar');
                this.toggleSideMenu()
            }
        },
        isSideMenuOpen: false,
        toggleSideMenu() {
          this.isSideMenuOpen = !this.isSideMenuOpen
        },
        closeSideMenu() {
          this.isSideMenuOpen = false
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
          this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
        },
        closeNotificationsMenu() {
          this.isNotificationsMenuOpen = false
        },
        isProfileMenuOpen: false,
        toggleProfileMenu() {
          this.isProfileMenuOpen = !this.isProfileMenuOpen
        },
        closeProfileMenu() {
          this.isProfileMenuOpen = false
        },
        isPagesMenuOpen: false,
        togglePagesMenu() {
          this.isPagesMenuOpen = !this.isPagesMenuOpen
        },
        isKomunikasiMenuOpen: {{ request()->routeIs('admin.terhubung.*') || request()->routeIs('admin.doa.*') ? 'true' : 'false' }},
        toggleKomunikasiMenu() {
            this.isKomunikasiMenuOpen = !this.isKomunikasiMenuOpen
        },
        isModalOpen: false,
        trapCleanup: null,
        openModal() {
          this.isModalOpen = true
          this.trapCleanup = focusTrap(document.querySelector('#modal'))
        },
        closeModal() {
          this.isModalOpen = false
          this.trapCleanup()
        },
      }
    }
    
    function globalSearch() {
        return {
            query: '',
            showResults: false,
            selectedIndex: 0,
            filteredResults: [],
            searchItems: [
                { title: 'Dashboard', category: 'Dashboard', url: '{{ route("admin.dashboard.index") }}', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', keywords: ['dashboard', 'beranda', 'home'] },
                
                { title: 'Tulisan Bintaran', category: 'Konten dan Publikasi', url: '{{ route("admin.blog.index") }}', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', keywords: ['tulisan', 'bintaran', 'artikel', 'blog', 'post'] },
                { title: 'Jadwal Doa & Ekaristi', category: 'Konten dan Publikasi', url: '{{ route("admin.jadwal.index") }}', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', keywords: ['jadwal', 'doa', 'ekaristi', 'misa', 'schedule'] },
                
                { title: 'Dokumen Paroki', category: 'Dokumen dan Media', url: '{{ route("admin.dokparoki.index") }}', icon: 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z', keywords: ['dokumen', 'paroki', 'file', 'folder'] },
                { title: 'Panduan Perayaan', category: 'Dokumen dan Media', url: '{{ route("admin.panduan.index") }}', icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', keywords: ['panduan', 'perayaan', 'ekaristi', 'guide'] },
                { title: 'Galeri & Dokumentasi', category: 'Dokumen dan Media', url: '{{ route("admin.gallery.index") }}', icon: 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', keywords: ['galeri', 'gallery', 'foto', 'photo', 'dokumentasi'] },
                
                { title: 'Tilik Sejarah', category: 'Profil Gereja', url: '{{ route("admin.sejarah.index") }}', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', keywords: ['sejarah', 'history', 'tilik'] },
                { title: 'Sakramen', category: 'Profil Gereja', url: '{{ route("admin.sakramen.index") }}', icon: 'M12 4v16m8-8H4', keywords: ['sakramen', 'sacrament'] },
                { title: 'Donasi & Persembahan', category: 'Profil Gereja', url: '{{ route("admin.donasi.index") }}', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', keywords: ['donasi', 'persembahan', 'donation', 'offering'] },
                { title: 'Pastor Paroki', category: 'Profil Gereja', url: '{{ route("admin.paroki.index") }}', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', keywords: ['pastor', 'paroki', 'priest'] },
                
                { title: 'Mari Terhubung', category: 'Komunikasi Umat', url: '{{ route("admin.terhubung.index") }}', icon: 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', keywords: ['mari', 'terhubung', 'pesan', 'message', 'contact'] },
                { title: 'Intensi / Ujud Doa', category: 'Komunikasi Umat', url: '{{ route("admin.doa.index") }}', icon: 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', keywords: ['intensi', 'ujud', 'doa', 'prayer'] },
                { title: 'Soal Sering Ditanya', category: 'Komunikasi Umat', url: '{{ route("admin.faq.index") }}', icon: 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', keywords: ['faq', 'soal', 'sering', 'ditanya', 'question'] },
                
                { title: 'Pengguna & Akses', category: 'Manajemen Sistem', url: '{{ route("admin.role.index") }}', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', keywords: ['pengguna', 'akses', 'user', 'role', 'admin'] },
                { title: 'Pengaturan Website', category: 'Manajemen Sistem', url: '{{ route("admin.settings.index") }}', icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', keywords: ['pengaturan', 'settings', 'konfigurasi', 'config'] },
            ],
            
            search() {
                if (this.query.trim() === '') {
                    this.filteredResults = [];
                    return;
                }
                
                const searchTerm = this.query.toLowerCase();
                this.filteredResults = this.searchItems.filter(item => {
                    return item.title.toLowerCase().includes(searchTerm) ||
                           item.category.toLowerCase().includes(searchTerm) ||
                           item.keywords.some(keyword => keyword.includes(searchTerm));
                }).slice(0, 8); 
                
                this.selectedIndex = 0;
            },
            
            navigateResults(direction) {
                if (this.filteredResults.length === 0) return;
                
                if (direction === 'down') {
                    this.selectedIndex = (this.selectedIndex + 1) % this.filteredResults.length;
                } else {
                    this.selectedIndex = this.selectedIndex === 0 ? this.filteredResults.length - 1 : this.selectedIndex - 1;
                }
            },
            
            selectResult() {
                if (this.filteredResults.length > 0 && this.filteredResults[this.selectedIndex]) {
                    window.location.href = this.filteredResults[this.selectedIndex].url;
                }
            }
        };
    }
    </script>
    <link rel="stylesheet" href="{{asset('assets/style.css')}}" />

    <script src="{{asset('assets/admin/js/focus-trap.js')}}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 "
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      @include('admin.components.sidebar')
      @include('admin.components.backdrop')
      
      <main class="h-full overflow-y-auto overflow-x-hidden">
        <div class="w-full max-w-7xl px-4 sm:px-6 py-6 mx-auto">
          @yield('content')
        </div>
      </main>
    </div>
  </div>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="{{ asset('js/swal-helper.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('swal_success'))
                SwalHelper.success('Berhasil', '{{ session('swal_success') }}');
            @elseif(session('success'))
                SwalHelper.success('Berhasil', '{{ session('success') }}');
            @endif
            
            @if(session('swal_error'))
                SwalHelper.error('Gagal', '{{ session('swal_error') }}');
            @elseif(session('error'))
                SwalHelper.error('Gagal', '{{ session('error') }}');
            @endif
        });
    </script>
    
    @stack('script')
  </body>
</html>

