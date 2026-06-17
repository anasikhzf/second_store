<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <div class="row g-4 g-lg-5">
    <!-- Image Column -->
    <div class="col-md-6">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="background-color: #f1f5f9;">
        <img src="<?= BASE_URL . htmlspecialchars(str_replace('../', '', $product['image']) ?: 'images/sample1.jpg'); ?>" 
             class="img-fluid w-100 object-fit-cover" 
             alt="<?= htmlspecialchars($product['name']); ?>"
             style="max-height: 500px;">
        
        <?php if ($product['status'] === 'sold'): ?>
          <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(2px);">
            <span class="text-white fw-bold px-4 py-2 border border-3 border-white rounded-3 shadow-lg" style="transform: rotate(-12deg); font-size: 1.75rem; letter-spacing: 3px; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">TERJUAL</span>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Details Column -->
    <div class="col-md-6 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
          <!-- Kategori -->
          <span class="badge bg-secondary-subtle text-secondary px-3 py-1 rounded-pill small">
            <?= htmlspecialchars($product['category_name'] ?: 'Tanpa Kategori'); ?>
          </span>
          
          <!-- Condition Badge -->
          <?php
            $cond = $product['product_condition'];
            $badgeColor = 'bg-secondary';
            if ($cond === 'Seperti Baru') $badgeColor = 'bg-success';
            elseif ($cond === 'Sangat Baik') $badgeColor = 'bg-primary';
            elseif ($cond === 'Layak Pakai') $badgeColor = 'bg-warning text-dark';
            elseif ($cond === 'Pecah/Minus') $badgeColor = 'bg-danger';
          ?>
          <span class="badge <?= $badgeColor; ?> px-3 py-1 rounded-pill small">
            Kondisi: <?= htmlspecialchars($cond); ?>
          </span>

          <!-- Status Badge -->
          <?php if ($product['status'] === 'sold'): ?>
            <span class="badge bg-dark px-3 py-1 rounded-pill small">Terjual</span>
          <?php else: ?>
            <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill small">Tersedia</span>
          <?php endif; ?>
        </div>

        <h2 class="fw-bold mb-3"><?= htmlspecialchars($product['name']); ?></h2>
        
        <div class="bg-body-tertiary p-3 rounded-4 mb-4">
          <p class="text-secondary small mb-1">Harga SecondStore</p>
          <h3 class="text-primary fw-extrabold mb-0">Rp <?= number_format($product['price'], 0, ',', '.'); ?></h3>
        </div>

        <!-- Description -->
        <h5 class="fw-bold mb-2">Deskripsi Produk</h5>
        <p class="text-secondary mb-4" style="line-height: 1.6; white-space: pre-line;"><?= htmlspecialchars($product['description'] ?? ''); ?></p>

        <!-- Defects Warning Box (If any) -->
        <?php if (!empty($product['defect'])): ?>
          <div class="alert alert-warning border-0 rounded-4 d-flex gap-3 mb-4">
            <i class="bi bi-exclamation-triangle-fill fs-4 text-warning"></i>
            <div>
              <h6 class="alert-heading fw-bold mb-1">Catatan Minus/Kekurangan Barang:</h6>
              <p class="mb-0 small text-dark-emphasis"><?= htmlspecialchars($product['defect']); ?></p>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-success-subtle border-0 rounded-4 d-flex gap-3 mb-4">
            <i class="bi bi-check-circle-fill fs-4 text-success"></i>
            <div>
              <h6 class="alert-heading fw-bold mb-1">Kondisi Fisik:</h6>
              <p class="mb-0 small text-success-emphasis">Mulus, tidak ada minus/cacat berarti.</p>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Actions -->
      <div class="d-flex flex-wrap gap-2 mt-4">
        <?php if ($product['status'] === 'sold'): ?>
          <button class="btn btn-secondary btn-lg flex-fill rounded-pill py-3" disabled>
            <i class="bi bi-cart-x me-2"></i>Produk Sudah Terjual
          </button>
        <?php else: ?>
          <form method="POST" action="<?= BASE_URL; ?>cart/add" class="d-flex flex-fill">
            <input type="hidden" name="id" value="<?= $product['id']; ?>">
            <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill py-3">
              <i class="bi bi-cart-plus me-2"></i>Tambah ke Keranjang
            </button>
          </form>
        <?php endif; ?>
        
        <button class="btn btn-outline-secondary btn-lg rounded-pill px-4" onclick="window.history.back()">
          Kembali
        </button>
      </div>
    </div>
  </div>

  <!-- Related Products Section -->
  <div class="mt-5 pt-4">
    <h4 class="fw-bold mb-4">Produk Lainnya</h4>
    <div class="row g-4">
      <?php foreach ($related as $p): ?>
        <div class="col-4 col-md-3">
          <div class="card h-100 shadow-sm border-0 position-relative">
            <div style="height: 160px; overflow: hidden; background-color: #f1f5f9;">
              <img src="<?= BASE_URL . htmlspecialchars(str_replace('../', '', $p['image']) ?: 'images/sample1.jpg'); ?>" class="card-img-top w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($p['name']); ?>">
            </div>
            <div class="card-body p-3 d-flex flex-column">
              <h6 class="card-title fw-bold text-truncate mb-2" title="<?= htmlspecialchars($p['name']); ?>"><?= htmlspecialchars($p['name']); ?></h6>
              <p class="text-primary fw-semibold small mb-3">Rp <?= number_format($p['price'], 0, ',', '.'); ?></p>
              <a href="<?= BASE_URL; ?>product/<?= $p['id']; ?>" class="btn btn-outline-primary btn-sm w-100 mt-auto rounded-pill py-2">Lihat</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
