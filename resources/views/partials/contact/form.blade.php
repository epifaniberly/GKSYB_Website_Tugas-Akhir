
<section data-aos="fade-up" class="max-w-6xl mx-auto px-6 py-12 ">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start fs-style-manrope mt-5">
        <div class="text-center lg:text-left mb-8 lg:mb-0">
            <h2 class="text-3xl md:text-5xl font-semibold text-[#3E0703] mb-6">Mari Terhubung</h2>
            <p class="text-sm md:text-base lg:text-base text-[#3A0D0D] leading-relaxed max-w-xl opacity-90 mx-auto lg:mx-0 mb-6">
                Apabila Anda memiliki pertanyaan, ingin menyampaikan pesan, atau membutuhkan informasi lebih lanjut seputar kegiatan paroki, silakan hubungi kami melalui kontak berikut atau isi formulir di sebelah kanan.
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 text-sm text-gray-700">
                <div>
                    <h3 class="font-semibold text-xl md:text-2xl lg:text-xl text-[#3E0703] mb-4">
                        Kunjungi Sekretariat
                    </h3>
                    @if($kontakGlobal && $kontakGlobal->jamPelayanan->count() > 0)
                        @foreach($kontakGlobal->jamPelayanan as $jam)
                            <p class="text-sm md:text-base lg:text-base text-[#3A0D0D] leading-relaxed max-w-xl opacity-90 mx-auto lg:mx-0 {{ !$loop->first ? 'mt-2' : '' }}">
                                {{ $jam->hari_dari }}{{ $jam->hari_sampai ? ' - ' . $jam->hari_sampai : '' }}<br>
                                {{ $jam->jam_mulai }} - {{ $jam->jam_selesai }} WIB
                            </p>
                        @endforeach
                    @else
                        <p class="text-[#3E0703] text-base md:text-lg lg:text-base">Senin - Jumat<br>08.00 - 16.00 WIB</p>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold text-xl md:text-2xl lg:text-xl text-[#3E0703] mb-4">Alamat</h3>
                    <p class="text-sm md:text-base lg:text-base text-[#3A0D0D] leading-relaxed max-w-[300px] opacity-90 mx-auto lg:mx-0">
                        {{ $kontakGlobal->alamat ?? 'Jl. Bintaran Kidul No.5, Wirogunan, Kec. Mergangsan, Kota Yogyakarta, DIY 55151' }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-xl md:text-2xl lg:text-xl text-[#3E0703] mb-4">Hubungi Kami</h3>
                    <p class="text-sm md:text-base lg:text-base text-[#3A0D0D] leading-relaxed max-w-xl opacity-90 mx-auto lg:mx-0">
                        {{ $kontakGlobal->telepon ?? '(0274) 375231' }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-xl md:text-2xl lg:text-xl text-[#3E0703] mb-4">Kirimkan Kami Pesan</h3>
                    <p class="text-sm md:text-base lg:text-base text-[#3A0D0D] leading-relaxed max-w-xl opacity-90 mx-auto lg:mx-0 mb-4">
                        {{ $kontakGlobal->email ?? 'parokibintaran@gmail.com' }}
                    </p>
                    
                    <div class="flex flex-col gap-2.5 items-center lg:items-start text-center lg:text-left">
                        @if($kontakGlobal && $kontakGlobal->whatsapp)
                            <a href="https://wa.me/{{ $kontakGlobal->whatsapp }}" target="_blank" class="flex items-center gap-2 text-base md:text-lg lg:text-base text-[#3E0703] font-medium hover:underline">
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                <span>WhatsApp Sekretariat</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full">
            <form id="contactForm" action="{{ route('landing.contact.store') }}" method="POST" class="border border-gray-100 rounded-xl p-5 shadow-sm bg-white" novalidate>
                @csrf
            <div class="block">
                <div class="mb-4 md:mb-6">
                        <label class="block text-sm md:text-sm text-[#3E0703] mb-1" for="nama_lengkap">Nama Lengkap</label>
                        <input id="nama_lengkap" name="nama_lengkap" type="text" required placeholder="Masukkan Nama Lengkap Anda" value="{{ old('nama_lengkap') }}" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-sm md:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('nama_lengkap') border-red-500 @enderror" />
                        @error('nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4 md:mb-6">
                        <div>
                            <label class="block text-sm md:text-sm text-[#3E0703] mb-1" for="email">Email</label>
                            <input id="email" name="email" type="email" required placeholder="Masukkan Email Anda" value="{{ old('email') }}" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-sm md:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('email') border-red-500 @enderror" />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm md:text-sm text-[#3E0703] mb-1" for="nomor_telepon">Nomor Telepon</label>
                            <div class="flex items-center">
                                <span class="bg-gray-50 border border-r-0 border-gray-100 rounded-l-lg px-3 py-2 text-sm md:text-sm text-gray-500 font-medium select-none">+62</span>
                                <input id="nomor_telepon" name="nomor_telepon" type="tel" required placeholder="81234567890" value="{{ old('nomor_telepon') }}" class="w-full border border-gray-100 rounded-r-lg px-3 py-2 text-sm md:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('nomor_telepon') border-red-500 @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.startsWith('0')) this.value = this.value.substring(1);" />
                            </div>
                            @error('nomor_telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4 md:mb-6">
                        <div>
                            <label class="block text-sm md:text-sm text-[#3E0703] mb-1" for="asal_paroki">Asal Paroki</label>
                            <input id="asal_paroki" name="asal_paroki" type="text" required placeholder="Masukkan Asal Paroki Anda" value="{{ old('asal_paroki') }}" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-sm md:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('asal_paroki') border-red-500 @enderror" />
                            @error('asal_paroki')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm md:text-sm text-[#3E0703] mb-1" for="asal_lingkungan">Asal Lingkungan <span class="text-gray-400 font-normal text-xs md:text-[10px]">(Opsional)</span></label>
                            <input id="asal_lingkungan" name="asal_lingkungan" type="text" placeholder="Masukkan Asal Lingkungan Anda" value="{{ old('asal_lingkungan') }}" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-sm md:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('asal_lingkungan') border-red-500 @enderror" />
                            @error('asal_lingkungan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                <div class="mb-4 md:mb-6">
                        <label class="block text-sm md:text-sm text-[#3E0703] mb-1" for="isi_pesan">Pesan Anda</label>
                        <textarea id="isi_pesan" name="isi_pesan" rows="3" required class="w-full border border-gray-100 rounded-lg px-3 py-2 text-sm md:text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('isi_pesan') border-red-500 @enderror">{{ old('isi_pesan') }}</textarea>
                        @error('isi_pesan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs md:text-xs text-[#3E0703] mt-1.5">Bagaimana kami bisa membantu Anda?</p>
                    </div>

                    <div class="pt-1 text-center md:text-right">
                        <button type="submit" class="btn-accent px-4 md:px-8 py-1.5 md:py-2.5 text-[10px] md:text-sm">Kirim Pesan Anda</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="{{ asset('js/form-validation.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const validator = new FormValidator('contactForm');
        validator.init();
    });
</script>
