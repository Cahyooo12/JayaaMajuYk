@extends('layouts.app')

@section('title', $product->name . ' - Jaya Maju Yk')

@section('content')
<div class="max-w-[1200px] mx-auto px-6 py-8">
      <div class="flex flex-wrap items-center gap-2 mb-8 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
        <span>/</span>
        <span class="text-gray-400">{{ $product->category }}</span>
        <span>/</span>
        <span class="text-slate-900 font-bold">{{ $product->name }}</span>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">
        <!-- Images -->
        <div class="lg:col-span-7 space-y-4">
          <div class="relative group aspect-square rounded-2xl overflow-hidden bg-white border border-slate-100 shadow-sm">
            <img 
              id="mainImage"
              class="w-full h-full object-contain p-8 transition-transform duration-700 hover:scale-105" 
              src="{{ Str::startsWith($product->image, 'assets') ? asset($product->image) : $product->image }}" 
              alt="{{ $product->name }}"
            />
          </div>
          
          @if ($product->images && count($product->images) > 1)
          <div class="flex gap-4 overflow-x-auto pb-2 text-center">
              @foreach ($product->images as $img)
                <button onclick="document.getElementById('mainImage').src = '{{ Str::startsWith($img, 'assets') ? asset($img) : $img }}'" class="size-20 rounded-xl border border-slate-200 bg-white p-2 hover:border-primary transition-colors shrink-0">
                    <img src="{{ Str::startsWith($img, 'assets') ? asset($img) : $img }}" class="w-full h-full object-contain">
                </button>
              @endforeach
          </div>
          @endif
        </div>

        <!-- Info -->
        <div class="lg:col-span-5 flex flex-col gap-8">
          <section>
            <div class="flex gap-2 mb-4">
              <span class="inline-block px-3 py-1 bg-primary/5 text-primary text-[10px] font-bold uppercase tracking-widest rounded-full">Enterprise Grade</span>
              @if ($product->is_ready_stock)
                 <span class="inline-block px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold uppercase tracking-widest rounded-full">Stok Tersedia</span>
              @endif
            </div>
            <h1 class="text-slate-900 text-4xl font-extrabold leading-tight tracking-tight mb-2">{{ $product->name }}</h1>
            <p class="text-slate-500 text-base mb-6 leading-relaxed">{{ $product->description }}</p>
            <div class="flex items-baseline gap-3">
              <h2 class="text-primary text-3xl font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
              @if ($product->original_price)
                <span class="text-slate-400 line-through text-lg">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
              @endif
            </div>
          </section>

          <section class="p-6 bg-white rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Certified Compatibility</h3>
            <div class="flex flex-wrap gap-4">
               <div class="flex items-center gap-2 text-slate-400 text-sm">
                   <span class="material-symbols-outlined">check_circle</span> Windows
                   <span class="material-symbols-outlined">check_circle</span> Android
               </div>
            </div>
          </section>

          <div class="grid grid-cols-2 gap-4">
            <!-- Add to Cart -->
            <form action="#" method="POST" class="col-span-2 md:col-span-1">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" class="w-full h-14 rounded-xl bg-primary text-white font-bold text-lg hover:bg-opacity-90 transition-all active:scale-95 shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    + Keranjang
                </button>
            </form>

            <!-- Add to Compare -->
            <form action="#" method="POST" class="col-span-2 md:col-span-1">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" class="w-full h-14 rounded-xl border-2 border-slate-200 text-slate-600 font-bold text-lg hover:border-primary hover:text-primary transition-all active:scale-95 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">compare_arrows</span>
                    Bandingkan
                </button>
            </form>
          </div>
          
          <div class="flex items-center justify-center gap-2 text-slate-400 text-xs">
            <span class="material-symbols-outlined text-sm">verified_user</span>
            <span>Official Jaya Maju Store Warranty Included</span>
          </div>
        </div>
      </div>

      <!-- Tech Specs -->
      @if ($product->specs)
      <section class="mb-16">
        <h2 class="text-2xl font-extrabold text-slate-900 mb-8 border-l-4 border-primary pl-4">Spesifikasi Teknis</h2>
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
          <table class="w-full text-left border-collapse">
            <tbody class="divide-y divide-slate-100">
                  @foreach ($product->specs as $key => $value)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-5 text-sm font-semibold text-slate-600 w-1/3">{{ $key }}</td>
                        <td class="p-5 text-sm text-slate-900 font-medium">{{ $value }}</td>
                    </tr>
                  @endforeach
            </tbody>
          </table>
        </div>
      </section>
      @endif

      <!-- Related Products -->
      @if($relatedProducts->isNotEmpty())
      <section>
          <h2 class="text-2xl font-extrabold text-slate-900 mb-8 border-l-4 border-primary pl-4">Produk Terkait</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
              @foreach($relatedProducts as $related)
              <div class="bg-white rounded-2xl border border-slate-100 p-4 transition-all hover:shadow-lg">
                  <a href="{{ route('product.show', $related->id) }}">
                      <div class="aspect-square rounded-xl overflow-hidden bg-slate-50 mb-4">
                          <img src="{{ Str::startsWith($related->image, 'assets') ? asset($related->image) : $related->image }}" alt="{{ $related->name }}" class="w-full h-full object-contain p-2">
                      </div>
                      <h3 class="font-bold text-slate-900 text-sm mb-2 truncate">{{ $related->name }}</h3>
                      <p class="text-primary font-black">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                  </a>
              </div>
              @endforeach
          </div>
      </section>
      @endif
    </div>
@endsection
