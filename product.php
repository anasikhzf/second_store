<?php
include 'config/database.php';

// Ambil parameter filter
$q = mysqli_real_escape_string($conn, $_GET['q'] ?? '');
$category = mysqli_real_escape_string($conn, $_GET['category'] ?? '');
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 8; // jumlah produk per halaman
$offset = ($page - 1) * $limit;

// Buat query where
$where = "WHERE 1";
if ($q) $where .= " AND p.name LIKE '%$q%'";
if ($category) $where .= " AND c.name = '$category'";

// Hitung total data (gabungkan JOIN juga biar konsisten)
$total_res = mysqli_query($conn, "
    SELECT COUNT(*) 
    FROM product p 
    LEFT JOIN category c ON p.category_id = c.id
    $where
");
$total_data = mysqli_fetch_row($total_res)[0];
$total_pages = ceil($total_data / $limit);

// Ambil data produk
$products = mysqli_query($conn, "
    SELECT p.*, c.name AS category 
    FROM product p 
    LEFT JOIN category c ON p.category_id = c.id
    $where 
    ORDER BY p.id DESC 
    LIMIT $limit OFFSET $offset
");

// Ambil semua kategori
$categories = mysqli_query($conn, "SELECT * FROM category");
?>

<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
<div class="container my-5">
  <div class="text-center mb-4">
    <h2>Semua Produk Bekas</h2>
    <p>Temukan barang bekas berkualitas dengan harga terbaik</p>
  </div>

  <!-- Search & Filter -->
  <form method="GET" class="row mb-4">
    <div class="col-md-8 mb-2">
      <div class="input-group">
        <input class="form-control" type="search" placeholder="Cari produk..." name="q" value="<?= htmlspecialchars($q) ?>">
        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <select class="form-select" name="category" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <?php while($c=mysqli_fetch_assoc($categories)): ?>
        <option value="<?= htmlspecialchars($c['name']); ?>" <?=($category==$c['name']?'selected':'')?>>
          <?= htmlspecialchars($c['name']); ?>
        </option>
        <?php endwhile; ?>
      </select>
    </div>
  </form>

  <!-- Grid Produk -->
  <div class="row g-4">
    <?php if(mysqli_num_rows($products) > 0): ?>
      <?php while($p=mysqli_fetch_assoc($products)): ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm">
          <img src="<?= htmlspecialchars(str_replace('../', '', $p['image']) ?: 'images/sample1.jpg'); ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']); ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($p['name']); ?></h5>
            <p class="text-primary fw-bold">Rp <?= number_format($p['price'],0,',','.'); ?></p>
            <a href="product_detail.php?id=<?= $p['id']; ?>" class="btn btn-outline-primary mt-auto">Lihat Detail</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <p>Tidak ada produk ditemukan.</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if($total_pages > 1): ?>
  <nav class="mt-4">
    <ul class="pagination justify-content-center">
      <li class="page-item <?=($page<=1?'disabled':'')?>">
        <a class="page-link" href="?q=<?=urlencode($q)?>&category=<?=urlencode($category)?>&page=<?=($page-1)?>">Sebelumnya</a>
      </li>
      <?php for($i=1;$i<=$total_pages;$i++): ?>
      <li class="page-item <?=($page==$i?'active':'')?>"><a class="page-link" href="?q=<?=urlencode($q)?>&category=<?=urlencode($category)?>&page=<?=$i?>"><?=$i?></a></li>
      <?php endfor; ?>
      <li class="page-item <?=($page>=$total_pages?'disabled':'')?>">
        <a class="page-link" href="?q=<?=urlencode($q)?>&category=<?=urlencode($category)?>&page=<?=($page+1)?>">Berikutnya</a>
      </li>
    </ul>
  </nav>
  <?php endif; ?>
</div>
</main>

<?php include 'components/footer.php'; ?>
<?php include 'components/navigasi_mobile.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('darkModeToggle').addEventListener('click', function() {
  document.body.classList.toggle('dark-mode');
});
</script>
</body>
</html>
