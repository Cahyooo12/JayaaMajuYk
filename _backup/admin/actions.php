<?php
session_start();
require_once '../functions.php';
require_admin();

$action = $_REQUEST['action'] ?? '';

if ($action === 'save' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $products = get_products();
    $id = $_POST['id'];
    
    // Parse specs
    $specs = [];
    $raw_specs = explode("\n", $_POST['specs_raw'] ?? '');
    foreach ($raw_specs as $line) {
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $specs[trim($parts[0])] = trim($parts[1]);
        }
    }

    // Parse images from Textarea
    $images = [];
    $raw_images = explode("\n", $_POST['images_raw'] ?? '');
    foreach ($raw_images as $line) {
        $url = trim($line);
        if (!empty($url)) {
            $images[] = $url;
        }
    }

    // Handle File Uploads
    if (isset($_FILES['image_upload'])) {
        $upload_dir = '../assets/uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $files = $_FILES['image_upload'];
        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $tmp_name = $files['tmp_name'][$i];
                $name = basename($files['name'][$i]);
                $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

                if (in_array($ext, $allowed)) {
                    $new_filename = uniqid('img_') . '.' . $ext;
                    $target = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($tmp_name, $target)) {
                        $images[] = 'assets/uploads/' . $new_filename;
                    }
                }
            }
        }
    }

    // Fallback image
    if (empty($images)) {
        $images[] = 'https://via.placeholder.com/300?text=No+Image';
    }

    $new_product = [
        'id' => $id ?: uniqid('prod_'),
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'price' => (int)$_POST['price'],
        'originalPrice' => !empty($_POST['originalPrice']) ? (int)$_POST['originalPrice'] : null,
        'description' => $_POST['description'],
        'image' => $images[0], // Cover image (first one)
        'images' => $images,   // All images
        'tags' => ['Manual'], 
        'isReadyStock' => true,
        'specs' => $specs
    ];

    if ($id) {
        // Update
        foreach ($products as $key => $p) {
            if ($p['id'] === $id) {
                // Preserve keys not valid in form
                $new_product['tags'] = $p['tags']; 
                $products[$key] = $new_product;
                break;
            }
        }
    } else {
        // Create
        $products[] = $new_product;
    }

    save_products($products);
    header('Location: index.php');
    exit;
}

if ($action === 'delete') {
    $id = $_GET['id'];
    $products = get_products();
    
    $products = array_filter($products, function($p) use ($id) {
        return $p['id'] !== $id;
    });

    save_products(array_values($products)); // Re-index array
    header('Location: index.php');
    exit;
}
?>
