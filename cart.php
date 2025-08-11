<?php
session_start();
include 'config/database.php';

// Ambil data keranjang dari session
$cart = $_SESSION['cart'] ?? [];

// Hapus item jika ada parameter remove
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    foreach ($cart as $key => $item) {
        if ($item['id'] == $id) {
            unset($cart[$key]);
            break;
        }
    }
    $_SESSION['cart'] = $cart; // Simpan kembali session
    header("Location: cart.php");
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<?php include 'components/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'components/navbar.php'; ?>
<main class="flex-fill">
<div class="container my-5">
  <h2 class="mb-4 text-center">Keranjang Belanja</h2>
  <?php if($cart): ?>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead class="table-light">
        <tr>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($cart as $item): 
          $item_total = $item['price'] * $item['qty'];
          $total += $item_total;
        ?>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="<?= htmlspecialchars($item['image']); ?>" width="60" class="rounded me-2">
              <span><?= htmlspecialchars($item['name']); ?></span>
            </div>
          </td>
          <td>Rp <?= number_format($item['price'],0,',','.'); ?></td>
          <td><?= $item['qty']; ?></td>
          <td>Rp <?= number_format($item_total,0,',','.'); ?></td>
          <td class="text-nowrap">
            <a href="checkout.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-success mb-1">
              <i class="bi bi-cash-stack"></i> Checkout
            </a>
            <a href="?remove=<?= $item['id']; ?>" onclick="return confirm('Hapus item ini?');" class="btn btn-sm btn-outline-danger">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="text-end mt-3">
    <h5 class="fw-bold">Total: Rp <?= number_format($total,0,',','.'); ?></h5>
    <a href="checkout.php" class="btn btn-success mt-2">
      <i class="bi bi-cash-stack"></i> Checkout Semua
    </a>
  </div>
  <?php else: ?>
    <div class="alert alert-info text-center">Keranjang Anda kosong.</div>
  <?php endif; ?>
</div>
</main>

<?php include 'components/footer.php'; ?>
<?php include 'components/navigasi_mobile.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('darkModeToggle').addEventListener('click',()=>{document.body.classList.toggle('dark-mode');});
</script>
</body>
</html>
