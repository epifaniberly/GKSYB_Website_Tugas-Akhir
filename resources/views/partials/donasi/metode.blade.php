<section class="max-w-7xl mx-auto px-6 pb-16 pt-12 font-manrope" data-aos="fade-up">

    @include('partials.donasi.tabs')

    @include('partials.donasi.transfer')

    @include('partials.donasi.qrcode')
    
</section>

<script>
    function switchDonationTab(type) {
        document.querySelectorAll('.donation-tab').forEach(btn => {
            btn.classList.remove('bg-[#8C1007]', 'text-white', 'shadow-[0_4px_12px_rgba(140,16,7,0.3)]', 'active-tab');
            btn.classList.add('text-[#3b0d0d]', 'hover:bg-[#8C1007]/5');
        });
        
        const activeBtn = document.getElementById('btn-' + type);
        activeBtn.classList.remove('text-[#3b0d0d]', 'hover:bg-[#8C1007]/5');
        activeBtn.classList.add('bg-[#8C1007]', 'text-white', 'shadow-[0_4px_12px_rgba(140,16,7,0.3)]', 'active-tab');

        document.querySelectorAll('.donation-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        const activeContent = document.getElementById('content-' + type);
        activeContent.classList.remove('hidden');
        
        activeContent.style.opacity = '0';
        activeContent.style.transform = 'translateY(10px)';
        requestAnimationFrame(() => {
            activeContent.style.transition = 'all 0.4s ease';
            activeContent.style.opacity = '1';
            activeContent.style.transform = 'translateY(0)';
        });
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Disalin!',
                text: 'Nomor rekening telah disalin ke clipboard',
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
        });
    }
</script>

