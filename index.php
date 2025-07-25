<?php
include 'config/database.php';

// Catat visitor hanya 1x per IP per hari
$ip = $_SERVER['REMOTE_ADDR'];
$today = date('Y-m-d');
$cek = mysqli_query($conn, "SELECT id FROM visitor WHERE ip='$ip' AND DATE(date)='$today'");
if (mysqli_num_rows($cek) == 0) {
  mysqli_query($conn, "INSERT INTO visitor (ip, date) VALUES ('$ip', NOW())");
}

// Ambil 5 produk terbaru
$products = mysqli_query($conn, "SELECT * FROM product ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
  <div class="container my-5">
    <div class="text-center mb-4">
      <h1>Selamat Datang di Second Store</h1>
      <p>Temukan berbagai barang bekas berkualitas tinggi dengan harga ramah di kantong. Belanja hemat, tetap bergaya!</p>
    </div>

    <div class="row g-4">
      <?php while($p = mysqli_fetch_assoc($products)): ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm">
            <img src="<?= htmlspecialchars(str_replace('../', '', $p['image']) ?: 'images/sample1.jpg'); ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']); ?>">
            <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['name']); ?></h5>
            <p class="card-text">Rp <?= number_format($p['price'],0,',','.'); ?></p>
            <a href="product.php" class="btn btn-primary">Lihat Detail</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</main>

  <?php include 'components/footer.php'; ?>
  <?php include 'components/navigasi_mobile.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // Dark mode toggle
  document.getElementById('darkModeToggle').addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
  });
  </script>
</body>
</html>
