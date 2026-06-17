<?php
$currentUrl = $_GET['url'] ?? '';
?>
<nav class="navbar navbar-dark bottom-nav d-lg-none fixed-bottom shadow-lg px-2 py-1">
  <div class="container-fluid d-flex justify-content-around align-items-center">
    <a class="nav-link text-center <?=($currentUrl == '' ? 'active text-primary' : '');?>" href="<?= BASE_URL; ?>">
      <i class="bi bi-house"></i>
      <span class="d-block" style="font-size: 0.65rem;">Home</span>
    </a>
    <a class="nav-link text-center <?=($currentUrl == 'product' ? 'active text-primary' : '');?>" href="<?= BASE_URL; ?>product">
      <i class="bi bi-shop"></i>
      <span class="d-block" style="font-size: 0.65rem;">Produk</span>
    </a>
    <a class="nav-link text-center <?=($currentUrl == 'blog' ? 'active text-primary' : '');?>" href="<?= BASE_URL; ?>blog">
      <i class="bi bi-journal-text"></i>
      <span class="d-block" style="font-size: 0.65rem;">Blog</span>
    </a>
    <a class="nav-link text-center <?=($currentUrl == 'about' ? 'active text-primary' : '');?>" href="<?= BASE_URL; ?>about">
      <i class="bi bi-info-circle"></i>
      <span class="d-block" style="font-size: 0.65rem;">Tentang</span>
    </a>
    <a class="nav-link text-center <?=($currentUrl == 'contact' ? 'active text-primary' : '');?>" href="<?= BASE_URL; ?>contact">
      <i class="bi bi-chat-dots"></i>
      <span class="d-block" style="font-size: 0.65rem;">Kontak</span>
    </a>
  </div>
</nav>

<!-- Push content up slightly on mobile so it doesn't get covered by the bottom nav -->
<style>
@media (max-width: 991.98px) {
  body {
    padding-bottom: 70px;
  }
}
</style>
