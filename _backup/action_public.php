<?php
session_start();
require_once 'functions.php';

$action = $_REQUEST['action'] ?? '';
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';

// Initialize sessions if not exist
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['compare'])) $_SESSION['compare'] = [];

// --- CART ACTIONS ---
if ($action === 'add_cart') {
    $id = $_POST['id'];
    $qty = (int)($_POST['qty'] ?? 1);
    
    // Check if product exists
    $product = get_product($id);
    if ($product) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'qty' => $qty
            ];
        }
    }
}

if ($action === 'update_cart') {
    $id = $_POST['id'];
    $qty = (int)$_POST['qty'];
    
    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } elseif (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] = $qty;
    }
}

if ($action === 'remove_cart') {
    $id = $_POST['id'];
    unset($_SESSION['cart'][$id]);
}

if ($action === 'clear_cart') {
    $_SESSION['cart'] = [];
}

// --- COMPARE ACTIONS ---
if ($action === 'add_compare') {
    $id = $_POST['id'];
    if (!in_array($id, $_SESSION['compare'])) {
        if (count($_SESSION['compare']) < 4) {
            $_SESSION['compare'][] = $id;
        }
    }
}

if ($action === 'remove_compare') {
    $id = $_POST['id'];
    $_SESSION['compare'] = array_diff($_SESSION['compare'], [$id]);
}

if ($action === 'clear_compare') {
    $_SESSION['compare'] = [];
}

header('Location: ' . $redirect);
exit;
?>
