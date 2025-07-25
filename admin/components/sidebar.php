<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<!-- Navbar untuk HP (d-md-none artinya hanya muncul di layar <768px) -->
<nav class="navbar navbar-dark bg-dark d-md-none">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="../images/icon_second_store.png" alt="Logo" width="30" height="30" class="me-2">
      Admin Panel
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Offcanvas menu (navigasi geser di HP) -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body p-0">
    <ul class="nav flex-column">
      <li class="nav-item mb-1">
        <a class="nav-link text-white <?=($current_page=='index.php'?'active':'');?>" href="index.php">
          <i class="bi bi-speedometer2 me-1"></i> Dashboard
        </a>
      </li>
      <li class="nav-item mb-1">
        <a class="nav-link text-white <?=($current_page=='manage_product.php'?'active':'');?>" href="manage_product.php">
          <i class="bi bi-box-seam me-1"></i> Produk
        </a>
      </li>
      <li class="nav-item mb-1">
        <a class="nav-link text-white <?=($current_page=='manage_category.php'?'active':'');?>" href="manage_category.php">
          <i class="bi bi-tags me-1"></i> Kategori
        </a>
      </li>
      <li class="nav-item mb-1">
        <a class="nav-link text-white <?=($current_page=='manage_blog.php'?'active':'');?>" href="manage_blog.php">
          <i class="bi bi-journal-text me-1"></i> Blog
        </a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link text-danger" href="logout.php">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>
      </li>
    </ul>
    <small class="text-center text-white d-block mt-3">© 2025 Second Store.</small>
  </div>
</div>

<!-- Sidebar tetap (d-none d-md-flex artinya hanya muncul di layar ≥768px) -->
<aside class="bg-dark text-white p-3 d-none d-md-flex flex-column justify-content-between" style="min-height:100vh;">
  <div>
    <div class="text-center mb-4">
      <img src="../images/icon_second_store.png" alt="Logo" width="40" height="40" class="mb-2">
      <h5 class="mb-0">Admin Panel</h5>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a class="nav-link text-white <?=($current_page=='index.php'?'active':'');?>" href="index.php">
          <i class="bi bi-speedometer2 me-1"></i> Dashboard
        </a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link text-white <?=($current_page=='manage_product.php'?'active':'');?>" href="manage_product.php">
          <i class="bi bi-box-seam me-1"></i> Produk
        </a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link text-white <?=($current_page=='manage_category.php'?'active':'');?>" href="manage_category.php">
          <i class="bi bi-tags me-1"></i> Kategori
        </a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link text-white <?=($current_page=='manage_blog.php'?'active':'');?>" href="manage_blog.php">
          <i class="bi bi-journal-text me-1"></i> Blog
        </a>
      </li>
      <li class="nav-item mt-3">
        <a class="nav-link text-danger" href="logout.php">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>
      </li>
    </ul>
  </div>
  <small class="text-center text-white mt-4">© 2025 Second Store.</small>
</aside>

<style>
.nav-link.active, .nav-link:hover {
  background-color: rgba(255, 255, 255, 0.15);
  border-radius: .4rem;
  transition: background-color 0.2s;
}
</style>
