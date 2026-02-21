<?php
session_start();
require_once '../functions.php';

if (is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user'] = 'admin';
        header('Location: index.php');
        exit;
    } else {
        $error = 'Username atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Jaya Maju</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { colors: { primary: '#0E3481' } }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 font-sans">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-slate-900">Admin Login</h1>
            <p class="text-slate-500 mt-2">Masuk untuk mengelola produk Jaya Maju</p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-50 text-red-500 px-4 py-3 rounded-xl mb-6 text-sm font-bold">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Username</label>
                <input type="text" name="username" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-bold text-slate-800" placeholder="admin">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-primary font-bold text-slate-800" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full py-4 bg-primary text-white rounded-xl font-black shadow-lg shadow-primary/20 hover:bg-opacity-90 transition-all active:scale-95">
                MASUK
            </button>
        </form>
        <div class="text-center mt-6">
            <a href="/" class="text-sm text-slate-400 hover:text-primary">Kembali ke Website</a>
        </div>
    </div>
</body>
</html>
