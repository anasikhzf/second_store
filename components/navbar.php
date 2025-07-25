<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Second Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?=($current_page=='index.php'?'active':'');?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=($current_page=='product.php'?'active':'');?>" href="product.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=($current_page=='blog.php'?'active':'');?>" href="blog.php">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=($current_page=='about.php'?'active':'');?>" href="about.php">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=($current_page=='contact.php'?'active':'');?>" href="contact.php">Kontak</a>
        </li>
      </ul>

      <!-- Icon cart & dark mode toggle -->
      <div class="d-flex align-items-center">
        <a href="cart.php" class="btn btn-outline-primary position-relative me-2">
          <i class="bi bi-cart"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
        </a>
        <button class="btn btn-outline-secondary" id="darkModeToggle">
          <i class="bi bi-moon-fill" id="darkModeIcon"></i>
        </button>
      </div>
    </div>
  </div>
</nav>

<style>
/* Hover & active effect */
.nav-link.active, .nav-link:hover {
  color: #0d6efd !important; /* Bootstrap primary */
  font-weight: 500;
}
</style>

<script>
// Dark mode toggle
document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('darkModeToggle');
  const icon = document.getElementById('darkModeIcon');
  let dark = false;

  toggle.addEventListener('click', () => {
    dark = !dark;
    document.body.classList.toggle('bg-dark', dark);
    document.body.classList.toggle('text-white', dark);

    if(dark){
      icon.classList.remove('bi-moon-fill');
      icon.classList.add('bi-sun-fill');
    } else {
      icon.classList.remove('bi-sun-fill');
      icon.classList.add('bi-moon-fill');
    }
  });
});
</script>
