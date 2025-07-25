<?php
include 'config/database.php';

// Konfigurasi pagination
$limit = 4; // jumlah blog per halaman
$page = intval($_GET['page'] ?? 1);
$offset = ($page - 1) * $limit;

// Ambil total data untuk hitung jumlah halaman
$total_res = mysqli_query($conn, "SELECT COUNT(*) as total FROM blog");
$total_row = mysqli_fetch_assoc($total_res);
$total_blog = $total_row['total'];
$total_pages = ceil($total_blog / $limit);

// Ambil data blog sesuai halaman
$blogs = mysqli_query($conn, "SELECT * FROM blog ORDER BY id DESC LIMIT $limit OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
  <div class="container my-5">
    <div class="text-center mb-4">
      <h2>Blog & Artikel</h2>
      <p>Informasi, tips, dan cerita menarik seputar barang bekas</p>
    </div>
    <div class="row g-4">
      <?php while($blog = mysqli_fetch_assoc($blogs)): ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
          <img src="<?= htmlspecialchars(str_replace('../', '', $blog['image']) ?: 'images/default.jpg'); ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']); ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($blog['title']); ?></h5>
            <small class="text-muted"><?= date('d M Y', strtotime($blog['created_at'] ?? $blog['id'])); ?></small>
            <p class="card-text mt-2"><?= htmlspecialchars(mb_substr(strip_tags($blog['content']),0,100)); ?>...</p>
            <a href="blog_detail.php?id=<?= $blog['id']; ?>" class="btn btn-outline-primary">Baca Selengkapnya</a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
      <ul class="pagination justify-content-center">
        <?php if($page > 1): ?>
          <li class="page-item"><a class="page-link" href="?page=<?= $page-1; ?>">Sebelumnya</a></li>
        <?php else: ?>
          <li class="page-item disabled"><a class="page-link">Sebelumnya</a></li>
        <?php endif; ?>

        <?php for($i=1;$i<=$total_pages;$i++): ?>
          <li class="page-item <?=($i==$page?'active':'');?>"><a class="page-link" href="?page=<?=$i;?>"><?=$i;?></a></li>
        <?php endfor; ?>

        <?php if($page < $total_pages): ?>
          <li class="page-item"><a class="page-link" href="?page=<?= $page+1; ?>">Berikutnya</a></li>
        <?php else: ?>
          <li class="page-item disabled"><a class="page-link">Berikutnya</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</main>

<?php include 'components/footer.php'; ?>
<?php include 'components/navigasi_mobile.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('darkModeToggle').addEventListener('click',()=>{document.body.classList.toggle('dark-mode');});
</script>
</body>
</html>
