

<?php $__env->startSection('title', 'Daftar Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Daftar Produk</h1>
        <p class="text-slate-500 mt-2">Kelola katalog produk Jaya Maju POS</p>
    </div>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="bg-primary text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center gap-2">
        <span class="material-symbols-outlined">add</span> Tambah Produk
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="p-6 text-xs font-bold uppercase text-slate-400 tracking-wider">Produk</th>
                <th class="p-6 text-xs font-bold uppercase text-slate-400 tracking-wider">Kategori</th>
                <th class="p-6 text-xs font-bold uppercase text-slate-400 tracking-wider">Harga</th>
                <th class="p-6 text-xs font-bold uppercase text-slate-400 tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="size-12 rounded-lg bg-slate-100 border border-slate-200 p-1">
                            <img src="<?php echo e(Str::startsWith($product->image, 'assets') ? asset($product->image) : $product->image); ?>" class="w-full h-full object-contain" alt="">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800"><?php echo e($product->name); ?></h4>
                            <div class="flex gap-2 mt-1">
                                <?php if($product->is_ready_stock): ?>
                                    <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold">Ready</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="p-6">
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-bold">
                        <?php echo e($product->category); ?>

                    </span>
                </td>
                <td class="p-6 font-bold text-slate-900">
                    Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                </td>
                <td class="p-6 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="size-10 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:border-primary hover:text-primary transition-colors" title="Edit">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </a>
                        <form action="<?php echo e(route('admin.products.delete', $product->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="size-10 flex items-center justify-center rounded-lg border border-slate-200 text-red-500 hover:bg-red-50 hover:border-red-200 transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JAYA Maju\resources\views/admin/index.blade.php ENDPATH**/ ?>