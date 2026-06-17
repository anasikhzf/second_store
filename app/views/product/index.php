<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <div class="text-center mb-5">
    <h2 class="fw-extrabold mb-2"><i class="bi bi-shop text-primary me-2"></i>Semua Produk Bekas</h2>
    <p class="text-secondary">Temukan ribuan barang layak pakai terkurasi dengan harga terbaik.</p>
  </div>

  <!-- Search & Filter Form -->
  <form method="GET" action="<?= BASE_URL; ?>product" class="row g-3 mb-5 p-3 rounded-4 bg-body-tertiary border shadow-sm">
    <div class="col-md-7">
      <label class="form-label small fw-semibold">Cari Barang</label>
      <div class="input-group">
        <input class="form-control rounded-start-pill border-end-0 py-2 ps-3" type="search" placeholder="Cari nama produk..." name="q" value="<?= htmlspecialchars($search); ?>">
        <button class="btn btn-primary rounded-end-pill px-4" type="submit"><i class="bi bi-search"></i></button>
      </div>
    </div>
    <div class="col-md-5">
      <label class="form-label small fw-semibold">Kategori</label>
      <select class="form-select rounded-pill py-2 ps-3" name="category" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= htmlspecialchars($c['name']); ?>" <?=($currentCategory === $c['name'] ? 'selected' : '');?>>
            <?= htmlspecialchars($c['name']); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  </form>

  <!-- Products Grid -->
  <div class="row g-4">
    <?php if (!empty($products)): ?>
      <?php foreach ($products as $p): ?>
        <div class="col-4 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm border-0 position-relative">
            <!-- Condition Badge -->
            <?php
              $cond = $p['product_condition'];
              $badgeColor = 'bg-secondary';
              if ($cond === 'Seperti Baru') $badgeColor = 'bg-success';
              elseif ($cond === 'Sangat Baik') $badgeColor = 'bg-primary';
              elseif ($cond === 'Layak Pakai') $badgeColor = 'bg-warning text-dark';
              elseif ($cond === 'Pecah/Minus') $badgeColor = 'bg-danger';
            ?>
            <span class="badge badge-condition <?= $badgeColor; ?> position-absolute top-0 start-0 m-3 z-1 shadow-sm">
              <?= htmlspecialchars($cond); ?>
            </span>

            <?php if ($p['status'] === 'sold'): ?>
              <span class="badge bg-dark position-absolute top-0 end-0 m-3 z-1 shadow-sm px-3 py-1">
                Terjual
              </span>
            <?php endif; ?>

            <div class="position-relative" style="height: 200px; overflow: hidden; background-color: #f1f5f9;">
              <img src="<?= BASE_URL . htmlspecialchars(str_replace('../', '', $p['image']) ?: 'images/sample1.jpg'); ?>" 
                   class="card-img-top w-100 h-100 object-fit-cover" 
                   alt="<?= htmlspecialchars($p['name']); ?>"
                   style="transition: transform 0.5s;"
                   onmouseover="this.style.transform='scale(1.08)'"
                   onmouseout="this.style.transform='scale(1)'">
              
              <?php if ($p['status'] === 'sold'): ?>
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(2px);">
                  <span class="text-white fw-bold px-3 py-1 border border-2 border-white rounded-3 shadow-lg" style="transform: rotate(-12deg); font-size: 1.15rem; letter-spacing: 2px; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">TERJUAL</span>
                </div>
              <?php endif; ?>
            </div>
            <div class="card-body d-flex flex-column p-3">
              <span class="text-muted small mb-1"><?= htmlspecialchars($p['category_name'] ?? 'Umum'); ?></span>
              <h6 class="card-title fw-bold text-truncate mb-2" title="<?= htmlspecialchars($p['name']); ?>">
                <?= htmlspecialchars($p['name']); ?>
              </h6>
              <p class="fw-bold text-primary mb-3">Rp <?= number_format($p['price'], 0, ',', '.'); ?></p>
              <a href="<?= BASE_URL; ?>product/<?= $p['id']; ?>" class="btn btn-outline-primary w-100 mt-auto rounded-pill py-2">
                <i class="bi bi-eye me-1"></i> Lihat Detail
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-emoji-frown fs-1 text-muted"></i>
        <h5 class="mt-3">Tidak ada produk ditemukan</h5>
        <p class="text-secondary small">Coba cari dengan kata kunci lain atau pilih kategori berbeda.</p>
        <a href="<?= BASE_URL; ?>product" class="btn btn-primary btn-sm rounded-pill px-4 mt-2">Reset Pencarian</a>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
    <nav class="mt-5">
      <ul class="pagination justify-content-center">
        <li class="page-item <?=($page <= 1 ? 'disabled' : '');?>">
          <a class="page-link rounded-start-pill px-3" href="?q=<?=urlencode($search);?>&category=<?=urlencode($currentCategory);?>&page=<?=($page-1);?>">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?=($page == $i ? 'active' : '');?>">
            <a class="page-link px-3" href="?q=<?=urlencode($search);?>&category=<?=urlencode($currentCategory);?>&page=<?=$i;?>"><?=$i;?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?=($page >= $totalPages ? 'disabled' : '');?>">
          <a class="page-link rounded-end-pill px-3" href="?q=<?=urlencode($search);?>&category=<?=urlencode($currentCategory);?>&page=<?=($page+1);?>">Berikutnya</a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
</main>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
