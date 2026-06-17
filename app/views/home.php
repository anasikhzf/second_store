<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <!-- Hero Section -->
  <div class="hero-section text-center text-md-start p-4 p-md-5 shadow-sm mb-5">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill fw-semibold">Pecinta Lingkungan & Hemat</span>
        <h1 class="display-4 fw-extrabold mb-3" style="letter-spacing: -1px; line-height: 1.1;">
          Temukan Nilai Lebih di <span class="text-primary">Barang Bekas</span> Terbaik
        </h1>
        <p class="lead text-secondary mb-4">Belanja hemat, tetap bergaya! Produk kurasi berkualitas tinggi, dicek langsung oleh tim profesional kami.</p>
        <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
          <a href="<?= BASE_URL; ?>product" class="btn btn-primary btn-lg shadow-sm px-4"><i class="bi bi-bag-check me-2"></i>Mulai Belanja</a>
          <a href="<?= BASE_URL; ?>about" class="btn btn-outline-secondary btn-lg px-4">Tentang Kami</a>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
        <img src="<?= BASE_URL; ?>images/PHP-logo.svg.png" alt="Second Store" class="img-fluid floating-animation" style="max-height: 350px; object-fit: contain;">
      </div>
    </div>
  </div>

  <!-- Keunggulan Section -->
  <div class="row g-4 mb-5 text-center">
    <div class="col-md-4">
      <div class="card h-100 p-4 shadow-sm border-0">
        <div class="rounded-circle bg-primary-subtle text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
          <i class="bi bi-shield-check fs-3"></i>
        </div>
        <h5 class="fw-bold">Teruji & Terkurasi</h5>
        <p class="text-secondary small mb-0">Semua produk diperiksa kondisinya dan didokumentasikan sejujurnya dengan detail minus.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-4 shadow-sm border-0">
        <div class="rounded-circle bg-success-subtle text-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
          <i class="bi bi-tag fs-3"></i>
        </div>
        <h5 class="fw-bold">Harga Ramah Kantong</h5>
        <p class="text-secondary small mb-0">Dapatkan barang bermerek berkualitas tinggi dengan potongan harga hingga 70% dari harga baru.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 p-4 shadow-sm border-0">
        <div class="rounded-circle bg-warning-subtle text-warning mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
          <i class="bi bi-globe-americas fs-3"></i>
        </div>
        <h5 class="fw-bold">Eco-Friendly Shopping</h5>
        <p class="text-secondary small mb-0">Dengan membeli barang secondhand, Anda ikut mengurangi sampah elektronik dan tekstil bumi.</p>
      </div>
    </div>
  </div>

  <!-- Produk Terbaru Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-extrabold mb-1"><i class="bi bi-sparkles text-accent"></i> Produk Terbaru</h3>
      <p class="text-secondary small mb-0">Jangan sampai kelewatan! Stok unik, masing-masing hanya tersedia 1 unit.</p>
    </div>
    <a href="<?= BASE_URL; ?>product" class="btn btn-outline-primary rounded-pill btn-sm px-3">Lihat Semua</a>
  </div>

  <div class="row g-4">
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
  </div>
</main>

<style>
@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
  100% { transform: translateY(0px); }
}
.floating-animation {
  animation: float 4s ease-in-out infinite;
}
.text-gradient {
  background: linear-gradient(to right, var(--primary-color), var(--accent-color));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
