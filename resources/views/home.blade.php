@extends('layouts.app')

@section('content')
@php
    $t = 'https://cdn.isellercommerce.com/f205a4a0321740a09d2da128dbe75a85/theme_content/';
    $hero = $t . 'banner_kpopstationutama.png';
    $promo = $t . 'banner_kpopstationpromotion.png';
    $indoBanner = $t . 'banner_kpopstationindonesiaproudly.png';
    $indoPhoto = $t . rawurlencode('whatsapp image 2023-12-04 at 11.13.00.jpeg');
    $happy = [
        $t . rawurlencode('screen shot 2024-02-01 at 8.30.20 am.png'),
        $t . rawurlencode('screen shot 2023-12-18 at 7.04.26 pm.png'),
        $t . rawurlencode('screen shot 2023-12-18 at 7.05.44 pm.png'),
    ];
    $indoBrands = [
        ['label' => 'CHIL CLOUDS', 'src' => $indoBanner],
        ['label' => 'MAKKEURIE', 'src' => $indoPhoto],
        ['label' => 'EDDMAYR', 'src' => $indoBanner],
        ['label' => 'POPCHERRIES', 'src' => $indoPhoto],
        ['label' => 'LOEYANS', 'src' => $indoBanner],
        ['label' => 'CLOUDSEEDS', 'src' => $indoPhoto],
    ];
    $promos = [
        ['title' => 'YEAR END SALE', 'href' => route('collection.index', ['categorySlug' => 'all'])],
        ['title' => 'JAKARTA GREAT SALE', 'href' => route('collection.index', ['categorySlug' => 'all'])],
        ['title' => 'OFFICIAL PHOTOCARDS', 'href' => route('collection.index', ['categorySlug' => 'album'])],
    ];
@endphp

{{-- Hero (matches iSeller storefront banner + overlay copy) --}}
<section class="relative flex min-h-[220px] w-full md:min-h-[420px]" aria-label="Promosi utama">
    <img src="{{ $hero }}" alt="" class="absolute inset-0 size-full object-cover object-center" loading="eager">
    <div class="absolute inset-0 bg-black/35"></div>
    <div class="relative z-10 mx-auto flex w-full max-w-[1420px] flex-col justify-center px-6 py-12 text-white md:px-12 lg:py-28">
        <h1 class="mb-4 max-w-xl text-left font-sans text-2xl font-bold uppercase tracking-wide md:text-4xl">BEST K-POP STORE IN TOWN!</h1>
        <p class="mb-10 max-w-md text-left font-sans text-base font-normal md:text-xl">Shop more variety and high quality.</p>
        <a href="{{ route('collection.index', ['categorySlug' => 'all']) }}" class="inline-block max-w-fit border border-white px-10 py-2.5 font-sans text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-white hover:text-black">Shop now</a>
    </div>
</section>

<div class="mx-auto max-w-[1420px] px-6 py-12 md:px-10">
    {{-- NEW ARRIVAL --}}
    <h2 class="ks-heading mt-10">NEW ARRIVAL</h2>
    <div class="grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
        @foreach($newArrivals as $p)
            <x-product-card :product="$p" :show-new-badge="true" />
        @endforeach
    </div>

    {{-- BEST SELLER --}}
    <h2 class="ks-heading mt-20">BEST SELLER</h2>
    <div class="grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
        @foreach($bestSellers as $p)
            <x-product-card :product="$p" />
        @endforeach
    </div>
</div>

{{-- FOR YOUR HAPPINESS --}}
<section class="bg-white py-12 md:py-16">
    <div class="mx-auto max-w-[1420px] px-6 md:px-10">
        <h2 class="ks-heading mb-12">{!! 'FOR YOUR HAPPINESS&#x2DA;&#x29A;&#x2661;&#x25E;&#x2DA;' !!}</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-6">
            @foreach($happy as $i => $src)
                <a href="{{ route('collection.index', ['categorySlug' => 'all']) }}" class="group overflow-hidden rounded-sm md:aspect-[3/2]">
                    <img src="{{ $src }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]" loading="lazy">
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- INDONESIA PROUDLY PRESENT --}}
<section class="bg-white pb-16">
    <div class="mx-auto max-w-[1420px] px-6 md:px-10">
        <h2 class="ks-heading mb-12">INDONESIA PROUDLY PRESENT</h2>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($indoBrands as $b)
                <a href="{{ route('collection.index', ['categorySlug' => 'all']) }}" class="group relative block aspect-[3/2] overflow-hidden rounded-sm">
                    <img src="{{ $b['src'] }}" alt="{{ $b['label'] }}" class="size-full object-cover transition duration-500 group-hover:scale-[1.04]" loading="lazy">
                    <div class="absolute inset-0 flex items-end justify-center bg-gradient-to-t from-black/50 to-transparent pb-6">
                        <span class="w-full bg-[rgb(1,151,0)]/80 py-3 text-center font-sans text-sm font-semibold uppercase tracking-wide text-white">{{ $b['label'] }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- PROMOTIONS --}}
<section class="bg-[#0aa33f] py-14 md:py-20">
    <div class="mx-auto max-w-[1420px] px-6 md:px-10">
        <h2 class="ks-heading !text-white">PROMOTIONS</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
            @foreach($promos as $block)
                <a href="{{ $block['href'] }}" class="group relative block aspect-[3/2] overflow-hidden">
                    <img src="{{ $promo }}" alt="" class="size-full object-cover transition duration-500 group-hover:scale-[1.02]" loading="lazy">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="min-w-[70%] bg-[rgb(1,151,0)]/80 px-4 py-4 text-center">
                            <h3 class="font-sans text-lg font-bold uppercase tracking-wide text-white md:text-xl">{{ $block['title'] }}</h3>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
