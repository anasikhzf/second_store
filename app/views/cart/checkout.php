<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
$total = 0;
?>

<main class="container my-4 my-md-5">
  <div class="text-center mb-5">
    <h2 class="fw-extrabold mb-2"><i class="bi bi-wallet2 text-primary me-2"></i>Checkout Pesanan</h2>
    <p class="text-secondary">Isi data pengiriman Anda untuk menyelesaikan pesanan via WhatsApp.</p>
  </div>

  <div class="row g-4">
    <!-- Summary Column -->
    <div class="col-lg-5 order-lg-2">
      <div class="card border-0 shadow-sm rounded-4 p-4">
        <h5 class="fw-bold mb-4">Detail Pesanan</h5>
        <ul class="list-group list-group-flush mb-4">
          <?php foreach ($cart as $item): 
            $itemTotal = $item['price'] * $item['qty'];
            $total += $itemTotal;
          ?>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 bg-transparent text-reset">
              <div>
                <h6 class="fw-semibold mb-0 small"><?= htmlspecialchars($item['name']); ?> (x<?= $item['qty']; ?>)</h6>
              </div>
              <span class="fw-bold text-primary small">Rp <?= number_format($itemTotal, 0, ',', '.'); ?></span>
            </li>
          <?php endforeach; ?>
          <li class="list-group-item d-flex justify-content-between px-0 py-3 bg-transparent text-reset border-top border-2">
            <h6 class="fw-bold mb-0">Total Harga</h6>
            <h5 class="fw-extrabold text-primary mb-0">Rp <?= number_format($total, 0, ',', '.'); ?></h5>
          </li>
        </ul>
      </div>
    </div>

    <!-- Form Column -->
    <div class="col-lg-7 order-lg-1">
      <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
        <h5 class="fw-bold mb-4">Data Pengiriman & Kontak</h5>
        <form id="checkoutForm" onsubmit="sendToWhatsApp(event)">
          <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Lengkap</label>
            <input type="text" class="form-control rounded-3" id="nama" placeholder="Masukkan nama penerima..." required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Alamat Lengkap</label>
            <textarea class="form-control rounded-3" id="alamat" rows="3" placeholder="Masukkan alamat pengiriman lengkap..." required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Nomor HP / WhatsApp</label>
            <input type="tel" class="form-control rounded-3" id="nohp" placeholder="Contoh: 081234567890" required>
          </div>
          <div class="mb-4">
            <label class="form-label small fw-semibold">Catatan Tambahan (Opsional)</label>
            <textarea class="form-control rounded-3" id="catatan" rows="2" placeholder="Catatan untuk penjual..."></textarea>
          </div>
          <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill py-3">
            <i class="bi bi-whatsapp me-2"></i>Kirim Detail Pesanan ke WhatsApp
          </button>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
function sendToWhatsApp(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const alamat = document.getElementById('alamat').value;
    const nohp = document.getElementById('nohp').value;
    const catatan = document.getElementById('catatan').value;

    const cart = <?php echo json_encode($cart); ?>;

    let pesan = `*Checkout Second Store*\n\n`;
    pesan += `*Nama Penerima:* ${nama}\n`;
    pesan += `*Alamat Kirim:* ${alamat}\n`;
    pesan += `*Nomor HP:* ${nohp}\n`;
    if (catatan) pesan += `*Catatan:* ${catatan}\n`;
    
    pesan += `\n*Detail Pesanan:*\n`;
    let total = 0;
    cart.forEach(item => {
        const subtotal = item.price * item.qty;
        total += subtotal;
        pesan += `- ${item.name} (x${item.qty}) : Rp ${subtotal.toLocaleString('id-ID')}\n`;
    });
    pesan += `\n*Total Tagihan:* Rp ${total.toLocaleString('id-ID')}\n\n`;
    pesan += `Mohon segera diproses ya Kak, terima kasih!`;

    // WhatsApp Number (same as in original checkout)
    const waNumber = '6285648857716';
    const url = `https://wa.me/${waNumber}?text=${encodeURIComponent(pesan)}`;
    window.open(url, '_blank');
}
</script>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
