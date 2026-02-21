<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
$compare_count = isset($_SESSION['compare']) ? count($_SESSION['compare']) : 0;

// SEO Defaults
$page_title = $page_title ?? 'Jaya Maju Yk';
$page_desc = $page_desc ?? 'Distributor resmi mesin kasir, printer thermal, barcode scanner, dan peralatan kasir lengkap di Jogja. Garansi resmi dan layanan purna jual terbaik.';
$page_keywords = $page_keywords ?? 'mesin kasir jogja, jual mesin kasir yogyakarta, printer kasir murah jogja, paket usaha kasir jogja, distributor mesin kasir sleman, service mesin kasir jogja, barcode scanner jogja, laci kasir jogja, program kasir jogja, software toko yogyakarta, jaya maju pos, peralatan kasir lengkap, mesin kasir android jogja, komputer kasir touchscreen';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <meta name="author" content="Jaya Maju Yk">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="ID-YO" />
    <meta name="geo.placename" content="Yogyakarta" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_desc); ?>">
    <meta property="og:image" content="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?q=80&w=800&auto=format&fit=crop">
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

    <!-- JSON-LD Local Business Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Jaya Maju Yk - Mesin Kasir Jogja",
      "image": "https://images.unsplash.com/photo-1556740738-b6a63e27c4df?q=80&w=800&auto=format&fit=crop",
      "telephone": "+62 812 3456 7890",
      "email": "hello@jayamaju.id",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jalan Kaliurang KM 5",
        "addressLocality": "Sleman",
        "addressRegion": "Yogyakarta",
        "postalCode": "55281",
        "addressCountry": "ID"
      },
      "url": "http://<?php echo $_SERVER['HTTP_HOST']; ?>",
      "priceRange": "$$$",
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "09:00",
        "closes": "17:00"
      }
    }
    </script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0E3481',
                        secondary: '#00BFA6',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

<!-- Navigation -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            <div class="size-10 bg-primary rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-white">confirmation_number</span>
            </div>
            <div>
                <h1 class="font-black text-xl tracking-tighter text-slate-800 leading-none">JAYA MAJU</h1>
                <p class="text-[10px] font-bold text-secondary tracking-[0.2em] uppercase">POS Specialist</p>
            </div>
        </a>

        <div class="flex items-center gap-6">
            <div class="hidden md:flex items-center gap-8">
                <a href="catalog.php" class="text-sm font-bold text-slate-600 hover:text-primary transition-colors">Katalog</a>
                <a href="/admin/index.php" class="text-sm font-bold text-slate-600 hover:text-primary transition-colors">
                    <?php echo isset($_SESSION['user']) ? 'Admin Panel' : 'Login Admin'; ?>
                </a>
            </div>

            <!-- Icons -->
            <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                <a href="compare.php" class="relative p-2 text-slate-600 hover:text-primary transition-colors" title="Bandingkan">
                    <span class="material-symbols-outlined">compare_arrows</span>
                    <?php if ($compare_count > 0): ?>
                        <span class="absolute top-0 right-0 size-5 bg-secondary text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-sm border-2 border-white">
                            <?php echo $compare_count; ?>
                        </span>
                    <?php endif; ?>
                </a>
                
                <a href="cart.php" class="relative p-2 text-slate-600 hover:text-primary transition-colors" title="Keranjang">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <?php if ($cart_count > 0): ?>
                        <span class="absolute top-0 right-0 size-5 bg-primary text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-sm border-2 border-white">
                            <?php echo $cart_count; ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</nav>
<main class="flex-grow">
