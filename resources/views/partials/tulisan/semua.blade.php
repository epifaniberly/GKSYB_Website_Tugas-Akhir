<section class="w-full py-10 md:py-16 bg-[#FCFAF7] fs-style-manrope" data-aos="fade-up" id="articles-section">
    <div class="container mx-auto px-8 md:px-20 max-w-7xl">
        <div class="text-center mb-16 px-4">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-semibold text-[#3E0703] mb-4 leading-tight">
                {{ $selectedCategory ? $selectedCategory->nama_kategori : 'Semua Tulisan Bintaran' }}
            </h2>
            <p class="text-xs sm:text-sm lg:text-base text-[#3A0D0D] leading-relaxed max-w-3xl opacity-90 mx-auto md:text-lg">
                {{ $selectedCategory 
                    ? 'Menampilkan kumpulan tulisan untuk kategori ' . $selectedCategory->nama_kategori . '.'
                    : 'Kumpulan refleksi iman, katekese, dan informasi pastoral Paroki Bintaran yang disajikan untuk meneguhkan iman serta menemani perjalanan rohani umat.' }}
            </p>
        </div>
        <div class="flex flex-col lg:flex-row gap-8 items-center justify-between mb-16">
            <div class="relative group w-full lg:max-w-md">
                @if(request('category'))
                    <input type="hidden" id="category" value="{{ request('category') }}">
                @endif
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-[#3a0d0d] opacity-40">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input type="text" id="search-input" value="{{ $search }}" placeholder="Cari Tulisan Bintaran"
                    class="w-full h-10 md:h-14 pl-10 md:pl-14 pr-4 md:pr-6 text-xs md:text-base rounded-xl md:rounded-2xl border-none bg-white shadow-sm ring-1 ring-gray-100 focus:ring-2 focus:ring-[#8C1007]/30 focus:outline-none transition-all duration-300">
            </div>
            <div class="flex p-1.5 rounded-full border border-gray-200 bg-white shadow-sm overflow-x-auto max-w-full lg:w-auto scrollbar-hide">
                <div class="flex flex-nowrap gap-1">
                    <a href="{{ route('landing.tulisan') }}#articles-section" 
                       class="cat-tab-btn {{ !$selectedCategory ? 'active' : '' }} rounded-full font-semibold transition-all duration-300 whitespace-nowrap flex items-center justify-center">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('landing.tulisan', ['category' => $cat->slug]) }}#articles-section" 
                       class="cat-tab-btn {{ $selectedCategory && $selectedCategory->id == $cat->id ? 'active' : '' }} rounded-full font-semibold whitespace-nowrap transition-all duration-300 flex items-center justify-center">
                        {{ $cat->nama_kategori }}
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
        <div id="results-container">
            @include('partials.tulisan.article-grid')
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const resultsContainer = document.getElementById('results-container');
        const categoryInput = document.getElementById('category');
        let timeout = null;

        function fetchArticles(url) {
            resultsContainer.style.opacity = '0.5';

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                resultsContainer.innerHTML = html;
                resultsContainer.style.opacity = '1';
                
                window.history.pushState({}, '', url);
            })
            .catch(error => {
                console.error('Error:', error);
                resultsContainer.style.opacity = '1';
            });
        }
        searchInput.addEventListener('input', function(e) {
            clearTimeout(timeout);
            const query = e.target.value;
            const category = categoryInput ? categoryInput.value : '';
            
            timeout = setTimeout(() => {
                let url = "{{ route('landing.tulisan') }}";
                const params = new URLSearchParams();
                
                if (query) params.append('search', query);
                if (category) params.append('category', category);
                
                fetchArticles(`${url}?${params.toString()}`);
            }, 300); 
        });

        resultsContainer.addEventListener('click', function(e) {
            const link = e.target.closest('.pagination a');
            if (link) {
                e.preventDefault();
                fetchArticles(link.href);
            }
        });
    });
</script>

<style>
    .cat-tab-btn {
        font-size: clamp(10px, 2.5vw, 13px);
        padding: clamp(8px, 1.5vw, 12px) clamp(16px, 2.8vw, 24px);
        color: rgba(62, 7, 3, 0.4);
    }
    .cat-tab-btn.active {
        background-color: #8C1007;
        color: white;
        box-shadow: 0 4px 12px rgba(140, 16, 7, 0.2);
    }
    .cat-tab-btn:not(.active):hover {
        background-color: rgba(140, 16, 7, 0.05);
        color: #3E0703;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

