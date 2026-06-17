<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <div class="text-center mb-5">
    <h2 class="fw-extrabold mb-2"><i class="bi bi-journal-text text-primary me-2"></i>Blog & Tips</h2>
    <p class="text-secondary">Informasi, tips perawatan, dan rekomendasi seputar barang bekas berkualitas.</p>
  </div>

  <div class="row g-4">
    <?php if (!empty($blogs)): ?>
      <?php foreach ($blogs as $b): ?>
        <div class="col-4 col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm border-0 d-flex flex-column justify-content-between">
            <div style="height: 180px; overflow: hidden; background-color: #f1f5f9;">
              <img src="<?= BASE_URL . htmlspecialchars(str_replace('../', '', $b['image']) ?: 'images/default.jpg'); ?>" 
                   class="card-img-top w-100 h-100 object-fit-cover" 
                   alt="<?= htmlspecialchars($b['title']); ?>">
            </div>
            <div class="card-body p-3 d-flex flex-column">
              <small class="text-muted mb-2"><i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($b['created_at'])); ?></small>
              <h5 class="card-title fw-bold text-truncate-2 mb-2" style="height: 3rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                <?= htmlspecialchars($b['title']); ?>
              </h5>
              <p class="card-text text-secondary small mb-3"><?= htmlspecialchars(mb_substr(strip_tags($b['content']), 0, 80)); ?>...</p>
              <a href="<?= BASE_URL; ?>blog/<?= $b['id']; ?>" class="btn btn-outline-primary btn-sm w-100 mt-auto rounded-pill py-2">
                Baca Selengkapnya
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-journal-x fs-1 text-muted"></i>
        <h5 class="mt-3">Belum ada artikel dipublikasikan</h5>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
    <nav class="mt-5">
      <ul class="pagination justify-content-center">
        <li class="page-item <?=($page <= 1 ? 'disabled' : '');?>">
          <a class="page-link rounded-start-pill px-3" href="?page=<?=($page-1);?>">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?=($page == $i ? 'active' : '');?>">
            <a class="page-link px-3" href="?page=<?=$i;?>"><?=$i;?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?=($page >= $totalPages ? 'disabled' : '');?>">
          <a class="page-link rounded-end-pill px-3" href="?page=<?=($page+1);?>">Berikutnya</a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
</main>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
