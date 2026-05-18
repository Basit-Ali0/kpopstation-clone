@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-[1.3rem] font-bold text-black mb-10">Keranjang Belanja</h1>

    <div id="cartContent">
        <!-- Rendered by JS -->
    </div>
</div>

<script>
    const KS_PLACEHOLDER = 'https://kpopstation.net/resources/georgeous907d3d51/assets/images/product-placeholder.png';
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number).replace('Rp', 'Rp ').replace(',00', '');
    }

    function loadCart() {
        let items = [];
        try {
            items = JSON.parse(localStorage.getItem('cartItems')) || [];
        } catch (e) {
            items = [];
        }
        
        const container = document.getElementById('cartContent');
        
        if (items.length === 0) {
            container.innerHTML = `
                <div class="text-center py-20 border border-gray-200">
                    <p class="text-sm font-bold text-black mb-4">Keranjang belanja Anda saat ini kosong.</p>
                    <a href="{{ route('collection.index', ['categorySlug' => 'all']) }}" class="inline-block bg-black px-6 py-2.5 text-xs font-bold text-white transition hover:bg-neutral-800">Lanjutkan Belanja</a>
                </div>
            `;
            // Ensure badge hides if 0
            if (typeof window.updateCartBadge === 'function') {
                window.updateCartBadge();
            }
            return;
        }

        let html = '<div class="space-y-8">';
        let subtotal = 0;

        items.forEach((item) => {
            const itemTotal = item.price * item.qty;
            subtotal += itemTotal;
            
            html += `
                <div class="flex flex-col md:flex-row border-b border-gray-100 pb-8 relative">
                    <!-- Delete Button (Top Right) -->
                    <button onclick="removeItem(${item.id})" class="absolute top-0 right-0 text-black hover:text-red-500 font-extrabold text-xl p-2 leading-none focus:outline-none">&times;</button>
                    
                    <!-- Image -->
                    <a href="/product/${item.slug}" class="block">
                        <div class="w-32 h-32 bg-[#f5f5f5] flex-shrink-0 flex items-center justify-center p-2 mb-4 md:mb-0">
                            <img src="${item.image ? '/images/' + item.image : KS_PLACEHOLDER}" alt="" class="w-full h-full object-contain mix-blend-multiply" onerror="this.src=KS_PLACEHOLDER">
                        </div>
                    </a>
                    
                    <!-- Details -->
                    <div class="md:ml-8 flex-grow pr-8 flex flex-col justify-center">
                        <a href="/product/${item.slug}" class="transition hover:text-[#019700]">
                            <h3 class="text-[0.75rem] font-bold text-black mb-2">${item.name}</h3>
                        </a>
                        <p class="text-[0.65rem] text-gray-500 mb-1 font-medium">@ ${formatRupiah(item.price)}</p>
                        <p class="text-[0.75rem] text-black font-medium mb-6">${formatRupiah(itemTotal)}</p>
                        
                        <div class="flex items-center space-x-6">
                            <button onclick="updateQty(${item.id}, -1)" class="text-black font-extrabold text-lg outline-none select-none">&lt;</button>
                            <span class="text-[0.8rem] font-medium w-4 text-center">${item.qty}</span>
                            <button onclick="updateQty(${item.id}, 1)" class="text-black font-extrabold text-lg outline-none select-none">&gt;</button>
                        </div>
                    </div>
                </div>
            `;
        });
        
        html += `</div>`;

        // Footer / Checkout Section
        html += `
            <div class="flex flex-col md:flex-row justify-between mt-12">
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <p class="text-[0.7rem] font-bold text-black mb-2">Kode Diskon</p>
                    <div class="flex h-10">
                        <input type="text" class="border border-gray-300 px-3 py-2 text-sm w-full outline-none focus:border-black transition">
                        <button class="border border-l-0 border-black px-5 py-2 text-xs font-bold text-black hover:bg-gray-50 focus:outline-none transition">Pasang</button>
                    </div>
                </div>
                
                <div class="w-full md:w-[45%]">
                    <div class="flex justify-between mb-4">
                        <span class="text-[0.75rem] font-medium text-black">Subtotal</span>
                        <span class="text-[0.75rem] font-medium text-black">${formatRupiah(subtotal)}</span>
                    </div>
                    <div class="flex justify-between mb-8">
                        <span class="text-[0.75rem] font-medium text-black">Total Keseluruhan</span>
                        <span class="text-[0.75rem] font-medium text-black">${formatRupiah(subtotal)}</span>
                    </div>
                    <a href="/checkout" class="block text-center w-full border border-black py-3 text-[0.75rem] font-bold text-black hover:bg-black hover:text-white transition">Checkout</a>
                </div>
            </div>
        `;

        container.innerHTML = html;
        
        // Update header badge dynamically
        if (typeof window.updateCartBadge === 'function') {
            window.updateCartBadge();
        }
    }

    function updateQty(id, delta) {
        let items = JSON.parse(localStorage.getItem('cartItems')) || [];
        const index = items.findIndex(item => item.id === id);
        if (index > -1) {
            items[index].qty += delta;
            // minimum qty is 1
            if (items[index].qty < 1) items[index].qty = 1;
            localStorage.setItem('cartItems', JSON.stringify(items));
            loadCart(); // re-render
        }
    }

    function removeItem(id) {
        let items = JSON.parse(localStorage.getItem('cartItems')) || [];
        items = items.filter(item => item.id !== id);
        localStorage.setItem('cartItems', JSON.stringify(items));
        loadCart(); // re-render
    }

    document.addEventListener('DOMContentLoaded', loadCart);
</script>
@endsection
