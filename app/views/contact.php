<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
?>

<main class="container my-4 my-md-5">
  <div class="text-center mb-5">
    <h2 class="fw-extrabold mb-2"><i class="bi bi-chat-dots text-primary me-2"></i>Hubungi Kami</h2>
    <p class="text-secondary">Ada pertanyaan tentang produk? Kirimkan pesan langsung ke WhatsApp kami.</p>
  </div>

  <div class="row g-4">
    <!-- Form Column -->
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
        <h5 class="fw-bold mb-4">Kirim Pesan Masukan</h5>
        <form onsubmit="sendContactToWhatsApp(event)">
          <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Lengkap</label>
            <input type="text" class="form-control rounded-3" id="nama" placeholder="Masukkan nama Anda..." required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Alamat Email</label>
            <input type="email" class="form-control rounded-3" id="email" placeholder="nama@email.com" required>
          </div>
          <div class="mb-4">
            <label class="form-label small fw-semibold">Pesan Anda</label>
            <textarea class="form-control rounded-3" id="pesan" rows="4" placeholder="Tuliskan detail pertanyaan atau masukan..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3">
            <i class="bi bi-whatsapp me-2"></i>Kirim ke WhatsApp
          </button>
        </form>
      </div>
    </div>

    <!-- Info Column -->
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-dark text-white h-100 d-flex flex-column justify-content-between">
        <div>
          <h5 class="fw-bold mb-4 text-primary">Informasi Kontak</h5>
          
          <div class="d-flex align-items-start gap-3 mb-4">
            <i class="bi bi-geo-alt fs-4 text-primary"></i>
            <div>
              <h6 class="fw-bold mb-1">Alamat Showroom</h6>
              <p class="text-secondary small mb-0">Jl. Raya Universitas Muhammadiyah Lamongan, Jawa Timur</p>
            </div>
          </div>

          <div class="d-flex align-items-start gap-3 mb-4">
            <i class="bi bi-envelope fs-4 text-primary"></i>
            <div>
              <h6 class="fw-bold mb-1">Alamat Email</h6>
              <p class="text-secondary small mb-0">info@secondstore.com</p>
            </div>
          </div>

          <div class="d-flex align-items-start gap-3">
            <i class="bi bi-telephone fs-4 text-primary"></i>
            <div>
              <h6 class="fw-bold mb-1">Telepon / WhatsApp</h6>
              <p class="text-secondary small mb-0">+62 856-4885-7716</p>
            </div>
          </div>
        </div>

        <div class="mt-5 border-top border-secondary pt-4">
          <h6 class="fw-bold mb-3 small text-secondary uppercase">Media Sosial Kami</h6>
          <div class="d-flex gap-3">
            <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-2" style="width: 38px; height: 38px;"><i class="bi bi-facebook"></i></a>
            <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-2" style="width: 38px; height: 38px;"><i class="bi bi-instagram"></i></a>
            <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-2" style="width: 38px; height: 38px;"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
function sendContactToWhatsApp(e) {
    e.preventDefault();
    const nama = document.getElementById('nama').value;
    const email = document.getElementById('email').value;
    const pesan = document.getElementById('pesan').value;
    
    const waNumber = '6285648857716';
    const text = `Halo Second Store,\n\nSaya ingin berkonsultasi:\nNama: ${nama}\nEmail: ${email}\nPesan: ${pesan}`;
    const url = `https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}
</script>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
