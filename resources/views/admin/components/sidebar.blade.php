@php
    $user = auth()->user();
    $role = $user->role_type;
    $roleName = match($role) {
        2 => 'Super Admin',
        1 => 'Admin',
        default => 'User'
    };
@endphp

<aside class="z-20 hidden bg-white shadow md:!flex flex-col h-screen overflow-hidden shrink-0 font-manrope transition-all duration-300 ease-in-out"
       :class="isDesktopSidebarCollapsed ? 'w-20' : 'w-64'">
    <div class="flex-shrink-0 py-6 flex items-center justify-center min-h-[88px]">
        <a href="#">
            <img x-show="!isDesktopSidebarCollapsed" src="{{ asset('assets/logo.png') }}" class="w-[180px] transition-all duration-300" alt="Logo">
            <img x-show="isDesktopSidebarCollapsed" src="{{ asset('assets/logo-short.png') }}" class="w-10 h-10 object-contain transition-all duration-300" style="display: none;" alt="Logo">
        </a>
    </div>
    <div class="flex-1 overflow-y-auto custom-scrollbar px-2 space-y-4 pb-4">
        @if(in_array($role, [1, 2]))
        <div>
            <p x-show="!isDesktopSidebarCollapsed" class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2 transition-all duration-300">Dashboard</p>
            <ul class="space-y-1">
                <li class="relative">
                    @if(request()->routeIs('admin.dashboard.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg" aria-hidden="true"></span>
                    @endif
                    <a href="{{ route('admin.dashboard.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.dashboard.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/dashboard.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif
        <div>
            <p x-show="!isDesktopSidebarCollapsed" class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2 transition-all duration-300">Konten dan Publikasi</p>
            <ul class="space-y-1">
                @if($role == 2)
                <li class="relative">
                    @if(request()->routeIs('admin.blog.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.blog.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.blog.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/doc.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Tulisan Bintaran</span>
                    </a>
                </li>
                @endif
                <li class="relative">
                    @if(request()->routeIs('admin.jadwal.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.jadwal.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.jadwal.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/cal.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Jadwal Doa & Ekaristi</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <p x-show="!isDesktopSidebarCollapsed" class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2 transition-all duration-300">Dokumen dan Media</p>
            <ul class="space-y-1">
                <li class="relative">
                    @if(request()->routeIs('admin.dokparoki.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.dokparoki.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.dokparoki.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/folder.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Dokumen Paroki</span>
                    </a>
                </li>

                <li class="relative">
                    @if(request()->routeIs('admin.panduan.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.panduan.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.panduan.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/book.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Panduan Perayaan</span>
                    </a>
                </li>
                @if($role == 2)
                <li class="relative">
                    @if(request()->routeIs('admin.gallery.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.gallery.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.gallery.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/gal.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Galeri & Dokumentasi</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div>
            <p x-show="!isDesktopSidebarCollapsed" class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2 transition-all duration-300">Profil Gereja</p>
            <ul class="space-y-1">
                @if($role == 2)
                <li class="relative">
                    @if(request()->routeIs('admin.sejarah.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.sejarah.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.sejarah.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/home.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Tilik Sejarah</span>
                    </a>
                </li>
                @endif
                <li class="relative">
                    @if(request()->routeIs('admin.sakramen.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.sakramen.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.sakramen.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/plus.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Sakramen</span>
                    </a>
                </li>

                <li class="relative">
                    @if(request()->routeIs('admin.donasi.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.donasi.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.donasi.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/dollar.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Donasi & Persembahan</span>
                    </a>
                </li>

                <li class="relative">
                    @if(request()->routeIs('admin.paroki.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.paroki.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.paroki.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/user.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Pastor Paroki</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <p x-show="!isDesktopSidebarCollapsed" class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2 transition-all duration-300">Komunikasi Umat</p>
            <ul class="space-y-1">
                <li class="relative">
                    @if(request()->routeIs('admin.terhubung.*') || request()->routeIs('admin.doa.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg" aria-hidden="true"></span>
                    @endif
                    <button type="button" @click.stop="if(isDesktopSidebarCollapsed) { toggleDesktopSidebar(); setTimeout(() => isKomunikasiMenuOpen = true, 300); } else { toggleKomunikasiMenu(); }"
                            class="flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg focus:outline-none
                            {{ (request()->routeIs('admin.terhubung.*') || request()->routeIs('admin.doa.*')) ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }}"
                            :class="isDesktopSidebarCollapsed ? 'justify-center' : 'justify-between px-4'">
                        <span class="flex items-center">
                            <img src="{{ asset('sidebaricon/email.png') }}" class="w-5 h-5" alt="">
                            <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300 !text-[13px] !sm:text-[14px] font-semibold">Pesan Masuk</span>
                        </span>
                        <svg x-show="!isDesktopSidebarCollapsed" class="w-4 h-4 transition-transform duration-200" :class="isKomunikasiMenuOpen ? 'rotate-180' : ''"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul x-show="isKomunikasiMenuOpen && !isDesktopSidebarCollapsed" x-transition class="mt-1 space-y-1 overflow-hidden !text-[13px] !sm:text-[14px] font-semibold text-gray-500">
                        <li class="py-1 transition-colors pl-12 {{ request()->routeIs('admin.terhubung.*') ? 'font-semibold text-gray-900' : 'hover:text-gray-800' }}">
                            <a href="{{ route('admin.terhubung.index') }}" class="block w-full">Mari Terhubung</a>
                        </li>
                        <li class="py-1 transition-colors pl-12 {{ request()->routeIs('admin.doa.*') ? 'font-semibold text-gray-900' : 'hover:text-gray-800' }}">
                            <a href="{{ route('admin.doa.index') }}" class="block w-full">Intensi / Ujud Doa</a>
                        </li>
                    </ul>
                </li>
                @if($role == 2)
                <li class="relative">
                    @if(request()->routeIs('admin.faq.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.faq.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.faq.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/ssd.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Soal Sering Ditanya</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div>
            <p x-show="!isDesktopSidebarCollapsed" class="px-4 text-xs font-semibold text-gray-400 uppercase mb-2 transition-all duration-300">Manajemen Sistem</p>
            <ul class="space-y-1">
                @if($role == 2)
                <li class="relative">
                    @if(request()->routeIs('admin.role.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.role.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.role.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/user.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Pengguna & Akses</span>
                    </a>
                </li>
                @endif
                <li class="relative">
                    @if(request()->routeIs('admin.settings.*'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                    @endif
                    <a href="{{ route('admin.settings.index') }}"
                       class="inline-flex items-center w-full py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                       {{ request()->routeIs('admin.settings.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none"
                       :class="isDesktopSidebarCollapsed ? 'justify-center' : 'px-4'">
                        <img src="{{ asset('sidebaricon/settings.png') }}" class="w-5 h-5" alt="">
                        <span x-show="!isDesktopSidebarCollapsed" class="ml-3 transition-all duration-300">Pengaturan Website</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex-shrink-0 border-t border-gray-100 p-4 bg-gray-50/50">
        <div class="flex items-center gap-3 mb-4" :class="isDesktopSidebarCollapsed ? 'justify-center' : ''">
            <div class="w-10 h-10 rounded-full bg-[#8C1007] text-white flex items-center justify-center !text-[13px] !sm:text-[14px] font-semibold shrink-0 overflow-hidden">
                @if(!empty($user->foto_profil))
                    <img src="{{ asset('storage/ProfileMedia/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                @else
                    {{ substr($user->name, 0, 2) }}
                @endif
            </div>
            <div class="overflow-hidden" x-show="!isDesktopSidebarCollapsed">
                <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</h4>
                <div class="flex items-center mt-0.5">
                    <span class="px-1.5 py-0.5 text-[10px] font-medium bg-[#8C1007] text-white rounded">
                        {{ strtoupper($roleName) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-gray-100/80 rounded-lg p-3 mb-3" x-show="!isDesktopSidebarCollapsed">
             <p class="text-[10px] text-gray-500 uppercase font-semibold mb-1">Akses Menu</p>
             <p class="text-xs text-gray-600">
                {{ $role == 2 ? 'Akses penuh ke semua fitur' : 'Akses dashboard & operasional' }}
             </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button"
                    onclick="event.preventDefault(); Swal.fire({
                        title: 'Yakin ingin keluar?',
                        text: 'Sesi Anda akan berakhir.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#8C1007',
                        cancelButtonColor: '#6B7280',
                        confirmButtonText: 'Ya, Keluar',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-5 py-4',
                            cancelButton: 'rounded-xl px-5 py-4'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    })"
                    class="flex items-center w-full !text-[13px] !sm:text-[14px] font-semibold text-gray-600 hover:text-[#8C1007] transition-colors rounded-lg group focus:outline-none"
                    :class="isDesktopSidebarCollapsed ? 'justify-center' : ''">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:translate-x-1 transition-transform" 
                     :class="!isDesktopSidebarCollapsed ? 'mr-3' : ''"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span x-show="!isDesktopSidebarCollapsed">Keluar</span>
            </button>
        </form>
    </div>
</aside>












