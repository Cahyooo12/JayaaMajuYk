<?php
require_once 'functions.php';

// Page SEO
$page_title = 'Katalog Harga Mesin Kasir & Printer 2026 - Jaya Maju Jogja';
$page_desc = 'Daftar harga terbaru printer kasir, scanner barcode, dan paket usaha POS di Yogyakarta. Garansi resmi dan ready stock.';

$products = get_products();
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

// Filtering Logic
if ($search || $category) {
    $products = array_filter($products, function($p) use ($search, $category) {
        $matchesSearch = true;
        $matchesCategory = true;

        if ($search) {
            $matchesSearch = stripos($p['name'], $search) !== false || stripos($p['description'], $search) !== false;
        }

        if ($category) {
            $matchesCategory = $p['category'] === $category;
        }

        return $matchesSearch && $matchesCategory;
    });
}
?>

<?php require_once 'includes/header.php'; ?>

<!-- Catalog Section -->
<section id="catalog" class="max-w-[1200px] mx-auto px-6 pb-20 pt-10 min-h-screen">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
        <div class="space-y-4">
            <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px]">Pilih Kategori</span>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Katalog Produk</h2>
        </div>
        
        <!-- Filter Bar: Mobile Optimized (Horizontal Scroll with snap) -->
        <div class="flex items-center gap-3 bg-white p-2 rounded-2xl border border-gray-100 shadow-sm overflow-x-auto snap-x scroll-pl-6 no-scrollbar pb-2 md:pb-2">
            <a href="catalog.php" class="snap-start shrink-0 px-6 py-4 md:py-3 rounded-xl text-xs font-black uppercase transition-all active:scale-95 <?php echo !$category ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-primary hover:bg-gray-50'; ?>">Semua</a>
            <?php
            $cats = ['Printer Kasir', 'Barcode Scanner', 'Komputer Kasir', 'Paket Usaha'];
            foreach($cats as $cat): 
            ?>
                <a href="?category=<?php echo urlencode($cat); ?>" class="snap-start shrink-0 whitespace-nowrap px-6 py-4 md:py-3 rounded-xl text-xs font-black uppercase transition-all active:scale-95 <?php echo $category === $cat ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-400 hover:text-primary hover:bg-gray-50'; ?>">
                    <?php echo $cat; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (empty($products)): ?>
        <div class="text-center py-40 bg-white rounded-[4rem] border border-gray-100 shadow-sm">
            <span class="material-symbols-outlined text-8xl text-gray-100 mb-6">inventory_2</span>
            <h3 class="text-2xl font-black text-slate-900">Wah, stok tidak ditemukan</h3>
            <a href="catalog.php" class="mt-10 px-10 py-5 bg-primary text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 transition-all shadow-xl shadow-primary/20 inline-block active:scale-95">
                Reset Filter
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            <?php foreach ($products as $product): ?>
            <div class="group bg-white rounded-3xl border border-slate-100 p-4 transition-all duration-300 hover:border-primary/20 hover:shadow-2xl hover:shadow-primary/5 hover:-translate-y-1 flex flex-col h-full active:border-primary/50">
                <!-- Image -->
                <div class="relative aspect-[4/3] rounded-2xl overflow-hidden bg-slate-50 mb-6 group/image">
                    <?php if (isset($product['images']) && count($product['images']) > 1): ?>
                        <div class="flex overflow-x-auto snap-x snap-mandatory h-full no-scrollbar scroll-smooth">
                            <?php foreach ($product['images'] as $img): ?>
                                <img 
                                    src="<?php echo $img; ?>" 
                                    alt="<?php echo $product['name']; ?>" 
                                    class="snap-center shrink-0 w-full h-full object-contain mix-blend-multiply p-4"
                                />
                            <?php endforeach; ?>
                        </div>
                        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1 opacity-0 group-hover/image:opacity-100 transition-opacity">
                            <?php foreach ($product['images'] as $i => $img): ?>
                                <div class="size-1.5 rounded-full bg-slate-300"></div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <img 
                            src="<?php echo $product['image']; ?>" 
                            alt="<?php echo $product['name']; ?>" 
                            class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-700"
                        />
                    <?php endif; ?>
                    
                    <div class="absolute top-3 left-3 flex gap-2 z-10">
                        <span class="bg-white/80 backdrop-blur px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider text-slate-700 shadow-sm">
                            <?php echo $product['category']; ?>
                        </span>
                    </div>

                    <a href="product.php?id=<?php echo $product['id']; ?>" class="absolute inset-0 z-10"></a>
                </div>

                <!-- Info -->
                <div class="flex-grow space-y-4 px-2">
                    <h3 class="font-black text-lg text-slate-900 leading-tight group-hover:text-primary transition-colors">
                        <a href="product.php?id=<?php echo $product['id']; ?>">
                            <?php echo $product['name']; ?>
                        </a>
                    </h3>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-primary font-black text-xl"><?php echo format_rupiah($product['price']); ?></span>
                        <?php if (isset($product['originalPrice'])): ?>
                            <span class="text-slate-300 line-through text-sm decoration-2"><?php echo format_rupiah($product['originalPrice']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-50 flex gap-3 relative z-20">
                    <form action="action_public.php" method="POST" class="flex-1">
                         <input type="hidden" name="action" value="add_cart">
                         <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                         <button type="submit" class="w-full bg-slate-100 hover:bg-primary hover:text-white text-slate-600 font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2 text-sm active:scale-95 active:bg-primary active:text-white">
                             <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                             Keranjang
                         </button>
                    </form>

                    <form action="action_public.php" method="POST">
                        <input type="hidden" name="action" value="add_compare">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="h-full px-5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-xl transition-all active:scale-95 flex items-center justify-center" title="Bandingkan">
                             <span class="material-symbols-outlined text-xl">compare_arrows</span>
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php require_once 'includes/footer.php'; ?>
