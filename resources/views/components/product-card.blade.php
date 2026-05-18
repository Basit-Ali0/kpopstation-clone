@props(['product', 'showNewBadge' => false])

@php
    $placeholder = 'https://kpopstation.net/resources/georgeous907d3d51/assets/images/product-placeholder.png';
    $imgSrc = $product->image ? asset('images/'.$product->image) : $placeholder;
@endphp

<div class="ks-product-card group flex flex-col text-center" {{ $attributes }}>
    <a href="{{ route('product.show', $product->slug) }}" class="relative block">
        @if($showNewBadge)
            <span class="absolute left-1 top-1 z-10 bg-black px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-white">Baru</span>
        @endif
        <div class="ks-product-img relative mb-2 aspect-square w-full overflow-hidden bg-[#f5f5f5]">
            <img src="{{ $imgSrc }}" alt="{{ $product->name }}" loading="lazy" class="size-full object-cover transition duration-300 group-hover:scale-[1.02]" onerror="this.src='{{ $placeholder }}'">
        </div>
        <header class="border-b border-black pb-2">
            <h6 class="ks-product-title truncate px-1 font-sans text-[11px] font-normal uppercase leading-snug tracking-wide text-black group-hover:text-[#c62828]">
                {{ $product->name }}
            </h6>
        </header>
    </a>
    <section class="product-info px-1 pt-2 font-sans">
        @if($product->stock > 0 && $product->stock <= 10)
            <p class="text-[11px] font-medium text-orange-600">Low Stock</p>
            <p class="text-[13px] font-normal text-black">IDR {{ number_format((float) $product->price, 0, ',', '.') }}</p>
        @elseif($product->stock == 0)
            <p class="text-[11px] font-medium text-[#d32f2f]">Out of Stock</p>
            <p class="text-[13px] font-normal text-black">IDR {{ number_format(0, 0, ',', '.') }}</p>
        @else
            <p class="mt-1 text-[13px] font-normal text-black">IDR {{ number_format((float) $product->price, 0, ',', '.') }}</p>
        @endif
    </section>
</div>
