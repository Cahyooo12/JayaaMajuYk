<?php
require_once 'functions.php';

// Safe session start done in header
// Logic to prepare cart items
if (session_status() === PHP_SESSION_NONE) session_start();

$cart_items = [];
$total_price = 0;
$whatsapp_message = "Halo Jaya Maju, saya ingin memesan:\n\n";

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $item) {
        $product = get_product($id);
        if ($product) {
            $product['qty'] = $item['qty'];
            $product['subtotal'] = $product['price'] * $item['qty'];
            $cart_items[] = $product;
            $total_price += $product['subtotal'];
            
            $whatsapp_message .= "- {$product['name']} ({$item['qty']}x) - " . format_rupiah($product['subtotal']) . "\n";
        }
    }
}

$whatsapp_message .= "\nTotal: " . format_rupiah($total_price);
$whatsapp_message .= "\n\nMohon info ketersediaan stok & ongkir.";
$wa_link = "https://wa.me/6281234567890?text=" . urlencode($whatsapp_message);
?>

<?php require_once 'includes/header.php'; ?>

<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-black text-slate-900 mb-8">Keranjang Belanja</h1>

    <?php if (empty($cart_items)): ?>
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-100">
            <span class="material-symbols-outlined text-6xl text-gray-200 mb-4">remove_shopping_cart</span>
            <h2 class="text-xl font-bold text-slate-800">Keranjang masih kosong</h2>
            <a href="/" class="mt-6 px-8 py-3 bg-primary text-white rounded-xl font-bold inline-block hover:shadow-lg transition-all">
                Mulai Belanja
            </a>
        </div>
    <?php else: ?>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Cart List -->
            <div class="md:col-span-2 space-y-4">
                <?php foreach ($cart_items as $item): ?>
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 flex gap-4 items-center shadow-sm">
                        <div class="size-20 bg-slate-50 rounded-xl p-2 shrink-0">
                            <img src="<?php echo $item['image']; ?>" class="w-full h-full object-contain">
                        </div>
                        <div class="flex-grow">
                            <h3 class="font-bold text-slate-900"><?php echo $item['name']; ?></h3>
                            <div class="text-primary font-bold text-sm"><?php echo format_rupiah($item['price']); ?></div>
                        </div>
                        
                        <!-- Qty Control -->
                        <form action="action_public.php" method="POST" class="flex items-center gap-3">
                            <input type="hidden" name="action" value="update_cart">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            
                            <div class="flex items-center border border-slate-200 rounded-lg h-9">
                                <button type="button" onclick="this.form.qty.value--; this.form.submit()" class="px-3 text-slate-500 hover:text-primary font-bold">-</button>
                                <input type="number" name="qty" value="<?php echo $item['qty']; ?>" class="w-12 text-center text-sm font-bold focus:outline-none" readonly>
                                <button type="button" onclick="this.form.qty.value++; this.form.submit()" class="px-3 text-slate-500 hover:text-primary font-bold">+</button>
                            </div>

                            <button type="submit" name="qty" value="0" class="size-9 flex items-center justify-center text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
                
                <form action="action_public.php" method="POST" class="text-right">
                    <input type="hidden" name="action" value="clear_cart">
                    <button type="submit" class="text-sm text-red-500 font-bold hover:underline">
                        Kosongkan Keranjang
                    </button>
                </form>
            </div>

            <!-- Summary -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 h-fit shadow-sm">
                <h3 class="font-bold text-lg mb-4">Ringkasan</h3>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-slate-500">Total Belanja</span>
                    <span class="font-black text-2xl text-primary"><?php echo format_rupiah($total_price); ?></span>
                </div>
                
                <a href="<?php echo $wa_link; ?>" target="_blank" class="block w-full py-4 bg-[#25D366] text-white text-center rounded-xl font-black uppercase tracking-wider shadow-lg hover:bg-opacity-90 transition-all flex items-center justify-center gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="size-5 filter brightness-0 invert">
                    Checkout WhatsApp
                </a>
                <p class="text-xs text-center text-slate-400 mt-4">Anda akan diarahkan ke WhatsApp untuk menyelesaikan pesanan.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
