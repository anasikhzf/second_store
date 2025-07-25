<?php
include 'config/database.php';

// Ambil id blog
$id = intval($_GET['id'] ?? 0);
$res = mysqli_query($conn, "SELECT * FROM blog WHERE id=$id");
$blog = mysqli_fetch_assoc($res);

if(!$blog){
  header("Location: blog.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
  <div class="container my-5">
    <div class="row g-4 mt-2">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <img src="<?= htmlspecialchars(str_replace('../', '', $blog['image']) ?: 'images/default.jpg'); ?>" 
               class="card-img-top" 
               alt="<?= htmlspecialchars($blog['title']); ?>" style='height: 350px; object-fit: cover;'>
          <div class="card-body">
            <h2><?= htmlspecialchars($blog['title']); ?></h2>
            <small class="text-muted"><?= date('d M Y', strtotime($blog['created_at'] ?? $blog['id'])); ?></small>
            <p class="mt-3"><?= nl2br(htmlspecialchars($blog['content'])); ?></p>
            <a href="blog.php" class="btn btn-secondary mt-3">← Kembali ke Blog</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5>Artikel Terkait</h5>
            <ul class="list-unstyled">
              <?php
              // Ambil 5 artikel terkait
              $related_res = mysqli_query($conn, "SELECT id, title FROM blog WHERE id != $id ORDER BY id DESC LIMIT 5");
              while($related = mysqli_fetch_assoc($related_res)):
              ?>
              <li>
                <a href="blog_detail.php?id=<?= $related['id']; ?>" class="text-decoration-none">
                  <?= htmlspecialchars($related['title']); ?>
                </a>
              </li>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
