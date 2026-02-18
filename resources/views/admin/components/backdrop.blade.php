@php
    $user = auth()->user();
    $role = $user->role_type;
    $roleName = match($role) {
        2 => 'Super Admin',
        1 => 'Admin',
        default => 'User'
    };
@endphp

<div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center md:hidden"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 w-64 mt-16 bg-white shrink-0 md:hidden flex flex-col overflow-hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="flex-shrink-0 py-6 flex items-center justify-center">
             <a href="#">
                <img src="{{ asset('assets/logo.png') }}" class="w-[180px]" alt="Logo">
            </a>
        </div>
        <div class="flex-1 overflow-y-auto custom-scrollbar px-2 space-y-4 pb-4">
            <div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dashboard</p>
                <ul class="space-y-1">
                    <li class="relative">
                        @if(request()->routeIs('admin.dashboard.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg" aria-hidden="true"></span>
                        @endif
                        <a href="{{ route('admin.dashboard.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.dashboard.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/dashboard.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
            @if(in_array($role, [1, 2]))
            <div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Konten dan Publikasi</p>
                <ul class="space-y-1">
                    @if($role == 2)
                    <li class="relative">
                        @if(request()->routeIs('admin.blog.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.blog.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.blog.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/doc.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Tulisan Bintaran</span>
                        </a>
                    </li>
                    @endif
                    
                    <li class="relative">
                        @if(request()->routeIs('admin.jadwal.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.jadwal.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.jadwal.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/cal.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Jadwal Doa & Ekaristi</span>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
            @if(in_array($role, [1, 2]))
            <div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Dokumen dan Media</p>
                <ul class="space-y-1">
                    <li class="relative">
                        @if(request()->routeIs('admin.dokparoki.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.dokparoki.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.dokparoki.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/folder.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Dokumen Paroki</span>
                        </a>
                    </li>

                    <li class="relative">
                        @if(request()->routeIs('admin.panduan.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.panduan.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.panduan.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/book.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Panduan Perayaan</span>
                        </a>
                    </li>

                    @if($role == 2)
                    <li class="relative">
                        @if(request()->routeIs('admin.gallery.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.gallery.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.gallery.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/gal.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Galeri & Dokumentasi</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif
            <div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Tilik Sejarah</p>
                <ul class="space-y-1">
                    <li class="relative">
                        @if(request()->routeIs('admin.sejarah.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.sejarah.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.sejarah.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/home.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Tilik Sejarah</span>
                        </a>
                    </li>

                    <li class="relative">
                        @if(request()->routeIs('admin.sakramen.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.sakramen.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.sakramen.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/plus.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Sakramen</span>
                        </a>
                    </li>

                    <li class="relative">
                        @if(request()->routeIs('admin.donasi.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.donasi.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.donasi.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/dollar.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Donasi & Persembahan</span>
                        </a>
                    </li>

                    <li class="relative">
                        @if(request()->routeIs('admin.paroki.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.paroki.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.paroki.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/user.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Pastor Paroki</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Komunikasi Umat</p>
                <ul class="space-y-1">
                    <li class="relative" x-data="{ open: false }">
                        <button type="button" @click.stop="open = !open"
                                class="flex items-center justify-between w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold text-gray-700 transition-colors duration-150 rounded-lg hover:!text-[#8C1007] hover:!bg-[#FFF3F2] focus:outline-none">
                            <span class="flex items-center">
                                <img src="{{ asset('sidebaricon/email.png') }}" class="w-5 h-5" alt="">
                                <span class="ml-3">Pesan Masuk</span>
                            </span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="p-2 mt-2 space-y-2 overflow-hidden !text-[13px] !sm:text-[14px] font-semibold text-gray-500 rounded-md bg-gray-50 border border-gray-100">
                            <li class="px-2 py-1 hover:text-gray-800 rounded transition-colors">
                                <a href="{{ route('admin.terhubung.index') }}" class="block w-full">Mari Terhubung</a>
                            </li>
                            <li class="px-2 py-1 hover:text-gray-800 rounded transition-colors">
                                <a href="{{ route('admin.doa.index') }}" class="block w-full">Intensi / Ujud Doa</a>
                            </li>
                        </ul>
                    </li>

                    <li class="relative">
                        @if(request()->routeIs('admin.faq.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.faq.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.faq.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/ssd.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Soal Sering Ditanya</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Manajemen Sistem</p>
                <ul class="space-y-1">
                    @if($role == 2)
                    <li class="relative">
                        @if(request()->routeIs('admin.role.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.role.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.role.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/user.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Pengguna & Akses</span>
                        </a>
                    </li>
                    @endif

                    @if(in_array($role, [1, 2]))
                    <li class="relative">
                        @if(request()->routeIs('admin.settings.*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-[#8C1007] rounded-r-lg"></span>
                        @endif
                        <a href="{{ route('admin.settings.index') }}"
                           class="inline-flex items-center w-full px-4 py-4 !text-[13px] !sm:text-[14px] font-semibold transition-colors duration-150 rounded-lg
                           {{ request()->routeIs('admin.settings.*') ? '!text-[#8C1007] !bg-[#FFF3F2]' : 'text-gray-700 hover:!text-[#8C1007] hover:!bg-[#FFF3F2]' }} focus:outline-none">
                            <img src="{{ asset('sidebaricon/settings.png') }}" class="w-5 h-5" alt="">
                            <span class="ml-3">Pengaturan Website</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="flex-shrink-0 border-t border-gray-100 p-4 bg-gray-50/50">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#8C1007] text-white flex items-center justify-center !text-[13px] !sm:text-[14px] font-semibold shrink-0 overflow-hidden shadow-sm">
                    @if(!empty($user->foto_profil))
                        <img src="{{ asset('storage/ProfileMedia/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($user->name, 0, 2) }}
                    @endif
                </div>
                <div class="overflow-hidden">
                    <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</h4>
                    <div class="flex items-center mt-0.5">
                        <span class="px-1.5 py-0.5 text-[10px] font-medium bg-[#8C1007] text-white rounded">
                            {{ strtoupper($roleName) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100/80 rounded-lg p-3 mb-3">
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
                        class="flex items-center w-full !text-[13px] !sm:text-[14px] font-semibold text-gray-600 hover:text-[#8C1007] transition-colors rounded-lg group focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
      </aside>
      <div class="flex flex-col flex-1 w-full overflow-hidden">
        <header class="z-10 py-4 bg-white shadow-sm border-b border-gray-100">
          <div
            class="container flex items-center justify-between h-full px-4 md:px-6 mx-auto text-[#8C1007]"
          >
            <div class="flex items-center gap-4">
                <button
                  class="p-1 -ml-1 rounded-md focus:outline-none !text-[#8C1007] focus:outline-none"
                  @click="toggleSidebar"
                  aria-label="Menu"
                >
                  <svg
                    class="w-6 h-6"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </button>
            </div>
            <div class="flex justify-center flex-1 px-4 lg:px-8" x-data="globalSearch()">
              <div
                class="relative w-full md:max-w-xl focus-within:text-[#8C1007]"
              >
                <div class="absolute inset-y-0 flex items-center pl-3">
                  <svg
                    class="w-4 h-4 text-gray-400"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  class="w-full pl-10 pr-4 py-2 text-sm text-gray-700 placeholder-gray-400 bg-gray-50 border-0 rounded-xl focus:placeholder-gray-500 focus:bg-white focus:ring-1 focus:ring-[#8C1007] focus:outline-none transition-all"
                  type="text"
                  placeholder="Cari halaman atau menu..."
                  aria-label="Search"
                  x-model="query"
                  @input="search()"
                  @focus="showResults = true"
                  @keydown.escape="showResults = false"
                  @keydown.down.prevent="navigateResults('down')"
                  @keydown.up.prevent="navigateResults('up')"
                  @keydown.enter.prevent="selectResult()"
                />
                <div x-show="showResults && filteredResults.length > 0"
                     x-transition
                     @click.away="showResults = false"
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-lg border border-gray-200 max-h-96 overflow-y-auto z-50">
                    <template x-for="(result, index) in filteredResults" :key="index">
                        <a :href="result.url"
                           class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-0"
                           :class="selectedIndex === index ? 'bg-gray-50' : ''">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-[#FFF3F2]">
                                <svg class="w-4 h-4 text-[#8C1007]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="result.icon"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-semibold text-gray-900" x-text="result.title"></div>
                                <div class="text-xs text-gray-500" x-text="result.category"></div>
                            </div>
                        </a>
                    </template>
                </div>
                <div x-show="showResults && query.length > 0 && filteredResults.length === 0"
                     x-transition
                     @click.away="showResults = false"
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-lg border border-gray-200 p-6 text-center z-50">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p class="text-sm text-gray-500">Tidak ada hasil untuk "<span x-text="query"></span>"</p>
                </div>
              </div>
            </div>


          </div>
        </header>












