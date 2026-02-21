

<?php $__env->startSection('title', 'Bandingkan Produk - Jaya Maju Yk'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-[1280px] mx-auto px-4 lg:px-10 py-8">
    <nav class="flex items-center gap-2 py-4 text-sm text-gray-500">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-primary transition-colors">Home</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-primary font-semibold">Bandingkan Produk</span>
    </nav>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 py-8">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-black text-primary leading-tight tracking-tight mb-2">Perbandingan Hardware POS</h1>
            <p class="text-gray-600 text-lg">Analisis detail untuk membantu Anda memilih peralatan terbaik untuk bisnis.</p>
        </div>
        <?php if($compareProducts->isNotEmpty()): ?>
        <form action="<?php echo e(route('compare.clear')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors">
                <span class="material-symbols-outlined text-lg">delete</span> Kosongkan
            </button>
        </form>
        <?php endif; ?>
    </div>

    <?php if($compareProducts->isEmpty()): ?>
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
            <span class="material-symbols-outlined text-6xl text-gray-200 mb-4">compare_arrows</span>
            <h2 class="text-xl font-bold text-slate-800">Belum ada produk untuk dibandingkan</h2>
            <p class="text-slate-500 mt-2 mb-6">Pilih produk dari katalog untuk mulai membandingkan.</p>
            <a href="<?php echo e(route('catalog')); ?>" class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-opacity-90 transition-all">
                Lihat Katalog
            </a>
        </div>
    <?php else: ?>
        <div class="mt-8 border border-gray-200 rounded-xl overflow-hidden shadow-2xl bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class="p-8 w-1/4">
                                <span class="text-xs font-black uppercase tracking-widest text-gray-400">Spesifikasi</span>
                            </th>
                            <?php $__currentLoopData = $compareProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="p-6 w-1/4 border-l border-gray-100 align-top">
                                    <div class="flex flex-col gap-4 relative group">
                                        <form action="<?php echo e(route('compare.remove')); ?>" method="POST" class="absolute -top-2 -right-2 z-10">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                                            <button type="submit" class="size-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                                <span class="material-symbols-outlined text-[14px]">close</span>
                                            </button>
                                        </form>
                                        
                                        <img class="w-full h-40 object-contain bg-gray-50 rounded-lg p-4" src="<?php echo e(Str::startsWith($product->image, 'assets') ? asset($product->image) : $product->image); ?>" alt="">
                                        
                                        <div>
                                            <h3 class="text-lg font-bold text-primary leading-tight"><?php echo e($product->name); ?></h3>
                                            <p class="text-xs text-gray-500 mt-1"><?php echo e($product->category); ?></p>
                                        </div>
                                    </div>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-8 bg-gray-50/50">
                                <div class="flex items-center gap-2 text-primary font-bold">
                                    <span class="material-symbols-outlined text-xl">payments</span> Harga
                                </div>
                            </td>
                            <?php $__currentLoopData = $compareProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="p-8 border-l border-gray-100">
                                    <div class="text-2xl font-black text-primary">Rp <?php echo e(number_format($p->price, 0, ',', '.')); ?></div>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php $__currentLoopData = $allSpecKeys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-8 bg-gray-50/50">
                                    <div class="flex items-center gap-2 text-primary font-bold">
                                        <span class="material-symbols-outlined text-xl">info</span> <?php echo e($key); ?>

                                    </div>
                                </td>
                                <?php $__currentLoopData = $compareProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="p-8 border-l border-gray-100 text-sm text-gray-600 font-medium">
                                        <?php echo e($p->specs[$key] ?? '-'); ?>

                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JAYA Maju\resources\views/compare.blade.php ENDPATH**/ ?>