    <div class="flex justify-center mb-8 px-4">
        <div class="inline-flex p-1.5 rounded-full border border-[#3b0d0d]/10 bg-white/50 backdrop-blur-sm overflow-x-auto max-w-full no-scrollbar">
            <button onclick="switchDonationTab('transfer')" id="btn-transfer" 
                    class="donation-tab active-tab bg-[#8C1007] text-white shadow-[0_4px_12px_rgba(140,16,7,0.3)] px-4 md:px-8 py-1.5 md:py-2.5 rounded-full text-[10px] md:text-sm font-medium transition-all duration-300 whitespace-nowrap">
                Transfer Bank
            </button>
            <button onclick="switchDonationTab('qrcode')" id="btn-qrcode" 
                    class="donation-tab text-[#3b0d0d] hover:bg-[#8C1007]/5 px-4 md:px-8 py-1.5 md:py-2.5 rounded-full text-[10px] md:text-sm font-medium transition-all duration-300 whitespace-nowrap">
                QR Code
            </button>
        </div>
    </div>

