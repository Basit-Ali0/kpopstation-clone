@extends('layouts.app')

@section('content')
@php($ksImgPlaceholder = 'https://kpopstation.net/resources/georgeous907d3d51/assets/images/product-placeholder.png')

<!-- Toast Notification -->
<div id="cartToast" class="fixed bottom-0 left-0 z-[60] hidden w-full bg-[#019700] text-white transition-all duration-300">
    <div class="max-w-[1400px] mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-2 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>Ditambahkan ke keranjang.</span>
        </div>
        <div class="flex items-center space-x-6">
            <a href="{{ route('cart.index') }}" class="bg-black text-white px-4 py-1.5 text-xs font-bold hover:bg-gray-800 transition">Lihat Keranjang</a>
            <button onclick="document.getElementById('cartToast').classList.add('hidden')" class="text-white hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    /* Hide scrollbar for the carousel */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<!-- Product Detail Section -->
<div class="mx-auto mb-16 max-w-[1420px] px-6 md:px-10">
<div class="mt-8 flex flex-col gap-12 md:flex-row">
    <!-- Image -->
    <div class="w-full md:w-1/2 aspect-square bg-[#f5f5f5] flex items-center justify-center p-8">
        @if($product->image)
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-contain shadow-sm" onerror="this.src='{{ $ksImgPlaceholder }}'">
        @else
            <img src="{{ $ksImgPlaceholder }}" alt="{{ $product->name }}" class="h-full w-full object-contain shadow-sm">
        @endif
    </div>

    <!-- Details -->
    <div class="w-full md:w-1/2 flex flex-col justify-center">
        <h1 class="text-[1.3rem] font-bold text-black mb-2">{{ $product->name }}</h1>
        <p class="text-xs text-gray-600 mb-4 font-medium">Terjual {{ number_format((int) ($product->sold_count ?? 0), 0, ',', '.') }}</p>

        <hr class="border-gray-200 mb-6">

        <p class="text-base font-medium text-black mb-8">IDR {{ number_format((float) $product->price, 0, ',', '.') }}</p>
        
        <div class="text-[0.75rem] text-black space-y-4 mb-10 font-medium">
            <p>Product: {{ $product->name }} (2 pcs 1 SET)</p>
            <p>Material: PAPER / PLASTIC</p>
            <p>Size: 55 X 85 (MM)</p>
        </div>
        
        <div class="flex items-center mb-8">
            <span class="text-xs font-bold text-black mr-6">Jumlah</span>
            <div class="flex items-center space-x-6">
                <button onclick="decreaseQty()" class="text-black font-extrabold text-lg select-none focus:outline-none">&lt;</button>
                <span id="qtyCount" class="text-sm font-medium w-4 text-center">{{ $product->stock > 0 ? 1 : 0 }}</span>
                <button onclick="increaseQty()" class="text-black font-extrabold text-lg select-none focus:outline-none">&gt;</button>
            </div>
        </div>
        
        <div>
            @if($product->stock > 0)
                <button onclick="addToCart(this)" class="flex items-center border border-black px-5 py-2.5 text-[0.7rem] font-bold text-black transition-colors duration-300 hover:border-[#019700] hover:bg-[#019700] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Tambahkan ke keranjang</span>
                </button>
            @else
                <button disabled class="border border-gray-300 px-5 py-2.5 text-[0.7rem] font-bold text-gray-400 flex items-center cursor-not-allowed">
                    Out of Stock
                </button>
            @endif
        </div>
    </div>
</div>
</div>

<div class="mx-auto max-w-[1420px] px-6 pb-20 md:px-10">
    <hr class="mb-8 border-neutral-200">
    <h2 class="mb-8 font-sans text-lg font-bold text-black">Product yang berhubungan</h2>

    <div class="relative">
        <button type="button" onclick="document.getElementById('relatedCarousel').scrollBy({ left: -250, behavior: 'smooth' })" class="absolute left-0 top-[40%] z-10 -ml-5 flex -translate-y-1/2 cursor-pointer items-center justify-center border border-neutral-200 bg-white p-2 text-black shadow-md transition hover:bg-neutral-50" aria-label="Sebelumnya">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button type="button" onclick="document.getElementById('relatedCarousel').scrollBy({ left: 250, behavior: 'smooth' })" class="absolute right-0 top-[40%] z-10 -mr-5 flex -translate-y-1/2 cursor-pointer items-center justify-center border border-neutral-200 bg-white p-2 text-black shadow-md transition hover:bg-neutral-50" aria-label="Berikutnya">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <div id="relatedCarousel" class="scrollbar-hide flex snap-x gap-6 overflow-x-auto scroll-smooth pb-6">
            @foreach($relatedProducts as $related)
                <div class="w-48 shrink-0 snap-start">
                    <x-product-card :product="$related" />
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    let qty = {{ $product->stock > 0 ? 1 : 0 }};
    const maxQty = {{ $product->stock }};
    const qtyEl = document.getElementById('qtyCount');

    function decreaseQty() {
        if (qty > 1) {
            qty--;
            qtyEl.innerText = qty;
        }
    }

    function increaseQty() {
        if (qty < maxQty) {
            qty++;
            qtyEl.innerText = qty;
        }
    }

    function addToCart(btn) {
        if (qty === 0) return;

        let items = [];
        try {
            items = JSON.parse(localStorage.getItem('cartItems')) || [];
        } catch (e) {
            items = [];
        }

        const existingItemIndex = items.findIndex(item => item.id === {{ $product->id }});
        if (existingItemIndex > -1) {
            items[existingItemIndex].qty += qty;
        } else {
            items.push({
                id: {{ $product->id }},
                name: @json($product->name),
                price: {{ $product->price }},
                qty: qty,
                slug: @json($product->slug),
                image: @json($product->image)
            });
        }

        localStorage.setItem('cartItems', JSON.stringify(items));

        if (typeof window.updateCartBadge === 'function') {
            window.updateCartBadge();
        }

        const toast = document.getElementById('cartToast');
        if (toast) {
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 5000);
        }
    }
</script>
@endsection

