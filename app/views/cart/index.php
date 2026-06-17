<?php
require_once 'app/views/templates/header.php';
require_once 'app/views/templates/navbar.php';
$total = 0;
?>

<main class="container my-4 my-md-5">
  <div class="text-center mb-5">
    <h2 class="fw-extrabold mb-2"><i class="bi bi-cart3 text-primary me-2"></i>Keranjang Belanja</h2>
    <p class="text-secondary">Tinjau kembali barang bekas pilihan Anda sebelum checkout.</p>
  </div>

  <?php if (!empty($cart)): ?>
    <div class="row g-4">
      <!-- Cart List -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-3">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr class="text-secondary small">
                  <th class="border-0">Produk</th>
                  <th class="border-0">Harga</th>
                  <th class="border-0 text-center">Jumlah</th>
                  <th class="border-0">Total</th>
                  <th class="border-0"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cart as $item): 
                  $itemTotal = $item['price'] * $item['qty'];
                  $total += $itemTotal;
                ?>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <img src="<?= BASE_URL . htmlspecialchars(str_replace('../', '', $item['image'])); ?>" width="60" height="60" class="rounded object-fit-cover shadow-sm" style="background-color: #f1f5f9;">
                        <div>
                          <h6 class="fw-bold mb-0 text-truncate" style="max-width: 200px;"><?= htmlspecialchars($item['name']); ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?= $item['qty']; ?></td>
                    <td class="fw-bold text-primary">Rp <?= number_format($itemTotal, 0, ',', '.'); ?></td>
                    <td>
                      <a href="<?= BASE_URL; ?>cart/remove/<?= $item['id']; ?>" class="btn btn-outline-danger btn-sm rounded-circle border-0" onclick="return confirm('Hapus item ini?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Summary Card -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
          <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>
          <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Subtotal</span>
            <span class="fw-semibold">Rp <?= number_format($total, 0, ',', '.'); ?></span>
          </div>
          <div class="d-flex justify-content-between mb-4">
            <span class="text-secondary">Pengiriman (WA Checkout)</span>
            <span class="text-success small fw-semibold">Diskusikan Via WA</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between mb-4 align-items-end">
            <h6 class="fw-bold mb-0">Total Akhir</h6>
            <h4 class="text-primary fw-extrabold mb-0">Rp <?= number_format($total, 0, ',', '.'); ?></h4>
          </div>
          <a href="<?= BASE_URL; ?>cart/checkout" class="btn btn-success btn-lg w-100 rounded-pill py-3">
            <i class="bi bi-cash-stack me-2"></i>Lanjut ke Checkout
          </a>
          <a href="<?= BASE_URL; ?>product" class="btn btn-link w-100 text-decoration-none small text-center mt-3">
            <i class="bi bi-arrow-left me-1"></i>Kembali Belanja
          </a>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-4">
      <div class="py-4">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h4 class="mt-4 fw-bold">Keranjang Anda Kosong</h4>
        <p class="text-secondary small mb-4">Sepertinya Anda belum memilih barang bekas berkualitas hari ini.</p>
        <a href="<?= BASE_URL; ?>product" class="btn btn-primary rounded-pill px-5 py-3">Belanja Sekarang</a>
      </div>
    </div>
  <?php endif; ?>
</main>

<?php
require_once 'app/views/templates/footer.php';
require_once 'app/views/templates/bottom_nav.php';
?>
