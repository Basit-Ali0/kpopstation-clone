@php($logoMain = 'https://cdn.isellercommerce.com/f205a4a0321740a09d2da128dbe75a85/799d34a7e548421e95cc9850e158ec29.png')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kpop Station (Retail)">
    <title>@yield('title', 'Kpop Station')</title>
    <link rel="icon" href="https://cdn.isellercommerce.com/f205a4a0321740a09d2da128dbe75a85/7c7874f0fc02474490ff2052597bc9cc.png?size=32" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-white font-sans text-black antialiased">
    {{-- Search overlay --}}
    <input type="checkbox" id="ks-search-toggle" class="peer/ksrch hidden" aria-hidden="true">
    <div class="fixed inset-0 z-[100] bg-white/98 opacity-0 pointer-events-none transition peer-checked/ksrch:opacity-100 peer-checked/ksrch:pointer-events-auto">
        <label for="ks-search-toggle" class="absolute right-6 top-6 cursor-pointer text-3xl leading-none">&times;</label>
        <div class="mx-auto mt-28 max-w-2xl px-6">
            <form action="{{ route('collection.index', ['categorySlug' => 'all']) }}" method="GET" class="border-b border-black pb-2">
                <div class="flex items-center gap-3">
                    <span class="ion-ios-search text-2xl text-neutral-700"></span>
                    <input type="search" name="q" value="{{ request('q') }}" autocomplete="off" placeholder="Pencarian" class="placeholder:text-neutral-500 flex-1 bg-transparent text-lg outline-none">
                </div>
            </form>
        </div>
    </div>

    {{-- Mobile menu --}}
    <input type="checkbox" id="ks-nav-toggle" class="peer/nav hidden" aria-hidden="true">

    <header class="border-b border-black">
        <div class="lg:hidden">
            <div class="flex items-center justify-between px-3 py-3">
                <label for="ks-nav-toggle" class="flex cursor-pointer flex-col gap-[5px] p-2" aria-label="Menu">
                    <span class="block h-[2px] w-6 bg-black"></span>
                    <span class="block h-[2px] w-6 bg-black"></span>
                    <span class="block h-[2px] w-6 bg-black"></span>
                </label>
                <a href="{{ route('home') }}" class="inline-block">
                    <img src="{{ $logoMain }}" alt="Kpop Station" class="h-12 max-h-12 object-contain object-center">
                </a>
                <div class="flex items-center gap-2 text-black">
                    @guest
                        <a href="{{ route('login') }}" class="ion-ios-person-outline block p-2 text-2xl" aria-label="Login"></a>
                    @else
                        <div class="group relative px-2 text-center font-sans">
                            <span class="cursor-default text-[10px] font-bold uppercase tracking-wide">{{ \Illuminate\Support\Str::limit(Auth::user()->first_name, 14) }}</span>
                            <div class="pointer-events-none absolute right-0 top-full z-[60] mt-1 min-w-[7rem] border border-neutral-300 bg-white text-left opacity-0 shadow-md transition group-hover:pointer-events-auto group-hover:opacity-100">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2 text-left font-sans text-xs font-semibold hover:bg-neutral-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                    <a href="{{ route('cart.index') }}" class="ion-ios-cart relative block p-2 text-2xl" aria-label="Keranjang">
                        <span id="cartCountBadge" class="absolute top-1 right-0 hidden min-h-[17px] min-w-[17px] rounded-full bg-[#ca2027] px-0.5 text-center text-[9px] font-bold leading-[17px] text-white"></span>
                    </a>
                </div>
            </div>

            {{-- Drawer --}}
            <div class="fixed inset-0 z-[90] lg:hidden opacity-0 pointer-events-none invisible transition peer-checked/nav:opacity-100 peer-checked/nav:pointer-events-auto peer-checked/nav:visible">
                <label for="ks-nav-toggle" class="absolute inset-0 cursor-pointer bg-black/40"></label>
                <aside class="absolute left-0 top-0 flex h-full w-[85%] max-w-[320px] flex-col gap-6 overflow-y-auto border-r border-black bg-white px-6 py-8 shadow-xl translate-x-[-100%] peer-checked/nav:translate-x-0 transition">
                    <a href="{{ route('home') }}"><img src="{{ $logoMain }}" alt="Kpop Station" class="mx-auto mb-6 h-14 object-contain"></a>
                    <form action="{{ route('collection.index', ['categorySlug' => 'all']) }}" method="GET" class="relative border-b border-black pb-1">
                        <span class="ion-ios-search absolute left-0 text-lg text-neutral-600"></span>
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Pencarian" class="w-full border-none py-2 pl-7 text-xs outline-none placeholder:text-neutral-600">
                    </form>
                    <nav class="flex flex-col gap-4 font-sans text-xs font-bold uppercase tracking-[0.12em] text-black">
                        <a href="{{ route('collection.index', ['categorySlug' => 'all']) }}">ALL PRODUCTS</a>
                        <a href="{{ route('collection.index', ['categorySlug' => 'album']) }}">ALBUM</a>
                        <a href="{{ route('collection.index', ['categorySlug' => 'lightstick']) }}">LIGHTSTICK</a>
                        <a href="{{ route('collection.index', ['categorySlug' => 'merchandise']) }}">MERCH</a>
                    </nav>
                    <button type="button" class="absolute right-6 top-5 text-3xl leading-none" onclick="document.getElementById('ks-nav-toggle').checked=false" aria-label="Tutup">&times;</button>
                </aside>
            </div>
        </div>

        {{-- Desktop --}}
        <div class="hidden lg:block">
            <div id="header" class="relative mx-auto max-w-[1420px] px-10 py-8">
                <div class="mb-10 flex items-end justify-between">
                    <a href="{{ route('home') }}" class="flex-shrink-0 pt-4">
                        <img id="store_logo" src="{{ $logoMain }}?size=x80" alt="Kpop Station" class="max-h-20">
                    </a>
                    <ul class="flex flex-1 justify-center gap-14 font-sans text-[11px] font-bold uppercase tracking-[0.12em] text-black xl:gap-24">
                        <li><a class="hover:text-[#c62828]" href="{{ route('collection.index', ['categorySlug' => 'all']) }}">ALL PRODUCTS</a></li>
                        <li><a class="hover:text-[#c62828]" href="{{ route('collection.index', ['categorySlug' => 'album']) }}">ALBUM</a></li>
                        <li><a class="hover:text-[#c62828]" href="{{ route('collection.index', ['categorySlug' => 'lightstick']) }}">LIGHTSTICK</a></li>
                        <li><a class="hover:text-[#c62828]" href="{{ route('collection.index', ['categorySlug' => 'merchandise']) }}">MERCH</a></li>
                    </ul>
                    <div class="flex w-[22%] min-w-[10rem] max-w-[16rem] items-center justify-around text-2xl text-black">
                        @guest
                            <a href="{{ route('login') }}" class="ion-ios-person-outline block p-1" aria-label="Login"></a>
                        @else
                            <div class="relative group px-3 text-[10px] font-bold uppercase">
                                <button type="button" class="inline-flex cursor-default flex-col gap-px text-right">
                                    Hi, {{ \Illuminate\Support\Str::limit(explode(' ', Auth::user()->first_name)[0] ?? 'You', 10) }}
                                    <span class="text-[12px] text-neutral-800">▼</span>
                                </button>
                                <div class="pointer-events-none absolute right-0 top-full z-[60] mt-1 min-w-[8rem] border border-neutral-300 bg-white opacity-0 shadow-md transition group-hover:pointer-events-auto group-hover:opacity-100">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 text-left text-xs font-semibold text-[#ca2027] hover:bg-neutral-50">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                        <a href="{{ route('cart.index') }}" class="ion-ios-cart-outline relative block p-1" aria-label="Keranjang">
                            <span id="cartCountBadgeDesktop" class="absolute -right-1 -top-1 hidden min-h-[17px] min-w-[17px] rounded-full bg-[#ca2027] px-0.5 text-center text-[9px] font-bold leading-[17px] text-white"></span>
                        </a>
                        <label for="ks-search-toggle" class="ion-ios-search block cursor-pointer p-1" aria-label="Cari"></label>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="w-full flex-1">
        @yield('content')
    </main>

    <footer class="mt-12 border-t border-neutral-300 bg-[#f5f5f5] pt-14 pb-8 font-sans text-[13px] leading-relaxed text-black">
        <div class="mx-auto grid max-w-[1420px] gap-12 px-6 md:grid-cols-3 md:px-10">
            <div>
                <a href="{{ route('home') }}"><img src="{{ $logoMain }}" alt="Kpop Station" class="mb-6 max-h-[70px]"></a>
                <p class="mb-3">GRAHA KASTURI (LANTAI 3). JL PETOGOGAN II NO.35A RT8/RW6, PULO. KEC KEBAYORAN BARU. JAKARTA SELATAN 12160</p>
                <p class="mb-3">MALL OF INDONESIA, LANTAI 2, JAKARTA UTARA.</p>
                <p class="mb-3">RUKO MAGGIORE GRANDE. BLOK A NO.26, GADING SERPONG, TANGERANG</p>
                <p class="mb-6">JALAN BATUNUNGGAL INDAH RAYA NO.383, BANDUNG</p>
                <div class="flex flex-col gap-2 font-sans text-xs font-semibold uppercase tracking-wide">
                    <a href="https://www.instagram.com/kpopstation.official" class="flex items-center gap-2 hover:text-[#c62828]" target="_blank" rel="noopener"><span class="ion-social-instagram text-lg"></span> @kpopstation.official</a>
                    <a href="https://x.com/kpopstation_id" class="flex items-center gap-2 hover:text-[#c62828]" target="_blank" rel="noopener"><span class="ion-social-twitter text-lg"></span> @kpopstation_id</a>
                    <a href="https://api.whatsapp.com/send?phone=6289664751000" class="flex items-center gap-2 hover:text-[#c62828]" target="_blank" rel="noopener"><span class="ion-social-whatsapp text-lg"></span> Kpopstation</a>
                </div>
            </div>
            <div>
                <h3 class="ks-heading mb-4">CUSTOMER SERVICE</h3>
                <nav class="flex flex-col gap-2 font-sans text-[11px] font-bold uppercase tracking-wide">
                    <a href="https://kpopstation.net/account/orders" target="_blank" rel="noopener" class="hover:text-[#019700]">Orders</a>
                    <a href="https://kpopstation.net/shipping-policy" target="_blank" rel="noopener" class="hover:text-[#019700]">Shipping policy</a>
                    <a href="https://kpopstation.net/faq" target="_blank" rel="noopener" class="hover:text-[#019700]">FAQ</a>
                    <a href="https://kpopstation.net/refund-policy" target="_blank" rel="noopener" class="hover:text-[#019700]">Refund policy</a>
                    <span class="h-4"></span>
                    <a href="https://kpopstation.net/terms-of-service" target="_blank" rel="noopener" class="hover:text-[#019700]">Terms of service</a>
                    <a href="https://kpopstation.net/privacy-policy" target="_blank" rel="noopener" class="hover:text-[#019700]">Privacy policy</a>
                </nav>
            </div>
            <div>
                <h3 class="ks-heading mb-4">Payment methods</h3>
                @php($cdnPay = 'https://cdn.isellercommerce.com/f205a4a0321740a09d2da128dbe75a85/theme_content/')
                <div class="mb-10 flex flex-wrap items-center gap-4">
                    <img src="{{ $cdnPay }}2883510.png" alt="" class="h-7 object-contain">
                    <img src="{{ $cdnPay }}logo_ovo_purple.svg.png" alt="OVO" class="h-7 object-contain">
                    <img src="{{ $cdnPay }}logo_dana_blue.svg.png" alt="DANA" class="h-7 object-contain">
                    <img src="{{ $cdnPay }}shopee-pay-logo-2217cdc100-seeklogo.com.png" alt="ShopeePay" class="h-8 object-contain">
                </div>
                <h3 class="ks-heading mb-4">Shipping services</h3>
                <div class="flex flex-wrap items-center gap-4">
                    <img src="{{ $cdnPay }}gojek_logo_2022.svg.png" alt="Gojek" class="h-8 object-contain">
                    <img src="{{ $cdnPay }}png-transparent-singapore-grab-logo-uber-care-logo-company-text-trademark.png" alt="Grab" class="h-8 object-contain">
                    <img src="{{ $cdnPay }}logo-jne-express.png" alt="JNE" class="h-8 object-contain">
                </div>
            </div>
        </div>
        <div class="mx-auto mt-10 max-w-[1420px] border-t border-neutral-300 px-6 pt-6 text-center font-sans text-[11px] font-bold text-black md:px-10">
            @php($y = date('Y'))
            ©{{ $y }} Kpop Station. All Rights Reserved.
        </div>
    </footer>

    <script>
        function updateCartBadge() {
            let items = [];
            try { items = JSON.parse(localStorage.getItem('cartItems')) || []; } catch (e) { items = []; }
            const count = items.reduce((t, i) => t + (Number(i.qty) || 0), 0);
            ['cartCountBadge', 'cartCountBadgeDesktop'].forEach(function (id) {
                const badge = document.getElementById(id);
                if (!badge) return;
                if (count > 0) {
                    badge.textContent = count > 99 ? '99+' : String(count);
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', updateCartBadge);
        window.updateCartBadge = updateCartBadge;

        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const s = document.getElementById('ks-search-toggle');
                const n = document.getElementById('ks-nav-toggle');
                if (s.checked) { s.checked = false; }
                if (n && n.checked) { n.checked = false; }
            }
        });
    </script>
</body>
</html>
