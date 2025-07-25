<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
<div class="container my-5">
  <div class="text-center mb-4">
    <h2>Tentang Second Store</h2>
    <p>Kisah kami dalam menghadirkan barang bekas berkualitas untuk semua orang</p>
  </div>
  <div class="row g-4">
    <div class="col-md-6">
      <img src="images/icon_second_store.png" alt="Tentang Kami" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-6 d-flex align-items-center">
      <div>
        <h4>Siapa Kami?</h4>
        <p>Second Store didirikan dengan tujuan memberikan kesempatan kedua bagi berbagai jenis barang bekas yang masih layak pakai. Dari elektronik, gadget, hingga fashion dan aksesoris, kami berkomitmen menyediakan produk yang tetap berkualitas namun dengan harga yang lebih terjangkau.</p>
        <p>Dengan pengalaman dan keahlian dalam memilih serta mengecek kondisi produk, kami ingin memastikan setiap pelanggan dapat berbelanja barang bekas tanpa rasa khawatir, layaknya membeli produk baru.</p>
        
        <h4>Visi & Misi</h4>
        <p>Visi kami adalah menciptakan budaya konsumsi yang lebih bijak dan ramah lingkungan dengan mengedepankan pemanfaatan kembali barang bekas berkualitas. Misi kami adalah memberikan layanan terbaik, harga terjangkau, dan memastikan kepuasan pelanggan melalui produk-produk pilihan yang kami sediakan.</p>
        
        <p>Kami percaya bahwa barang bekas bukan berarti murahan – setiap produk memiliki cerita dan nilai, dan bersama Second Store, kami ingin membagikan cerita tersebut kepada Anda.</p>
      </div>
    </div>
  </div>
</div>

<div class="container mb-5">
  <h4 class="mb-3 text-center">Lokasi Kami</h4>
  <div class="ratio ratio-16x9 shadow">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0124969912304!2d112.3895521!3d-7.1059893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f0dc6026bc95%3A0x4f1b2c506505b49e!2sUniversitas%20Muhammadiyah%20Lamongan!5e0!3m2!1sid!2sid!4v1690800000000!5m2!1sid!2sid" 
      width="600" height="150" style="border:0;" allowfullscreen="" loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>
</main>

<?php include 'components/footer.php'; ?>
<?php include 'components/navigasi_mobile.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('darkModeToggle').addEventListener('click',()=>{
    document.body.classList.toggle('dark-mode');
  });
</script>
</body>
</html>
