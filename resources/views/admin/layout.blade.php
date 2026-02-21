<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Jaya Maju Admin</title>
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
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.products.index') ? 'bg-primary text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }} font-bold transition-all">
                    <span class="material-symbols-outlined">inventory_2</span> Produk
                </a>
                <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.products.create') ? 'bg-primary text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }} font-bold transition-all">
                    <span class="material-symbols-outlined">add_circle</span> Tambah Produk
                </a>
                <div class="pt-8 mt-8 border-t border-slate-800">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all text-sm">
                        <span class="material-symbols-outlined">visibility</span> Lihat Toko
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                            <span class="material-symbols-outlined">logout</span> Keluar
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <div class="max-w-5xl mx-auto">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-8 flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
