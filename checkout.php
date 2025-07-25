<?php
session_start();
include 'config/database.php';

// Ambil data keranjang
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
<div class="container my-5">
  <h2 class="mb-4 text-center">Checkout</h2>

  <?php if ($cart): ?>
  <div class="mb-4">
    <h5>Detail Produk</h5>
    <ul class="list-group mb-3">
      <?php foreach($cart as $item): 
        $item_total = $item['price'] * $item['qty'];
        $total += $item_total;
      ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= htmlspecialchars($item['name']); ?> (x<?= $item['qty']; ?>)
        <span>Rp <?= number_format($item_total,0,',','.'); ?></span>
      </li>
      <?php endforeach; ?>
      <li class="list-group-item d-flex justify-content-between fw-bold">
        Total
        <span>Rp <?= number_format($total,0,',','.'); ?></span>
      </li>
    </ul>
  </div>

  <form id="checkoutForm" onsubmit="sendToWhatsApp(event)">
    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat Lengkap</label>
      <textarea class="form-control" id="alamat" rows="3" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Nomor HP</label>
      <input type="text" class="form-control" id="nohp" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Catatan Tambahan</label>
      <textarea class="form-control" id="catatan" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-success">
      <i class="bi bi-whatsapp"></i> Kirim ke WhatsApp
    </button>
  </form>
  <?php else: ?>
    <div class="alert alert-info text-center">Keranjang Anda kosong. <a href="product.php">Belanja sekarang</a></div>
  <?php endif; ?>
</div>
</main>

<?php include 'components/footer.php'; ?>
<?php include 'components/navigasi_mobile.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('darkModeToggle').addEventListener('click',()=>{document.body.classList.toggle('dark-mode');});

// Kirim ke WhatsApp
function sendToWhatsApp(e){
  e.preventDefault();

  const nama = document.getElementById('nama').value;
  const alamat = document.getElementById('alamat').value;
  const nohp = document.getElementById('nohp').value;
  const catatan = document.getElementById('catatan').value;

  // Ambil data produk dari PHP ke JS
  const products = <?php echo json_encode($cart); ?>;

  let pesan = `*Checkout Second Store*\n\n*Nama:* ${nama}\n*Alamat:* ${alamat}\n*No HP:* ${nohp}\n`;
  if(catatan) pesan += `*Catatan:* ${catatan}\n`;
  pesan += `\n*Detail Pesanan:*\n`;

  let total = 0;
  products.forEach(item=>{
    const subtotal = item.price * item.qty;
    total += subtotal;
    pesan += `- ${item.name} (x${item.qty}): Rp ${subtotal.toLocaleString('id-ID')}\n`;
  });
  pesan += `\n*Total:* Rp ${total.toLocaleString('id-ID')}`;

  const url = `https://wa.me/6285648857716?text=${encodeURIComponent(pesan)}`;
  window.open(url, '_blank');
}
</script>
</body>
</html>
