@extends('admin.layout')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-2xl font-black text-slate-800 mb-6">
            {{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}
        </h2>

        <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">ID Produk (Unique)</label>
                    <input type="text" name="id" value="{{ old('id', $product->id ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required {{ isset($product) ? 'readonly' : '' }}>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium">
                        @foreach(['Printer Kasir', 'Barcode Scanner', 'Komputer Kasir', 'Paket Usaha'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $product->category ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga (IDR)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Coret (Opsional)</label>
                    <input type="number" name="original_price" value="{{ old('original_price', $product->original_price ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Produk</label>
                    <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        @if(isset($product) && $product->image)
                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset($product->image) }}" class="size-20 object-cover rounded-xl shadow-sm" alt="Preview">
                        @endif
                        <input type="file" name="image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary file:text-white hover:file:bg-opacity-90 cursor-pointer" {{ isset($product) ? '' : 'required' }}>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-2 italic">* Kosongkan jika tidak ingin mengubah gambar (untuk edit)</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required>{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Spesifikasi (Format: Key=Value, pisahkan dengan baris baru)</label>
                <textarea name="specs_raw" rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium font-mono text-sm" placeholder="Resolusi=203 DPI&#10;Kecepatan=200mm/s">@if(isset($product->specs))@foreach($product->specs as $k => $v){{ "$k=$v\n" }}@endforeach @endif</textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('admin.products.index') }}" class="px-8 py-4 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</a>
                <button type="submit" class="flex-1 px-8 py-4 rounded-xl font-bold text-white bg-primary hover:bg-opacity-90 shadow-lg shadow-primary/20 transition-all active:scale-95">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
