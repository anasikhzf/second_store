<?php
$currentUrl = $_GET['url'] ?? '';
$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qty'];
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light py-3 sticky-top">
  <div class="container">
    <a class="navbar-brand fw-extrabold fs-3 text-primary" href="<?= BASE_URL; ?>" style="letter-spacing: -0.5px;">
      <i class="bi bi-recycle text-accent"></i> Second<span class="text-dark-emphasis text-gradient">Store</span>
    </a>
    
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1 gap-lg-3">
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-pill fw-medium <?=($currentUrl == '' ? 'active text-primary bg-primary-subtle' : '');?>" href="<?= BASE_URL; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-pill fw-medium <?=($currentUrl == 'product' ? 'active text-primary bg-primary-subtle' : '');?>" href="<?= BASE_URL; ?>product">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-pill fw-medium <?=($currentUrl == 'blog' ? 'active text-primary bg-primary-subtle' : '');?>" href="<?= BASE_URL; ?>blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-pill fw-medium <?=($currentUrl == 'about' ? 'active text-primary bg-primary-subtle' : '');?>" href="<?= BASE_URL; ?>about">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 py-2 rounded-pill fw-medium <?=($currentUrl == 'contact' ? 'active text-primary bg-primary-subtle' : '');?>" href="<?= BASE_URL; ?>contact">Kontak</a>
        </li>
      </ul>

      <!-- Right menu: dark mode toggle and cart -->
      <div class="d-flex align-items-center gap-2">
        <a href="<?= BASE_URL; ?>cart" class="btn btn-light position-relative rounded-circle p-2 border" style="width: 42px; height: 42px;">
          <i class="bi bi-bag fs-5"></i>
          <?php if ($cartCount > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
              <?= $cartCount; ?>
            </span>
          <?php endif; ?>
        </a>
        
        <button class="btn btn-light rounded-circle p-2 border" id="darkModeToggle" style="width: 42px; height: 42px;">
          <i class="bi bi-moon-fill" id="darkModeIcon"></i>
        </button>
      </div>
    </div>
  </div>
</nav>

<style>
/* CSS adjustment for active links */
.navbar-nav .nav-link {
  transition: all 0.2s ease-in-out;
}
.navbar-nav .nav-link:hover {
  color: var(--primary-color) !important;
  background-color: rgba(79, 70, 229, 0.05);
}
body.dark-mode .navbar-nav .nav-link {
  color: var(--text-light);
}
body.dark-mode .navbar-nav .nav-link.active {
  background-color: rgba(79, 70, 229, 0.2) !important;
  color: #a5b4fc !important;
}
body.dark-mode .btn-light {
  background-color: var(--card-bg-dark);
  border-color: var(--border-dark) !important;
  color: var(--text-light);
}
body.dark-mode .btn-light:hover {
  background-color: var(--border-dark);
}
</style>
