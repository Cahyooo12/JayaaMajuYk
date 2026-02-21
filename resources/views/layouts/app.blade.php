<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Jaya Maju Yk')</title>
    <meta name="description" content="@yield('description', 'Distributor resmi mesin kasir, printer thermal, barcode scanner, dan peralatan kasir lengkap di Jogja.')">
    <meta name="keywords" content="@yield('keywords', 'mesin kasir jogja, jual mesin kasir yogyakarta, printer kasir murah jogja')">
    <meta name="author" content="Jaya Maju Yk">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0E3481',
                        secondary: '#00BFA6',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

<!-- Navigation -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="size-10 bg-primary rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-white">confirmation_number</span>
            </div>
            <div>
                <h1 class="font-black text-xl tracking-tighter text-slate-800 leading-none">JAYA MAJU</h1>
                <p class="text-[10px] font-bold text-secondary tracking-[0.2em] uppercase">POS Specialist</p>
            </div>
        </a>

        <div class="flex items-center gap-6">
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('catalog') }}" class="text-sm font-bold text-slate-600 hover:text-primary transition-colors">Katalog</a>
                <a href="{{ route('admin.login') }}" class="text-sm font-bold text-slate-600 hover:text-primary transition-colors">
                    {{ session('user') ? 'Admin Panel' : 'Login Admin' }}
                </a>
            </div>

            <!-- Icons -->
            <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                <a href="{{ route('compare') }}" class="relative p-2 text-slate-600 hover:text-primary transition-colors" title="Bandingkan">
                    <span class="material-symbols-outlined">compare_arrows</span>
                    @if(session('compare') && count(session('compare')) > 0)
                        <span class="absolute top-0 right-0 size-5 bg-secondary text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-sm border-2 border-white">
                            {{ count(session('compare')) }}
                        </span>
                    @endif
                </a>
                
                <a href="{{ route('cart') }}" class="relative p-2 text-slate-600 hover:text-primary transition-colors" title="Keranjang">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    @php 
                        $cart_count = session('cart') ? array_sum(array_column(session('cart'), 'qty')) : 0;
                    @endphp
                    @if($cart_count > 0)
                        <span class="absolute top-0 right-0 size-5 bg-primary text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-sm border-2 border-white">
                            {{ $cart_count }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow">
    @yield('content')
</main>

<footer class="bg-slate-900 text-white pt-24 pb-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="size-10 bg-white/10 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary">confirmation_number</span>
                    </div>
                    <span class="font-black text-xl tracking-tighter">JAYA MAJU YK</span>
                </div>
                <p class="text-slate-400 leading-relaxed max-w-sm">
                    Mitra terpercaya untuk solusi kasir modern. Kami menyediakan hardware POS berkualitas tinggi dengan dukungan teknis terbaik di Yogyakarta.
                </p>
            </div>
            
            <div>
                <h4 class="font-bold text-lg mb-6">Layanan</h4>
                <ul class="space-y-4 text-slate-400">
                    <li><a href="#" class="hover:text-secondary transition-colors">Instalasi Hardware</a></li>
                    <li><a href="#" class="hover:text-secondary transition-colors">Training Kasir</a></li>
                    <li><a href="#" class="hover:text-secondary transition-colors">Servis & Maintenance</a></li>
                    <li><a href="#" class="hover:text-secondary transition-colors">Konsultasi Sistem</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6">Hubungi Kami</h4>
                <ul class="space-y-4 text-slate-400">
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-sm">call</span>
                        0812-3456-7890
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-sm">location_on</span>
                        Sleman, Yogyakarta
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-sm">mail</span>
                        hello@jayamaju.id
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} Jaya Maju Yk. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp -->
<a 
    href="https://wa.me/62859166338595?text=Halo%20Jaya%20Maju%20Yk!%20Saya%20ingin%20konsultasi%20tentang%20mesin%20kasir."
    target="_blank"
    rel="noopener noreferrer"
    class="fixed bottom-6 right-6 z-50 size-14 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform group"
>
    <svg class="size-8 fill-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766 0-3.18-2.587-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.512-2.961-2.628-.086-.117-.718-.953-.718-1.815 0-.862.452-1.286.613-1.46.16-.174.354-.217.472-.217.118 0 .236 0 .338.005.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289-.087.101-.183.226-.261.304-.087.087-.177.182-.076.354.101.174.449.741.964 1.201.662.591 1.221.777 1.394.864.174.088.275.073.377-.043.101-.116.434-.506.549-.68.116-.174.232-.145.39-.087.159.058 1.012.477 1.185.564.174.087.29.13.332.202.043.073.043.419-.101.824z" />
    </svg>
</a>

@stack('scripts')

</body>
</html>
