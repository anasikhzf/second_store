<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
<div class="container my-5">
  <div class="text-center mb-4">
    <h2>Kontak Kami</h2>
    <p>Kami siap membantu Anda</p>
  </div>
  <div class="row g-4">
    <div class="col-md-6">
      <form onsubmit="sendToWhatsApp(event)">
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" placeholder="Nama Anda" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="email@contoh.com" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Pesan</label>
          <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pesan Anda" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-whatsapp"></i> Kirim ke WhatsApp</button>
      </form>
    </div>
    <div class="col-md-6">
      <div class="p-4 bg-body-tertiary rounded shadow">
        <h5>Alamat</h5>
        <p>Jl. Contoh No. 123, Kota Bekasi</p>
        <h5>Email</h5>
        <p>info@secondstore.com</p>
        <h5>Telepon</h5>
        <p>+62 812-3456-7890</p>
        <div class="mt-3">
          <a href="#" class="text-decoration-none me-3"><i class="bi bi-facebook fs-4"></i></a>
          <a href="#" class="text-decoration-none me-3"><i class="bi bi-instagram fs-4"></i></a>
          <a href="#" class="text-decoration-none"><i class="bi bi-whatsapp fs-4"></i></a>
        </div>
      </div>
    </div>
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

  function sendToWhatsApp(e){
    e.preventDefault();
    const nama = document.getElementById('nama').value;
    const email = document.getElementById('email').value;
    const pesan = document.getElementById('pesan').value;
    const nomor = '6285648857716'; // Ganti dengan nomor WA tujuan

    const text = `Halo, saya ingin menghubungi Second Store:\n\nNama: ${nama}\nEmail: ${email}\nPesan: ${pesan}`;
    const url = `https://wa.me/${nomor}?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
  }
</script>
</body>
</html>
