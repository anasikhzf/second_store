<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <div class="text-center mb-5">
    <h2 class="fw-extrabold mb-2"><i class="bi bi-info-circle text-primary me-2"></i>Tentang Second Store</h2>
    <p class="text-secondary">Kisah kami dalam menghadirkan barang bekas berkualitas tinggi untuk semua kalangan.</p>
  </div>

  <div class="row g-4 align-items-center mb-5">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-light p-3">
        <img src="<?= BASE_URL; ?>images/PHP-logo.svg.png" alt="Tentang Kami" class="img-fluid rounded-3 mx-auto d-block" style="max-height: 300px; object-fit: contain;">
      </div>
    </div>
    <div class="col-md-6">
      <div class="p-3">
        <h4 class="fw-bold text-primary mb-3">Siapa Kami?</h4>
        <p class="text-secondary" style="line-height: 1.7;">Second Store didirikan dengan misi sederhana: memberikan kesempatan kedua bagi barang-barang bekas berkualitas. Kami mengurasi produk elektronik, pakaian, furniture, hingga buku layak pakai agar tetap bernilai guna.</p>
        <p class="text-secondary" style="line-height: 1.7;">Setiap item yang terdaftar telah melalui proses pemeriksaan fisik dan fungsi yang ketat, sehingga Anda bisa berbelanja dengan rasa tenang tanpa takut tertipu kondisi barang.</p>
        
        <h4 class="fw-bold text-primary mt-4 mb-3">Visi & Misi</h4>
        <p class="text-secondary" style="line-height: 1.7;">Kami berkomitmen mendorong ekonomi sirkular (reuse/recycle) untuk mengurangi pembuangan limbah konsumsi, sekaligus menghadirkan alternatif belanja ekonomis, aman, dan profesional bagi masyarakat Indonesia.</p>
      </div>
    </div>
  </div>

  <!-- Lokasi Google Maps -->
  <div class="card border-0 shadow-sm rounded-4 p-4 mb-5">
    <h4 class="fw-bold mb-4 text-center"><i class="bi bi-map text-primary me-2"></i>Lokasi Showroom Kami</h4>
    <div class="ratio ratio-21x9 rounded-4 overflow-hidden border">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0124969912304!2d112.3895521!3d-7.1059893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f0dc6026bc95%3A0x4f1b2c506505b49e!2sUniversitas%20Muhammadiyah%20Lamongan!5e0!3m2!1sid!2sid!4v1690800000000!5m2!1sid!2sid" 
        style="border:0;" allowfullscreen="" loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</main>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
