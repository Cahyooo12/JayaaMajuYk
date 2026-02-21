<?php
session_start();
require_once '../functions.php';
require_admin();

$products = get_products();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Jaya Maju Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { primary: '#0E3481', secondary: '#00BFA6' } }
            }
        }
    </script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col fixed h-full z-10">
            <div class="p-6 border-b border-slate-800">
                <h1 class="text-xl font-black tracking-tighter">ADMIN PANEL</h1>
                <p class="text-slate-500 text-xs mt-1">Jaya Maju POS</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="index.php" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary text-white font-bold">
                    <span class="material-symbols-outlined">inventory_2</span> Produk
                </a>
                <a href="form.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                    <span class="material-symbols-outlined">add_circle</span> Tambah Produk
                </a>
                <div class="pt-8 mt-8 border-t border-slate-800">
                    <a href="logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                        <span class="material-symbols-outlined">logout</span> Keluar
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Daftar Produk</h1>
                        <p class="text-slate-500 mt-2">Kelola katalog produk Jaya Maju POS</p>
                    </div>
                    <a href="form.php" class="bg-primary text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform flex items-center gap-2">
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
                            <?php foreach ($products as $product): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="size-12 rounded-lg bg-slate-100 border border-slate-200 p-1">
                                            <img src="<?php echo $product['image']; ?>" class="w-full h-full object-contain" alt="">
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-800"><?php echo $product['name']; ?></h4>
                                            <div class="flex gap-2 mt-1">
                                                <?php if(!empty($product['isReadyStock'])): ?>
                                                    <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold">Ready</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-bold">
                                        <?php echo $product['category']; ?>
                                    </span>
                                </td>
                                <td class="p-6 font-bold text-slate-900">
                                    <?php echo format_rupiah($product['price']); ?>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="form.php?id=<?php echo $product['id']; ?>" class="size-10 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:border-primary hover:text-primary transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-lg">edit</span>
                                        </a>
                                        <a href="actions.php?action=delete&id=<?php echo $product['id']; ?>" onclick="return confirm('Yakin ingin menghapus?');" class="size-10 flex items-center justify-center rounded-lg border border-slate-200 text-red-500 hover:bg-red-50 hover:border-red-200 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
