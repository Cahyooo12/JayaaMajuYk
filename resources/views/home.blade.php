@extends('layouts.app')

@section('title', 'Jaya Maju Yk - Transformasi Retail Dengan Gaya')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-10 pb-20 md:pt-16 md:pb-32">
    <div class="max-w-[1200px] mx-auto px-6">
    <div class="bg-[#0E3481] rounded-[3.5rem] p-8 md:p-20 text-white shadow-[0_40px_100px_-20px_rgba(14,52,129,0.3)] relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-white/5 skew-x-[-20deg] translate-x-1/2 pointer-events-none"></div>
        
        <div class="grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div class="flex flex-col gap-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full w-fit">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-secondary"></span>
            </span>
            <span class="text-white text-[10px] font-black uppercase tracking-widest">Dealer Resmi Yogyakarta</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-black leading-[0.95] tracking-tight">
            Transformasi <span class="text-secondary">Retail</span> Dengan Gaya.
            </h1>
            
            <p class="text-white/70 text-lg md:text-xl max-w-lg leading-relaxed font-medium">
            Upgrade sistem kasir Anda dengan hardware standar internasional. Jaya Maju Yk menghadirkan performa, estetika, dan durabilitas.
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4">
            <a href="{{ route('catalog') }}" class="group bg-secondary text-white px-10 py-5 rounded-2xl font-black hover:bg-opacity-90 transition-all flex items-center gap-3 shadow-xl hover:-translate-y-1 active:scale-95">
                Buka Katalog 
                <span class="material-symbols-outlined font-bold group-hover:translate-x-1 transition-transform">shopping_bag</span>
            </a>
            </div>
        </div>

        <div class="relative hidden lg:block group">
            <div class="animate-float relative z-10 w-full aspect-square bg-white/5 backdrop-blur-sm rounded-[4rem] border border-white/10 p-12 overflow-hidden shadow-2xl">
            <img 
                src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?q=80&w=800&auto=format&fit=crop" 
                class="w-full h-full object-cover rounded-[3rem] shadow-2xl group-hover:scale-105 transition-transform duration-700"
                alt="Premium Hardware POS"
            />
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

<!-- Featured Section -->
<section class="max-w-[1200px] mx-auto px-6 pb-20">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-10 mb-12">
        <div class="space-y-4">
            <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px]">Produk Unggulan</span>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Best Seller</h2>
        </div>
        <a href="{{ route('catalog') }}" class="flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all">
            Lihat Semua <span class="material-symbols-outlined">arrow_forward</span>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($featuredProducts as $product)
        <div class="group bg-white rounded-3xl border border-slate-100 p-4 transition-all duration-300 hover:border-primary/20 hover:shadow-2xl hover:shadow-primary/5 hover:-translate-y-1 flex flex-col h-full active:border-primary/50">
            <!-- Image -->
            <div class="relative aspect-[4/3] rounded-2xl overflow-hidden bg-slate-50 mb-6">
                <img 
                    src="{{ Str::startsWith($product->image, 'assets') ? asset($product->image) : $product->image }}" 
                    alt="{{ $product->name }}" 
                    class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-700"
                />
                <a href="{{ route('product.show', $product->id) }}" class="absolute inset-0 z-10"></a>
            </div>

            <!-- Info -->
            <div class="flex-grow space-y-4 px-2">
                <h3 class="font-black text-lg text-slate-900 leading-tight group-hover:text-primary transition-colors">
                    <a href="{{ route('product.show', $product->id) }}">
                        {{ $product->name }}
                    </a>
                </h3>
                
                <div class="flex items-center gap-2">
                    <span class="text-primary font-black text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-50 flex gap-3 relative z-20">
                <a href="{{ route('product.show', $product->id) }}" class="flex-1 bg-slate-100 hover:bg-primary hover:text-white text-slate-600 font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2 text-sm active:scale-95">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
