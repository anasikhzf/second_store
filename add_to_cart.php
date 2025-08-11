<?php
session_start();
include 'config/database.php';

// Ambil ID produk
$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    header("Location: product.php");
    exit;
}

// Ambil data produk dari database
$res = mysqli_query($conn, "SELECT id, name, price, image FROM product WHERE id = $id");
$product = mysqli_fetch_assoc($res);

if (!$product) {
    header("Location: product.php");
    exit;
}

// Jika session cart belum ada, buat
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Cek apakah produk sudah ada di keranjang
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $id) {
        $item['qty'] += 1;
        $found = true;
        break;
    }
}

// Kalau belum ada, tambahkan baru
if (!$found) {
    $_SESSION['cart'][] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'image' => $product['image'] ?: 'images/sample1.jpg',
        'price' => $product['price'],
        'qty' => 1
    ];
}

// Redirect balik ke halaman keranjang
header("Location: cart.php");
exit;
?>
