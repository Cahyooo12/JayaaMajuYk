<?php
session_start();
require_once '../functions.php';
require_admin();

$id = $_GET['id'] ?? null;
$product = [
    'id' => '',
    'name' => '',
    'category' => 'Printer Kasir',
    'price' => 0,
    'originalPrice' => 0,
    'description' => '',
    'image' => '',
    'tags' => [],
    'specs' => [],
    'isReadyStock' => true
];

if ($id) {
    $existing = get_product($id);
    if ($existing) {
        $product = array_merge($product, $existing);
    }
}
?>
<?php
// Prepare images string for textarea
$images_str = isset($product['images']) ? implode("\n", $product['images']) : ($product['image'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Edit' : 'Tambah'; ?> Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { primary: '#0E3481' } }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen py-10 px-6 font-sans">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-2xl font-black text-slate-800 mb-6">
                <?php echo $id ? 'Edit Produk' : 'Tambah Produk Baru'; ?>
            </h2>

            <form action="actions.php" method="POST" class="space-y-6" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Produk</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium">
                            <?php 
                            $cats = ['Printer Kasir', 'Barcode Scanner', 'Komputer Kasir', 'Paket Usaha'];
                            foreach($cats as $cat): ?>
                                <option value="<?php echo $cat; ?>" <?php echo $product['category'] === $cat ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga (IDR)</label>
                        <input type="number" name="price" value="<?php echo $product['price']; ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga Coret (Opsional)</label>
                        <input type="number" name="originalPrice" value="<?php echo $product['originalPrice']; ?>" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">URL Gambar (Satu per baris)</label>
                    <textarea name="images_raw" rows="3" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-primary font-mono text-sm" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg"><?php echo htmlspecialchars($images_str); ?></textarea>
                    
                    <div class="mt-4 p-4 border border-dashed border-slate-300 rounded-xl bg-slate-50">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Atau Upload Gambar Baru</label>
                        <input type="file" name="image_upload[]" multiple accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-xs text-slate-400 mt-1">Bisa pilih banyak foto sekaligus (JPG, PNG, WebP). Foto akan otomatis ditambahkan ke daftar.</p>
                    </div>

                    <p class="text-xs text-slate-400 mt-2">Gambar pertama di daftar URL akan menjadi cover utama.</p>
                </div>
                
                <!-- Simple Specs (JSON field workaround for simplicity) -->
                <div>
                     <label class="block text-sm font-bold text-slate-700 mb-2">Spesifikasi (Format: Key=Value, pisahkan dengan baris baru)</label>
                     <textarea name="specs_raw" rows="5" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-medium font-mono text-sm"><?php 
                        $lines = [];
                        if (is_array($product['specs'])) {
                            foreach($product['specs'] as $k => $v) {
                                $lines[] = "$k=$v";
                            }
                        }
                        echo implode("\n", $lines);
                     ?></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="index.php" class="px-8 py-4 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</a>
                    <button type="submit" class="flex-1 px-8 py-4 rounded-xl font-bold text-white bg-primary hover:bg-opacity-90 shadow-lg shadow-primary/20 transition-all active:scale-95">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
