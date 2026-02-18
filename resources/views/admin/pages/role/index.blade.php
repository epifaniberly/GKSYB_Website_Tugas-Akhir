@extends('layout.admin')

@section('title', 'Manajemen Role')

@section('content')
<div class="font-manrope">
    <div class="flex flex-col justify-start text-left py-6">
        <h1 class="admin-page-title">Pengguna & Hak Akses</h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola akun admin dan pengaturan hak akses sistem
        </p>
    </div>

    <div class="flex flex-row gap-3 mb-6">
        <button 
            onclick="openCreateModal()"
            class="px-6 py-2 rounded-lg text-white text-sm font-semibold transition-all hover:opacity-90 active:scale-95 outline-none focus:outline-none flex items-center justify-center gap-2 border-none cursor-pointer whitespace-nowrap"
            style="background-color: #8C1007 !important;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width: 3px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <span class="text-white">Tambah User</span>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="border border-gray-200 rounded-2xl p-6 flex flex-col gap-2 shadow-sm bg-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-[#F5F1FF] rounded-xl flex items-center justify-center text-[#9333EA]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Super Admin</h3>
                    <p class="text-[12px] text-gray-400 font-medium">Akses penuh ke semua fitur</p>
                </div>
            </div>
            <ul class="text-sm text-gray-600 space-y-2">
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola dashboard</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola semua konten dan publikasi</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola dokumen dan media</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola profil gereja</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola komunikasi umat</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola pengguna dan hak akses</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Pengaturan website</span></li>
            </ul>
        </div>

        <div class="border border-gray-200 rounded-2xl p-6 flex flex-col gap-2 shadow-sm bg-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-[#E1EFFE] rounded-xl flex items-center justify-center text-[#3F83F8]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Admin</h3>
                    <p class="text-[12px] text-gray-400 font-medium">Akses terbatas</p>
                </div>
            </div>
            <ul class="text-sm text-gray-600 space-y-2">
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola jadwal doa dan ekaristi</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola dokumen paroki</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola panduan perayaan</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola sakramen</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola donasi dan persembahan</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola pastor paroki</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Kelola komunikasi umat</span></li>
                <li class="flex items-start gap-2"><span>✓</span> <span>Pengaturan website</span></li>
            </ul>
        </div>
    </div>
    <div class="mb-5">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Super Admin</h2>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm mb-12">
        <div class="overflow-x-auto custom-scrollbar-horizontal">
            <table class="w-full min-w-[750px] md:min-w-[1000px] lg:min-w-full text-sm text-left font-manrope border-collapse" style="table-layout: fixed;">
                <thead class="bg-gray-50/80 border-b border-gray-100 text-gray-500">
                    <tr>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold w-[25%] md:w-[28%] lg:w-[30%]">Nama Lengkap</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold w-[35%] md:w-[32%] lg:w-[35%]">Email</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold w-[22%] md:w-[25%] lg:w-[20%]">Login Terakhir</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold text-center w-[18%] md:w-[15%] lg:w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($komsos as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-3 md:px-6 py-3 md:py-4">
                            <div class="flex items-center gap-2 md:gap-4 overflow-hidden">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#F3E8FF] flex items-center justify-center text-[#9333EA] overflow-hidden flex-shrink-0">
                                    @if($user->foto_profil)
                                        <img src="{{ asset('storage/ProfileMedia/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    @endif
                                </div>
                                <span class="font-bold md:font-semibold text-gray-800 text-[11px] md:text-sm whitespace-nowrap">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-gray-500 text-[11px] md:text-sm whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-gray-500 font-medium text-[11px] md:text-sm whitespace-nowrap">
                            {{ $user->last_login_at ? $user->last_login_at->format('d/m/y H:i') : '-' }}
                        </td>
                        <td class="px-3 md:px-6 py-3 md:py-4">
                            <div class="flex items-center justify-center gap-2 md:gap-4">
                                <button onclick="openPasswordModal({{ $user->id }})" class="p-1.5 md:p-2 text-amber-500 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors" title="Ganti Password">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                </button>
                                <button onclick="openEditModal({{ $user }})" class="p-1.5 md:p-2 hover:bg-yellow-50 rounded-lg transition-colors" style="color: #eab308;" title="Edit">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form id="form-delete-{{ $user->id }}" action="{{ route('admin.role.delete', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $user->id }})" class="p-1.5 md:p-2 hover:bg-red-50 rounded-lg transition-colors" style="color: #ef4444;" title="Hapus">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a1 1 0 011-1h4a1 1 0 011 1v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Admin</h2>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto custom-scrollbar-horizontal">
            <table class="w-full min-w-[750px] md:min-w-[1000px] lg:min-w-full text-sm text-left font-manrope border-collapse" style="table-layout: fixed;">
                <thead class="bg-gray-50/80 border-b border-gray-100 text-gray-500">
                    <tr>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold w-[25%] md:w-[28%] lg:w-[30%]">Nama Lengkap</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold w-[35%] md:w-[32%] lg:w-[35%]">Email</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold w-[22%] md:w-[25%] lg:w-[20%]">Login Terakhir</th>
                        <th class="px-3 md:px-6 py-3 md:py-4 font-semibold text-center w-[18%] md:w-[15%] lg:w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($sekre as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-3 md:px-6 py-3 md:py-4">
                            <div class="flex items-center gap-2 md:gap-4 overflow-hidden">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#E0F2FE] flex items-center justify-center text-[#0EA5E9] overflow-hidden flex-shrink-0">
                                    @if($user->foto_profil)
                                        <img src="{{ asset('storage/ProfileMedia/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    @endif
                                </div>
                                <span class="font-bold md:font-semibold text-gray-800 text-[11px] md:text-sm whitespace-nowrap">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-gray-500 text-[11px] md:text-sm whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-3 md:px-6 py-3 md:py-4 text-gray-500 font-medium text-[11px] md:text-sm whitespace-nowrap">
                            {{ $user->last_login_at ? (\Carbon\Carbon::parse($user->last_login_at)->format('d/m/y H:i')) : '-' }}
                        </td>
                        <td class="px-3 md:px-6 py-3 md:py-4">
                            <div class="flex items-center justify-center gap-2 md:gap-4">
                                <button onclick="openPasswordModal({{ $user->id }})" class="p-1.5 md:p-2 text-amber-500 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors" title="Ganti Password">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                </button>
                                <button onclick="openEditModal({{ $user }})" class="p-1.5 md:p-2 hover:bg-yellow-50 rounded-lg transition-colors" style="color: #eab308;" title="Edit">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form id="form-delete-{{ $user->id }}" action="{{ route('admin.role.delete', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $user->id }})" class="p-1.5 md:p-2 hover:bg-red-50 rounded-lg transition-colors" style="color: #ef4444;" title="Hapus">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a1 1 0 011-1h4a1 1 0 011 1v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="userModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 font-manrope px-4">
    <div class="bg-white rounded-2xl w-full max-w-lg relative shadow-2xl flex flex-col max-h-[90vh]">
        <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-2xl sticky top-0 z-10">
            <div>
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800">Tambah Akun</h3>
                <p class="text-[11px] text-gray-500 mt-0.5">Kelola informasi detail pengguna sistem</p>
            </div>
        </div>
        <div class="px-8 py-6 overflow-y-auto flex-1 custom-scrollbar">
            <form id="userForm" method="POST" enctype="multipart/form-data" class="space-y-5" novalidate autocomplete="off">
                @csrf
                <input type="hidden" id="formMethod" value="store">
                @php $errs = session('manual_errors') ?? new \Illuminate\Support\MessageBag(); @endphp
                <div style="display: none;">
                    <input type="text" name="fake_email_field" autocomplete="username">
                    <input type="password" name="fake_password_field" autocomplete="current-password">
                </div>

                <div id="name_container">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="name" name="name" type="text" placeholder="Masukkan nama lengkap" autocomplete="off" spellcheck="false"
                            class="w-full h-[48px] px-4 bg-gray-50 border {{ $errs->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm" required value="{{ old('name') }}">
                            @if($errs->has('name')) <p class="text-red-500 text-xs mt-1">{{ $errs->first('name') }}</p> @endif
                    </div>
                </div>

                <div id="email_container">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <div class="flex gap-2 items-start">
                        <div class="flex-1 w-full">
                            <div class="relative w-full">
                                <input id="email" name="email" type="text" placeholder="example@mail.com" autocomplete="new-off" spellcheck="false"
                                    class="w-full h-[48px] px-4 bg-gray-50 border {{ $errs->has('email') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <button type="button" id="btnSendOtp" onclick="sendOtp()"
                            class="px-4 h-[48px] text-white text-xs font-semibold rounded-xl hover:opacity-90 transition-all disabled:opacity-50 disabled:cursor-not-allowed border-none cursor-pointer focus:outline-none"
                            style="background-color: #8C1007 !important;">
                            Kirim Kode
                        </button>
                    </div>
                </div>

                <div id="otpSection" class="hidden">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kode Verifikasi</label>
                    <div class="flex gap-1 flex-col">
                        <div class="flex gap-1">
                            <input id="otp_code" type="text" maxlength="6" placeholder="Masukkan 6 digit kode"
                                class="flex-1 h-[48px] px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm text-center font-semibold">
                            <button type="button" id="btnVerifyOtp" onclick="verifyOtp()"
                                class="px-4 h-[48px] text-white text-xs font-semibold rounded-xl hover:opacity-90 transition-all border-none cursor-pointer focus:outline-none"
                                style="background-color: #16A34A !important;">
                                Verifikasi
                            </button>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">*Cek kotak masuk atau spam email Anda</p>
                </div>

                <div id="password_container">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <input id="password" name="password" type="text" placeholder="••••••••" autocomplete="new-password" readonly
                            onfocus="this.type='password'; this.removeAttribute('readonly'); document.getElementById('passwordRequirements').classList.remove('hidden')" 
                            onblur="document.getElementById('passwordRequirements').classList.add('hidden')"
                            oninput="validatePassword(this.value)"
                            class="w-full h-[48px] px-4 bg-gray-50 border {{ $errs->has('password') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm pr-12">
                        <button type="button" onclick="togglePassword(['password', 'password_confirmation'])" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="passIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                    <div id="passwordRequirements" class="hidden mt-3 bg-gray-50 rounded-xl p-4 border border-gray-100 transition-all">
                        <p class="text-[11px] font-semibold text-gray-700 mb-2">Syarat Password:</p>
                        <ul class="space-y-1.5 text-[11px]">
                            <li id="req_min" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="icon text-[10px]">○</span> <span>Minimal 8 Karakter</span></li>
                            <li id="req_upper" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="icon text-[10px]">○</span> <span>Huruf Besar (A-Z)</span></li>
                            <li id="req_num" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="icon text-[10px]">○</span> <span>Angka (0-9)</span></li>
                            <li id="req_sym" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="icon text-[10px]">○</span> <span>Simbol (@#$)</span></li>
                            <li id="req_space" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="icon text-[10px]">○</span> <span>Tidak ada spasi</span></li>
                        </ul>
                    </div>
                    @if($errs->has('password')) <p class="text-red-500 text-xs mt-1">{{ $errs->first('password') }}</p> @endif
                </div>

                <div id="password_confirmation_container">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" style="display:none;" autocomplete="new-password">
                        <input id="password_confirmation" name="password_confirmation" type="text" placeholder="••••••••" autocomplete="off" readonly onfocus="this.type='password'; this.removeAttribute('readonly')"
                            class="w-full h-[48px] px-4 bg-gray-50 border {{ $errs->has('password_confirmation') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm">
                        @if($errs->has('password_confirmation')) <p class="text-red-500 text-xs mt-1">{{ $errs->first('password_confirmation') }}</p> @endif
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Role Akses <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="role_type" name="role_type" 
                            class="w-full h-[48px] px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm appearance-none cursor-pointer">
                            <option value="2">Super Admin</option>
                            <option value="1">Admin</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label id="fotoLabelTitle" class="block text-sm font-semibold text-gray-800 mb-2">Foto Profil</label>
                    <label for="foto_profil" class="relative group block cursor-pointer">
                        <input id="foto_profil" type="file" name="foto_profil" accept="image/*" class="sr-only">
                        <div class="border-2 border-dashed border-gray-200 rounded-2xl py-12 px-6 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all text-center">
                            <div id="fotoPlaceholder" class="flex flex-col items-center text-center z-10">
                                <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1">Klik untuk upload foto atau drag & drop</p>
                                <p class="text-xs text-gray-400">JPG, JPEG, PNG (Maks. 10MB)</p>
                            </div>
                        </div>
                    </label>
                    <p id="fotoHelpText" class="text-[10px] text-gray-400 mt-2 leading-relaxed italic">* Kosongkan jika tidak ingin mengubah.</p>
                </div>
            </form>
        </div>
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex items-center justify-end gap-3 rounded-b-2xl sticky bottom-0 z-10">
            <button type="button" onclick="closeModal()" 
                class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                Batal
            </button>
            <button type="submit" form="userForm" id="btnSubmitUser"
                class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none hidden"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                Simpan User
            </button>
        </div>
    </div>
</div>

<div id="passwordModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 font-manrope px-4">
    <div class="bg-white rounded-2xl w-full max-w-md relative shadow-2xl flex flex-col max-h-[90vh]">
        <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50 rounded-t-2xl sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Ganti Password</h3>
                <p class="text-[11px] text-gray-500 mt-0.5">Konfirmasi keamanan sebelum mengubah password</p>
            </div>
        </div>
        <div class="px-8 py-6 overflow-y-auto flex-1 custom-scrollbar">
            <form id="passwordForm" method="POST" class="space-y-6" novalidate autocomplete="off">
                @csrf
                <div id="adminSecuritySection" class="space-y-4">
                    <div class="bg-amber-50 border border-amber-100 p-4 rounded-xl text-center">
                        <p class="text-xs text-amber-800 font-medium leading-relaxed">
                            PENTING: Kode verifikasi akan dikirim ke email user terkait <br> untuk mengonfirmasi perubahan password ini.
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-[12px] font-medium text-gray-400 mb-1">Kode Keamanan Admin</label>
                        <div class="flex gap-2">
                            <input id="admin_security_code" type="text" maxlength="6" placeholder="Masukkan 6 digit kode"
                                class="flex-1 h-[48px] px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm text-center font-semibold tracking-widest">
                            <button type="button" id="btnSendSecurityOtp" onclick="sendAdminSecurityOtp()"
                                class="px-4 h-[48px] text-white text-xs font-semibold rounded-xl hover:opacity-90 transition-all border-none cursor-pointer whitespace-nowrap focus:outline-none"
                                style="background-color: #8C1007 !important;">
                                Kirim Kode
                            </button>
                        </div>
                    </div>

                    <div id="verifySecurityBtn" class="pt-2 hidden">
                        <button type="button" onclick="verifyAdminSecurityOtpV2()" 
                            class="w-full h-[48px] text-white text-xs font-semibold rounded-xl hover:brightness-110 transition-all border-none cursor-pointer focus:outline-none"
                            style="background-color: #16A34A !important;">
                            Verifikasi Keamanan
                        </button>
                    </div>
                </div>
                <div id="passwordFieldsSection" class="space-y-5 hidden">
                    <div>
                        <label class="block text-[12px] font-medium text-gray-400 mb-1">Password Baru</label>
                        <div class="relative group">
                            <input id="new_password" name="password" type="password" placeholder="••••••••" autocomplete="off" readonly
                                onfocus="this.removeAttribute('readonly'); document.getElementById('pwdRequirements').classList.remove('hidden')" 
                                onblur="document.getElementById('pwdRequirements').classList.add('hidden')"
                                oninput="validatePwd(this.value)"
                                class="w-full h-[48px] px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm pr-12">
                            <button type="button" onclick="togglePassword(['new_password', 'new_password_confirmation'])" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                        <div id="pwdRequirements" class="hidden mt-3 bg-gray-50 rounded-xl p-4 border border-gray-100 transition-all">
                            <p class="text-[11px] font-semibold text-gray-700 mb-2">Syarat Password:</p>
                            <ul class="space-y-1.5 text-[11px]">
                                <li id="p_min" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="ict text-[10px]">○</span> <span>Minimal 8 Karakter</span></li>
                                <li id="p_upper" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="ict text-[10px]">○</span> <span>Huruf Besar (A-Z)</span></li>
                                <li id="p_num" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="ict text-[10px]">○</span> <span>Angka (0-9)</span></li>
                                <li id="p_sym" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="ict text-[10px]">○</span> <span>Simbol (@#$)</span></li>
                                <li id="p_space" class="flex items-center gap-2 text-gray-400 transition-colors"><span class="ict text-[10px]">○</span> <span>Tidak ada spasi</span></li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[12px] font-medium text-gray-400 mb-1">Konfirmasi Password Baru</label>
                        <div class="relative">
                        <input id="new_password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" autocomplete="off" readonly onfocus="this.removeAttribute('readonly')"
                                class="w-full h-[48px] px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-sm pr-12">
                            <button type="button" onclick="togglePassword(['new_password', 'new_password_confirmation'])" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex items-center justify-end gap-3 rounded-b-2xl sticky bottom-0 z-10 transition-all">
            <div id="initialPasswordFooter" class="w-full flex justify-end gap-3 transition-opacity">
                <button type="button" onclick="closePasswordModal()" class="px-10 h-[44px] rounded-xl border border-gray-200 bg-white text-gray-700 font-semibold text-sm hover:bg-gray-50 transition-all outline-none focus:outline-none">Batal</button>
            </div>
            <div id="finalPasswordFooter" class="hidden w-full flex justify-end gap-3">
                 <button type="button" onclick="closePasswordModal()" class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none" style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">Batal</button>
                 <button type="submit" form="passwordForm" class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">Update Password</button>
            </div>
        </div>
    </div>
</div>


@push('script')
<script>
    let userValidator;
    let passwordValidator;
    let emailVerified = false;
    let selectedUserId = null;

    window.openCreateModal = function() {
        console.log('Opening Create Modal');
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        if (!modal || !form) return;

        document.getElementById('modalTitle').innerText = 'Tambah User';
        form.action = "{{ route('admin.role.store') }}";
        document.getElementById('formMethod').value = 'store';

        document.getElementById('name').value = '';
        const emailInput = document.getElementById('email');
        if(emailInput) {
            emailInput.value = '';
            emailInput.disabled = false;
            emailInput.classList.remove('opacity-50', 'cursor-not-allowed');
        }
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';
        document.getElementById('role_type').value = '1';

        emailVerified = false;
        toggleRegistrationFields(true);
        if (userValidator) userValidator.clearErrors();
        
        const emailErrorEl = document.getElementById('emailError');
        if (emailErrorEl) {
            emailErrorEl.classList.add('hidden');
            emailErrorEl.innerText = '';
        }
        if(emailInput) {
            emailInput.classList.remove('border-red-500');
            emailInput.classList.add('border-gray-200');
        }

        const otpSec = document.getElementById('otpSection');
        if (otpSec) otpSec.classList.add('hidden');
        
        const otpInput = document.getElementById('otp_code');
        if(otpInput) {
            otpInput.value = '';
            otpInput.disabled = false;
        }

        const btnOtp = document.getElementById('btnSendOtp');
        if(btnOtp) {
            btnOtp.classList.remove('hidden', 'bg-red-800');
            btnOtp.disabled = false;
            btnOtp.innerText = 'Kirim Kode';
        }
        
        document.getElementById('password_container').classList.add('hidden');
        document.getElementById('password_confirmation_container').classList.add('hidden');
        document.getElementById('btnSubmitUser').classList.add('hidden');
        document.getElementById('fotoLabelTitle').innerHTML = 'Foto Profil <span class="text-gray-400 text-xs font-normal ml-1">(Opsional)</span>';
        document.getElementById('fotoHelpText').classList.add('hidden');
        resetFotoPreview();

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.openEditModal = function(user) {
        console.log('Opening Edit Modal', user);
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        if (!modal || !form) return;

        document.getElementById('modalTitle').innerText = 'Edit User';
        form.action = `/admin-manajemen-role/update/${user.id}`;
        document.getElementById('formMethod').value = 'update';

        document.getElementById('name').value = user.name;
        const emailInput = document.getElementById('email');
        if(emailInput) {
            emailInput.value = user.email;
            emailInput.disabled = true;
            emailInput.classList.add('opacity-50', 'cursor-not-allowed');
        }
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';
        document.getElementById('role_type').value = user.role_type;

        emailVerified = true;
        toggleRegistrationFields(false);
        if (userValidator) userValidator.clearErrors();
        
        const otpSec = document.getElementById('otpSection');
        if (otpSec) otpSec.classList.add('hidden');

        document.getElementById('fotoLabelTitle').innerHTML = 'Foto Profil';
        document.getElementById('fotoHelpText').innerText = '* Kosongkan jika tidak ingin mengubah.';
        document.getElementById('fotoHelpText').classList.remove('hidden');
        resetFotoPreview();
        
        document.getElementById('btnSendOtp').classList.add('hidden');
        
        document.getElementById('password_container').classList.add('hidden');
        document.getElementById('password_confirmation_container').classList.add('hidden');
        
        document.getElementById('btnSubmitUser').classList.remove('hidden');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    window.closeModal = function() {
        const modal = document.getElementById('userModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        if (userValidator) userValidator.clearErrors();
    };

    window.openPasswordModal = function(id) {
        selectedUserId = id;
        document.getElementById('passwordForm').action = `/admin-manajemen-role/update/${id}`;
        document.getElementById('new_password').value = '';
        document.getElementById('new_password_confirmation').value = '';
        document.getElementById('admin_security_code').value = '';
        document.getElementById('admin_security_code').disabled = true;
        
        document.getElementById('adminSecuritySection').classList.remove('hidden');
        document.getElementById('initialPasswordFooter').classList.remove('hidden');
        document.getElementById('finalPasswordFooter').classList.add('hidden');
        document.getElementById('passwordFieldsSection').classList.add('hidden');
        document.getElementById('verifySecurityBtn').classList.add('hidden');
        document.getElementById('btnSendSecurityOtp').disabled = false;
        document.getElementById('btnSendSecurityOtp').innerText = 'Kirim Kode';
        
        if (passwordValidator) passwordValidator.clearErrors();

        const modal = document.getElementById('passwordModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    };

    window.closePasswordModal = function() {
        const modal = document.getElementById('passwordModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        userValidator = new FormValidator('userForm');
        
        userValidator.addValidation('name', [
            'required',
            userValidator.rules.minLength(3)
        ]);
        
        userValidator.addValidation('email', [
            'required',
            userValidator.rules.email
        ]);
        
        userValidator.addValidation('password', [
            'required',
            userValidator.rules.minLength(8)
        ]);
        
        userValidator.addValidation('password_confirmation', [
            'required',
            userValidator.rules.matches('password', 'Konfirmasi password tidak cocok')
        ]);
        
        userValidator.init();

        const userForm = document.getElementById('userForm');
        userForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const method = document.getElementById('formMethod').value;

            if (userValidator.validateForm()) {
                
                if (method === 'store' && !emailVerified) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Verifikasi Email Diperlukan',
                        text: 'Silakan lakukan verifikasi kode OTP pada email terlebih dahulu sebelum menyimpan.',
                        confirmButtonColor: '#8C1007'
                    });
                    return; 
                }

                if (method === 'update') {
                    SwalHelper.confirmEdit('User').then(result => {
                        if (result.isConfirmed) {
                             document.getElementById('userForm').submit();
                        }
                    });
                } else {
                    document.getElementById('userForm').submit();
                }
            }
        });

        passwordValidator = new FormValidator('passwordForm');
        passwordValidator.addValidation('new_password', [
            'required',
            passwordValidator.rules.minLength(8)
        ]);
        passwordValidator.addValidation('new_password_confirmation', [
            'required',
            passwordValidator.rules.matches('new_password', 'Konfirmasi password tidak cocok')
        ]);
        passwordValidator.init();

        const passwordForm = document.getElementById('passwordForm');
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (passwordValidator.validateForm()) {
                Swal.fire({
                    title: 'Ubah Password?',
                    text: 'Pastikan password baru sudah dicatat.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#8C1007',
                    confirmButtonText: 'Ya, Ubah',
                    cancelButtonText: 'Batal'
                }).then(res => {
                    if (res.isConfirmed) document.getElementById('passwordForm').submit();
                });
            }
        });

        handleProfileUpload();
    });

    function handleProfileUpload() {
        const dropZone = document.querySelector('label[for="foto_profil"] div');
        const input = document.getElementById('foto_profil');
        const placeholder = document.getElementById('fotoPlaceholder');

        if (!dropZone || !input) return;

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);
        
        input.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropZone.classList.add('border-[#8C1007]', 'bg-[#FFF3F2]/50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-[#8C1007]', 'bg-[#FFF3F2]/50');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            input.files = files; 
            handleFiles(files);
        }

        function handleFiles(files) {
            if (files.length > 0) {
                previewFile(files[0]);
            }
        }

        function previewFile(file) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function() {
                placeholder.innerHTML = `
                    <div class="relative w-32 h-32 rounded-full overflow-hidden shadow-md group-hover:shadow-lg transition-all mx-auto">
                        <img src="${reader.result}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white text-xs font-semibold">Ganti Foto</span>
                        </div>
                    </div>
                    <p class="text-xs text-green-600 font-medium mt-3 flex items-center justify-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        ${file.name}
                    </p>
                `;
            }
        }
    }

    function resetFotoPreview() {
        const placeholder = document.getElementById('fotoPlaceholder');
        const input = document.getElementById('foto_profil');
        if(input) input.value = '';

        if(placeholder) {
            placeholder.innerHTML = `
                <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1">Klik untuk upload foto atau drag & drop</p>
                <p class="text-xs text-gray-400">JPG, JPEG, PNG (Maks. 10MB)</p>
            `;
        }
    }

    window.togglePassword = function(ids = ['password']) {
        ids.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.type = input.type === 'password' ? 'text' : 'password';
            }
        });
    };

    window.validatePassword = function(val) {
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
            const icon = el.querySelector('.icon');
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
    };

    window.validatePwd = function(val) {
        const reqs = {
            min: val.length >= 8,
            upper: /[A-Z]/.test(val),
            num: /[0-9]/.test(val),
            sym: /[^A-Za-z0-9]/.test(val),
            space: !/\s/.test(val) && val.length > 0
        };
        Object.keys(reqs).forEach(key => {
            const el = document.getElementById('p_' + key);
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
    };

    function toggleRegistrationFields(isDisabled) {
        const isEdit = document.getElementById('formMethod').value === 'update';
        
        const fields = ['password', 'password_confirmation', 'role_type', 'foto_profil'];
        fields.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            
            const shouldDisable = isEdit && (id === 'password' || id === 'password_confirmation') ? true : isDisabled;
            
            el.disabled = shouldDisable;
            if (shouldDisable) {
                el.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                el.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    }


    window.sendOtp = function() {
        const emailInput = document.getElementById('email');
        const email = emailInput.value;
        if (userValidator) {
            userValidator.clearError(emailInput);
        }

        if (!email) {
             if (userValidator) userValidator.showError(emailInput, 'Silakan masukkan email terlebih dahulu.');
             return;
        }

        const btn = document.getElementById('btnSendOtp');
        const input = document.getElementById('otp_code');
        btn.disabled = true;
        if(input) input.disabled = true;
        btn.innerText = 'Mengirim...';

        fetch("{{ route('admin.role.send.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email })
        })
        .then(async res => {
            const text = await res.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error('Non-JSON response:', text);
                throw new Error('Server mengembalikan format tidak valid. Cek log server.');
            }
            
            if (!res.ok) throw new Error(data.message || 'Gagal mengirim kode.');
            return data;
        })
        .then(data => {
            if (data.status === 'success') {
                SwalHelper.success('Berhasil', data.message);
                document.getElementById('otpSection').classList.remove('hidden');
                if(input) input.disabled = false;
                btn.innerText = 'Kirim Ulang';
                btn.disabled = false;
                btn.classList.add('bg-red-800');
            } else {
                 if (errorEl) {
                     errorEl.innerText = data.message || 'Gagal mengirim kode.';
                     errorEl.classList.remove('hidden');
                 }
                 emailInput.classList.remove('border-gray-200');
                 emailInput.classList.add('border-red-500');
                 
                 if(input) input.disabled = false;
                 btn.disabled = false;
                 btn.innerText = 'Kirim Kode';
            }
        })
        .catch(err => {
            console.error('OTP Error Object:', err);
            const msg = err.message || 'Terjadi kesalahan sistem.';
            
            if (userValidator) {
                userValidator.showError(emailInput, msg);
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: msg, confirmButtonColor: '#8C1007' });
            }

            if(input) input.disabled = false;
            btn.disabled = false;
            btn.innerText = 'Kirim Kode';
        });
    };

    window.verifyOtp = function() {
        const email = document.getElementById('email').value;
        const codeInput = document.getElementById('otp_code');
        const code = codeInput.value;

        if(userValidator) userValidator.clearError(codeInput);

        if (!code) {
             if(userValidator) userValidator.showError(codeInput, 'Silakan masukkan kode verifikasi.');
             return;
        }

        fetch("{{ route('admin.role.verify.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email, code })
        })
        .then(async res => {
            const text = await res.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                throw new Error('Server mengembalikan format tidak valid.');
            }
            if (!res.ok) throw new Error(data.message || 'Verifikasi gagal.');
            return data;
        })
        .then(data => {
            if (data.status === 'valid') {
                SwalHelper.success('Berhasil', data.message);
                emailVerified = true;
                
                codeInput.disabled = true;
                document.getElementById('btnVerifyOtp').disabled = true;
                document.getElementById('btnVerifyOtp').innerText = 'Verified';
                document.getElementById('btnVerifyOtp').classList.replace('bg-green-600', 'bg-gray-400');
                document.getElementById('btnSendOtp').disabled = true;
                
                toggleRegistrationFields(false);
                
                document.getElementById('password_container').classList.remove('hidden');
                document.getElementById('password_confirmation_container').classList.remove('hidden');
                
                const submitBtn = document.getElementById('btnSubmitUser');
                submitBtn.classList.remove('hidden');
            } else {
                 if(errorEl) {
                     errorEl.innerText = data.message;
                     errorEl.classList.remove('hidden');
                 }
                 codeInput.classList.remove('border-gray-200');
                 codeInput.classList.add('border-red-500');
            }
        })
        .catch(err => {
             const msg = err.message || 'Verifikasi gagal.';
             if(userValidator) {
                 userValidator.showError(codeInput, msg);
             } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: msg, confirmButtonColor: '#8C1007' });
             }
        });
    };

    window.sendAdminSecurityOtp = function() {
        const btn = document.getElementById('btnSendSecurityOtp');
        const input = document.getElementById('admin_security_code');
        btn.disabled = true;
        if(input) input.disabled = true;
        btn.innerText = 'Mengirim...';

        fetch("{{ route('admin.role.send.security.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ user_id: selectedUserId })
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Gagal mengirim kode.');
            return data;
        })
        .then(data => {
            SwalHelper.success('Berhasil', data.message);
            document.getElementById('verifySecurityBtn').classList.remove('hidden');
            if(input) input.disabled = false;
            btn.innerText = 'Kirim Ulang';
            btn.disabled = false;
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: err.message || 'Gagal mengirim email keamanan.',
                confirmButtonColor: '#8C1007',
                timer: 2000,
                timerProgressBar: true
            });
            if(input) input.disabled = false;
            btn.innerText = 'Kirim Kode';
            btn.disabled = false;
        });
    };

    window.verifyAdminSecurityOtpV2 = function() {
        const code = document.getElementById('admin_security_code').value;
        if (!code) return Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Masukkan kode keamanan.',
            confirmButtonColor: '#8C1007',
            timer: 2000,
            timerProgressBar: true
        });

        fetch("{{ route('admin.role.verify.security.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                user_id: selectedUserId,
                code: code 
            })
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Verifikasi gagal.');
            return data;
        })
        .then(data => {
            SwalHelper.success('Terverifikasi', 'Identitas terkonfirmasi. Silakan set password baru.');
            document.getElementById('adminSecuritySection').classList.add('hidden');
            document.getElementById('initialPasswordFooter').classList.add('hidden');
            document.getElementById('finalPasswordFooter').classList.remove('hidden');
            document.getElementById('passwordFieldsSection').classList.remove('hidden');
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: err.message,
                confirmButtonColor: '#8C1007',
                timer: 2000,
                timerProgressBar: true
            });
        });
    };

    function showPwdTooltip() { document.getElementById('pwdTooltip').classList.remove('hidden'); }
    function hidePwdTooltip() { document.getElementById('pwdTooltip').classList.add('hidden'); }
    
    function validatePwd(val) {
        const reqs = {
            min: val.length >= 8,
            upper: /[A-Z]/.test(val),
            num: /[0-9]/.test(val),
            sym: /[^A-Za-z0-9]/.test(val),
            space: !/\s/.test(val) && val.length > 0
        };
        Object.keys(reqs).forEach(key => {
            const el = document.getElementById('p_' + key);
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

    function confirmDelete(id) {
        SwalHelper.confirmDelete('akun ini').then(result => {
            if (result.isConfirmed) {
                document.getElementById(`form-delete-${id}`).submit();
            }
        });
    }

    @if(session('manual_errors') && session('manual_errors')->any())
    document.addEventListener('DOMContentLoaded', function() {
        window.openCreateModal(); 
        
        emailVerified = true;
        toggleRegistrationFields(false);
        
        document.getElementById('password_container').classList.remove('hidden');
        document.getElementById('password_confirmation_container').classList.remove('hidden');
        document.getElementById('btnSubmitUser').classList.remove('hidden');
        document.getElementById('otpSection').classList.add('hidden');
        document.getElementById('btnSendOtp').classList.add('hidden');
        
        document.getElementById('name').value = "{{ old('name') }}";
        document.getElementById('email').value = "{{ old('email') }}";
    });
    @endif
</script>
@endpush
@endsection







