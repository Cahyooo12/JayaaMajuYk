<?php
// functions.php

function get_products() {
    $json_data = file_get_contents(__DIR__ . '/data/products.json');
    return json_decode($json_data, true) ?: [];
}

function get_product($id) {
    $products = get_products();
    foreach ($products as $product) {
        if ($product['id'] === $id) {
            return $product;
        }
    }
    return null;
}

function format_rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function save_products($products) {
    file_put_contents(__DIR__ . '/data/products.json', json_encode($products, JSON_PRETTY_PRINT));
}

// Helper to check if admin is logged in
function is_admin_logged_in() {
    return isset($_SESSION['user']) && $_SESSION['user'] === 'admin';
}

function require_admin() {
    if (!is_admin_logged_in()) {
        header('Location: /admin/login.php');
        exit;
    }
}
?>
