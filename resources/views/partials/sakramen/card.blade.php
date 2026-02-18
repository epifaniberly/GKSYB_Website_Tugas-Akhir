<section class="w-full pb-24 bg-[#FCFAF7] fs-style-manrope" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-12 max-w-7xl">
        <div class="flex flex-wrap justify-center gap-6 md:gap-8">
            @foreach($data as $item)
                @include('partials.sakramen.card-item', ['item' => $item])
            @endforeach
        </div>

    </div>
</section>

