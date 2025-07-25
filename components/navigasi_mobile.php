<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-dark bg-dark bottom-nav d-lg-none fixed-bottom">
  <div class="container-fluid d-flex justify-content-around">
    <a class="nav-link <?=($current_page=='index.php'?'active':'');?> text-white" href="index.php"><i class="bi bi-house"></i></a>
    <a class="nav-link <?=($current_page=='product.php'?'active':'');?> text-white" href="product.php"><i class="bi bi-box-seam"></i></a>
    <a class="nav-link <?=($current_page=='blog.php'?'active':'');?> text-white" href="blog.php"><i class="bi bi-journal-text"></i></a>
    <a class="nav-link <?=($current_page=='about.php'?'active':'');?> text-white" href="about.php"><i class="bi bi-info-circle"></i></a>
    <a class="nav-link <?=($current_page=='contact.php'?'active':'');?> text-white" href="contact.php"><i class="bi bi-telephone"></i></a>
  </div>
</nav>

<style>
/* Hover & active effect for bottom nav */
.bottom-nav .nav-link.active,
.bottom-nav .nav-link:hover {
  color: #0d6efd !important;      /* Bootstrap primary */
  border-radius: .4rem;
}
</style>
