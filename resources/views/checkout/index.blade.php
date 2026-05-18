@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    
    <!-- Top Progress Bar -->
    <div class="flex items-center space-x-6 mb-10 pl-2">
        <div class="flex items-center text-[#00a8e8]">
            <div class="w-10 h-10 rounded-full bg-[#00a8e8] text-white flex items-center justify-center font-bold text-xl mr-3">1</div>
            <div class="leading-tight">
                <span class="block font-bold text-sm">Customer</span>
                <span class="block font-bold text-sm">Information</span>
            </div>
        </div>
        <div class="flex items-center text-gray-300">
            <div class="w-10 h-10 rounded-full border-2 border-gray-200 bg-white flex items-center justify-center font-bold text-xl mr-3">2</div>
            <div class="leading-tight">
                <span class="block font-bold text-sm">Shipping</span>
                <span class="block font-bold text-sm">Method</span>
            </div>
        </div>
        <div class="flex items-center text-gray-300">
            <div class="w-10 h-10 rounded-full border-2 border-gray-200 bg-white flex items-center justify-center font-bold text-xl mr-3">3</div>
            <div class="leading-tight">
                <span class="block font-bold text-sm">Payment</span>
                <span class="block font-bold text-sm">Method</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column: Forms -->
        <div class="w-full lg:w-[65%] bg-white rounded-lg shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] p-8">
            
            <!-- General Information -->
            <div class="mb-10">
                <h2 class="text-xl text-gray-800 mb-6 font-medium">General Information</h2>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 pb-6 border-b border-gray-100">
                    <div class="mb-4 md:mb-0 pr-6">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Create account</span>
                            <!-- Toggle switch -->
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in ml-4">
                                <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-300" style="top:2px;left:2px;transition:all .3s;" checked/>
                                <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                            <style>
                                .toggle-checkbox:checked { right: 0; border-color: #68D391; left: 18px !important; }
                                .toggle-checkbox:checked + .toggle-label { background-color: #68D391; }
                            </style>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">You are checking out as guest.<br>Turn on to create new account.</p>
                    </div>
                    <div class="hidden md:block w-px h-12 bg-gray-200 mx-6"></div>
                    <div class="flex items-center relative text-sm text-black font-medium px-4 bg-white -ml-8 mr-4 z-10 md:static md:bg-transparent md:mx-0">OR</div>
                    <div class="text-center md:text-left flex flex-col items-center">
                        <span class="text-sm font-medium text-gray-700 mb-2 block">Already a member?</span>
                        <a href="{{ route('login') }}" class="inline-block px-8 py-1.5 border border-[#00a8e8] text-[#00a8e8] font-medium rounded-full text-sm hover:bg-[#00a8e8] hover:text-white transition">Login</a>
                    </div>
                </div>

                <!-- Input fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <input type="text" placeholder="First Name" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500">
                    </div>
                    <div>
                        <input type="text" placeholder="Last Name" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500">
                    </div>
                    <div>
                        <input type="email" placeholder="Email" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500">
                    </div>
                    <div>
                        <input type="text" placeholder="Phone" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500">
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div>
                <h2 class="text-xl text-gray-800 mb-4 font-medium">Shipping Address</h2>
                
                <div class="border-2 border-[#00a8e8] p-6 relative rounded-sm">
                    <!-- Top Right Blue Triangle Checkmark -->
                    <div class="absolute top-0 right-0 w-0 h-0 border-t-[30px] border-l-[30px] border-t-[#00a8e8] border-l-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white absolute -top-[28px] -left-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 pt-2">
                        <div>
                            <input type="text" placeholder="First Name" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                        <div>
                            <input type="text" placeholder="Last Name" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" placeholder="Address" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <input type="text" placeholder="Apt, Suite, etc. (optional)" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                        
                        <div class="relative">
                            <label class="text-[0.65rem] text-gray-500 absolute top-0 left-0">Country</label>
                            <select class="w-full border-b border-gray-200 py-2 pt-4 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-800 bg-transparent appearance-none">
                                <option>Indonesia</option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#00a8e8] absolute right-0 bottom-2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        
                        <div class="relative">
                            <label class="text-[0.65rem] text-gray-500 absolute top-0 left-0">State/Province</label>
                            <select class="w-full border-b border-gray-200 py-2 pt-4 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-800 bg-transparent appearance-none">
                                <option></option>
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#00a8e8] absolute right-0 bottom-2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <div>
                            <input type="text" placeholder="City" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                        <div>
                            <input type="text" placeholder="Postal/Zip Code" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                        <div>
                            <input type="text" placeholder="Phone" class="w-full border-b border-gray-200 py-2 focus:outline-none focus:border-[#00a8e8] text-sm text-gray-700 placeholder-gray-500 bg-transparent">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Right Column: Cart Summary -->
        <div class="w-full lg:w-[35%]">
            <div class="bg-white rounded-lg shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] p-8 sticky top-6">
                <h2 class="text-xl text-gray-800 mb-6 font-medium">Cart</h2>
                
                <div id="checkoutCartItems" class="space-y-6 max-h-[400px] overflow-y-auto pr-2 mb-6 border-b border-gray-100 pb-6">
                    <!-- JS renders items here -->
                </div>
                
                <div class="mb-6 border-b border-gray-100 pb-6 text-center">
                    <a href="#" class="text-[#00a8e8] text-sm font-medium hover:underline">Apply Coupon Code</a>
                </div>
                
                <div class="flex justify-between items-center px-4">
                    <span class="text-sm font-medium text-gray-700">Subtotal</span>
                    <span id="checkoutSubtotal" class="text-sm font-medium text-gray-800">Rp 0</span>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
    const KS_PLACEHOLDER = 'https://kpopstation.net/resources/georgeous907d3d51/assets/images/product-placeholder.png';
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number).replace('Rp', 'Rp ').replace(',00', '');
    }

    function loadCheckoutCart() {
        let items = [];
        try {
            items = JSON.parse(localStorage.getItem('cartItems')) || [];
        } catch (e) {
            items = [];
        }
        
        const container = document.getElementById('checkoutCartItems');
        const subtotalEl = document.getElementById('checkoutSubtotal');
        
        if (items.length === 0) {
            container.innerHTML = '<p class="text-sm text-gray-500 text-center py-4">Your cart is empty.</p>';
            subtotalEl.innerText = formatRupiah(0);
            return;
        }

        let html = '';
        let subtotal = 0;

        items.forEach((item) => {
            const itemTotal = item.price * item.qty;
            subtotal += itemTotal;
            
            html += `
                <div class="flex items-center relative pl-2">
                    <div class="relative flex-shrink-0 w-16 h-16 mr-4 bg-[#f5f5f5] flex items-center justify-center p-1 border border-gray-100 rounded-sm">
                        <!-- Qty Badge -->
                        <span class="absolute -top-2 -left-2 flex h-5 w-5 items-center justify-center rounded-full bg-[#019700] text-[10px] font-bold text-white">${item.qty}</span>
                        <img src="${item.image ? '/images/' + item.image : KS_PLACEHOLDER}" alt="" class="h-full w-full object-contain mix-blend-multiply" onerror="this.src=KS_PLACEHOLDER">
                    </div>
                    <div class="flex-grow pr-2">
                        <h4 class="text-xs font-bold text-gray-800 leading-tight mb-1 line-clamp-2">${item.name}</h4>
                    </div>
                    <div class="text-right flex-shrink-0 ml-2">
                        <span class="text-xs text-gray-800 font-medium">${formatRupiah(itemTotal)}</span>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
        subtotalEl.innerText = formatRupiah(subtotal);
    }

    document.addEventListener('DOMContentLoaded', loadCheckoutCart);
</script>
@endsection
