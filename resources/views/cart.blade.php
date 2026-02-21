@extends('layouts.app')

@section('title', 'Keranjang Belanja - Jaya Maju Yk')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-black text-slate-900 mb-8">Keranjang Belanja</h1>

    @if (empty($cart))
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
            <span class="material-symbols-outlined text-6xl text-gray-200 mb-4">remove_shopping_cart</span>
            <h2 class="text-xl font-bold text-slate-800">Keranjang masih kosong</h2>
            <a href="{{ route('home') }}" class="mt-6 px-8 py-3 bg-primary text-white rounded-xl font-bold inline-block hover:shadow-lg transition-all">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Cart List -->
            <div class="md:col-span-2 space-y-4">
                @foreach ($cart as $id => $item)
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 flex gap-4 items-center shadow-sm">
                        <div class="size-20 bg-slate-50 rounded-xl p-2 shrink-0">
                            <img src="{{ Str::startsWith($item['image'], 'assets') ? asset($item['image']) : $item['image'] }}" class="w-full h-full object-contain">
                        </div>
                        <div class="flex-grow">
                            <h3 class="font-bold text-slate-900">{{ $item['name'] }}</h3>
                            <div class="text-primary font-bold text-sm">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                        </div>
                        
                        <!-- Qty Control -->
                        <div class="flex items-center gap-3">
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="flex items-center border border-slate-200 rounded-lg h-9">
                                    <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}" class="px-3 text-slate-500 hover:text-primary font-bold" {{ $item['qty'] <= 1 ? 'disabled' : '' }}>-</button>
                                    <input type="number" value="{{ $item['qty'] }}" class="w-12 text-center text-sm font-bold focus:outline-none" readonly>
                                    <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}" class="px-3 text-slate-500 hover:text-primary font-bold">+</button>
                                </div>
                            </form>

                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="size-9 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                
                <div class="text-right">
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 font-bold hover:underline">
                            Kosongkan Keranjang
                        </button>
                    </form>
                </div>
            </div>

            <!-- Summary -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 h-fit shadow-sm">
                <h3 class="font-bold text-lg mb-4">Ringkasan</h3>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-slate-500">Total Belanja</span>
                    <span class="font-black text-2xl text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                @php
                    $whatsapp_message = "Halo Jaya Maju, saya ingin memesan:\n\n";
                    foreach ($cart as $item) {
                        $whatsapp_message .= "- {$item['name']} ({$item['qty']}x) - Rp " . number_format($item['price'] * $item['qty'], 0, ',', '.') . "\n";
                    }
                    $whatsapp_message .= "\nTotal: Rp " . number_format($total, 0, ',', '.');
                    $whatsapp_message .= "\n\nMohon info ketersediaan stok & ongkir.";
                    $wa_link = "https://wa.me/6281234567890?text=" . urlencode($whatsapp_message);
                @endphp

                <a href="{{ $wa_link }}" target="_blank" class="block w-full py-4 bg-[#25D366] text-white text-center rounded-xl font-black uppercase tracking-wider shadow-lg hover:bg-opacity-90 transition-all flex items-center justify-center gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="size-5 filter brightness-0 invert">
                    Checkout WhatsApp
                </a>
                <p class="text-xs text-center text-slate-400 mt-4">Anda akan diarahkan ke WhatsApp untuk menyelesaikan pesanan.</p>
            </div>
        </div>
    @endif
</div>
@endsection
