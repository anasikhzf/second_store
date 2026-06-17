<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <div class="row g-4 g-lg-5">
    <!-- Main Content -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div style="height: 350px; overflow: hidden; background-color: #f1f5f9;">
          <img src="<?= BASE_URL . htmlspecialchars(str_replace('../', '', $blog['image']) ?: 'images/default.jpg'); ?>" 
               class="w-100 h-100 object-fit-cover" 
               alt="<?= htmlspecialchars($blog['title']); ?>">
        </div>
        <div class="card-body p-4 p-md-5">
          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill small">Artikel</span>
            <small class="text-secondary"><i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($blog['created_at'])); ?></small>
          </div>
          <h2 class="fw-bold mb-4"><?= htmlspecialchars($blog['title']); ?></h2>
          <div class="text-secondary" style="line-height: 1.8; font-size: 1.05rem; white-space: pre-line;">
            <?= htmlspecialchars($blog['content']); ?>
          </div>
          <hr class="my-4">
          <a href="<?= BASE_URL; ?>blog" class="btn btn-outline-primary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Blog
          </a>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <h5 class="fw-bold mb-3">Artikel Terkait</h5>
        <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
          <?php foreach ($related as $r): ?>
            <li class="border-bottom pb-2">
              <a href="<?= BASE_URL; ?>blog/<?= $r['id']; ?>" class="text-decoration-none text-reset hover-primary fw-medium small d-block mb-1">
                <?= htmlspecialchars($r['title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</main>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
