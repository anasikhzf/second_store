<?php
$currentUrl = $_GET['url'] ?? '';
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark border-end border-secondary" style="width: 260px; min-height: 100vh;">
  <a href="<?= BASE_URL; ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <i class="bi bi-recycle text-primary fs-3 me-2"></i>
    <span class="fs-4 fw-bold">SecondStore</span>
  </a>
  <span class="text-secondary small mt-1 mb-4 ms-1">Panel Admin</span>
  <hr class="border-secondary mt-0">
  
  <ul class="nav nav-pills flex-column mb-auto gap-1">
    <li class="nav-item">
      <a href="<?= BASE_URL; ?>admin" class="nav-link text-white d-flex align-items-center gap-3 py-2.5 rounded-3 <?= ($currentUrl === 'admin' ? 'active bg-primary' : 'hover-bg'); ?>">
        <i class="bi bi-speedometer2"></i>
        Dashboard
      </a>
    </li>
    <li>
      <a href="<?= BASE_URL; ?>admin/products" class="nav-link text-white d-flex align-items-center gap-3 py-2.5 rounded-3 <?= ($currentUrl === 'admin/products' ? 'active bg-primary' : 'hover-bg'); ?>">
        <i class="bi bi-box-seam"></i>
        Produk
      </a>
    </li>
    <li>
      <a href="<?= BASE_URL; ?>admin/categories" class="nav-link text-white d-flex align-items-center gap-3 py-2.5 rounded-3 <?= ($currentUrl === 'admin/categories' ? 'active bg-primary' : 'hover-bg'); ?>">
        <i class="bi bi-tags"></i>
        Kategori
      </a>
    </li>
    <li>
      <a href="<?= BASE_URL; ?>admin/blogs" class="nav-link text-white d-flex align-items-center gap-3 py-2.5 rounded-3 <?= ($currentUrl === 'admin/blogs' ? 'active bg-primary' : 'hover-bg'); ?>">
        <i class="bi bi-journal-text"></i>
        Blog & Tips
      </a>
    </li>
  </ul>
  
  <hr class="border-secondary">
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
      <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width: 32px; height: 32px;">
        A
      </div>
      <strong><?= htmlspecialchars($_SESSION['admin'] ?? 'Admin'); ?></strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow border-secondary" aria-labelledby="dropdownUser1">
      <li><a class="dropdown-item" href="<?= BASE_URL; ?>" target="_blank"><i class="bi bi-globe me-2"></i>Kunjungi Toko</a></li>
      <li><hr class="dropdown-divider border-secondary"></li>
      <li><a class="dropdown-item text-danger" href="<?= BASE_URL; ?>admin/logout"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a></li>
    </ul>
  </div>
</div>

<style>
.hover-bg:hover {
  background-color: rgba(255, 255, 255, 0.05);
}
.nav-link i {
  font-size: 1.2rem;
}
</style>
<?php require_once 'app/views/admin/loader.php'; ?>
