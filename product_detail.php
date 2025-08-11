<?php
include 'config/database.php';

// Ambil id produk dari URL
$id = intval($_GET['id'] ?? 0);

// Ambil detail produk
$product_res = mysqli_query($conn, "SELECT p.*, c.name as category FROM product p 
  LEFT JOIN category c ON p.category_id = c.id WHERE p.id = $id");
$product = mysqli_fetch_assoc($product_res);

if(!$product){
  // Redirect jika produk tidak ditemukan
  header("Location: product.php");
  exit;
}

// Ambil 4 produk terbaru sebagai produk terkait (kecuali produk ini)
$related_res = mysqli_query($conn, "SELECT id, name, image, price FROM product 
  WHERE id != $id ORDER BY id DESC LIMIT 4");
?>
<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
<div class="container my-5">
  <div class="row g-4">
    <div class="col-md-6">
    <img src="<?= htmlspecialchars(str_replace('../', '', $product['image']) ?: 'images/sample1.jpg'); ?>" 
     class="img-fluid rounded shadow" 
     alt="<?= htmlspecialchars($product['name']); ?>" 
     >

  </div>
    <div class="col-md-6">
      <h3><?= htmlspecialchars($product['name']); ?></h3>
      <p class="text-primary fw-bold fs-4">Rp <?= number_format($product['price'],0,',','.'); ?></p>
      <p>Kategori: <?= htmlspecialchars($product['category'] ?: 'Tidak ada'); ?></p>
      <p><?= nl2br(htmlspecialchars($product['description'] ?? '')); ?></p>
      <form method="POST" action="add_to_cart.php" class="mt-3">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
        </button>
      </form>
      <button class="btn btn-outline-primary mt-2" onclick="window.history.back()">
        <i class="bi bi-arrow-left"></i> Kembali
      </button>
    </div>
  </div>

  <div class="mt-5">
    <h4>Produk Terkait</h4>
    <div class="row g-4 mt-2">
      <?php while($p=mysqli_fetch_assoc($related_res)): ?>
      <div class="col-6 col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="<?= htmlspecialchars(str_replace('../', '', $p['image']) ?: 'images/sample1.jpg'); ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']); ?>">
          <div class="card-body text-center">
            <h6 class="card-title"><?= htmlspecialchars($p['name']); ?></h6>
            <p class="text-primary fw-bold">Rp <?= number_format($p['price'],0,',','.'); ?></p>
            <a href="product_detail.php?id=<?= $p['id']; ?>" class="btn btn-outline-primary btn-sm">Lihat</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
</main>

<?php include 'components/footer.php'; ?>
<?php include 'components/navigasi_mobile.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('darkModeToggle').addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
});
</script>
</body>
</html>
