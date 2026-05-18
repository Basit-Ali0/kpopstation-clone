@extends('layouts.app')

@section('content')
@php
    $sortVal = request('sort', 'newest');
@endphp
<div class="mx-auto max-w-[1420px] px-6 py-10 md:px-10">
    <div class="mb-8 text-center lg:text-left">
        <h1 class="mb-2 font-sans text-xl font-bold uppercase tracking-wide text-black md:text-2xl">{{ $currentCategory === 'ALL PRODUCTS' ? 'ALL PRODUCTS' : $currentCategory }}</h1>
        <p class="font-sans text-[12px] text-neutral-700">Menampilkan {{ $products->total() }} barang</p>
    </div>

    <form method="GET" action="{{ route('collection.index', ['categorySlug' => $categorySlug]) }}" class="mb-10 flex flex-wrap items-end justify-center gap-4 lg:justify-start">
        @if(request()->filled('q'))
            <input type="hidden" name="q" value="{{ request('q') }}">
        @endif

        <label class="relative w-full sm:w-52">
            <span class="sr-only">Cari</span>
            <span class="pointer-events-none absolute left-2 top-1/2 -translate-y-1/2 text-neutral-500 ion-ios-search"></span>
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Pencarian…" class="w-full border border-neutral-800 py-2 pl-9 pr-3 font-sans text-[12px] outline-none focus:ring-2 focus:ring-black/20">
        </label>

        <div class="relative w-full sm:w-56">
            <label for="sort-products" class="sr-only">Urutkan</label>
            <select id="sort-products" name="sort" onchange="this.form.submit()" class="block w-full appearance-none border border-neutral-800 bg-white py-2 pl-3 pr-10 font-sans text-[12px] font-medium uppercase text-black">
                <option value="newest" {{ $sortVal === 'newest' ? 'selected' : '' }}>Produk terbaru</option>
                <option value="popular" {{ $sortVal === 'popular' ? 'selected' : '' }}>Produk terpopuler</option>
                <option value="price_asc" {{ $sortVal === 'price_asc' ? 'selected' : '' }}>Harga terendah</option>
                <option value="price_desc" {{ $sortVal === 'price_desc' ? 'selected' : '' }}>Harga tertinggi</option>
                <option value="name_asc" {{ $sortVal === 'name_asc' ? 'selected' : '' }}>Nama A–Z</option>
                <option value="name_desc" {{ $sortVal === 'name_desc' ? 'selected' : '' }}>Nama Z–A</option>
            </select>
            <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-neutral-800">▾</div>
        </div>

        <button type="submit" class="border border-black px-5 py-2 font-sans text-[11px] font-bold uppercase hover:bg-black hover:text-white">Terapkan</button>
    </form>

    @if(!$products->count())
        <div class="border border-neutral-300 py-24 text-center font-sans">
            <h2 class="mb-2 text-lg font-bold uppercase">Barang tidak ditemukan</h2>
            <p class="text-sm text-neutral-600">Maaf, saat ini tidak ada produk pada bagian ini.</p>
        </div>
    @else
        <div class="grid grid-cols-2 gap-x-6 gap-y-12 md:grid-cols-4">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-16 font-sans [&_a]:font-medium">
            {{ $products->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
