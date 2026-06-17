<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title); ?></title>
  <link rel="icon" href="<?= BASE_URL; ?>images/PHP-logo.svg.png" type="image/png">
  
  <!-- Outfit Font -->
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- DataTables Bootstrap 5 -->
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #f8fafc;
    }
    .main-content {
      background-color: #ffffff;
      border-radius: 1.5rem;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .table img {
      border-radius: 0.5rem;
      object-fit: cover;
    }
  </style>
</head>
<body class="d-flex">

<!-- Include Sidebar -->
<?php require_once 'app/views/admin/sidebar.php'; ?>

<!-- Main Section -->
<main class="flex-fill p-4" style="min-width: 0; overflow-y: auto; height: 100vh;">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1">Kelola Produk</h3>
      <p class="text-secondary small mb-0">Tambah, ubah, dan hapus katalog produk toko</p>
    </div>
    <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
      <i class="bi bi-plus-lg me-1"></i>Tambah Produk
    </button>
  </div>

  <div class="main-content p-4 shadow-sm">
    <div class="table-responsive">
      <table id="productsTable" class="table table-hover align-middle">
        <thead>
          <tr class="table-light">
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Kondisi</th>
            <th>Status</th>
            <th>Gambar</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $p): ?>
            <tr>
              <td><?= $p['id']; ?></td>
              <td>
                <div class="fw-bold"><?= htmlspecialchars($p['name']); ?></div>
                <div class="text-secondary small text-truncate" style="max-width: 250px;"><?= htmlspecialchars($p['description']); ?></div>
              </td>
              <td><?= htmlspecialchars($p['category_name'] ?: 'Umum'); ?></td>
              <td class="fw-semibold text-primary">Rp <?= number_format($p['price'], 0, ',', '.'); ?></td>
              <td>
                <?php
                  $cond = $p['product_condition'];
                  $badgeColor = 'bg-secondary';
                  if ($cond === 'Seperti Baru') $badgeColor = 'bg-success';
                  elseif ($cond === 'Sangat Baik') $badgeColor = 'bg-primary';
                  elseif ($cond === 'Layak Pakai') $badgeColor = 'bg-warning text-dark';
                  elseif ($cond === 'Pecah/Minus') $badgeColor = 'bg-danger';
                ?>
                <span class="badge <?= $badgeColor; ?>"><?= htmlspecialchars($cond); ?></span>
              </td>
              <td>
                <?php if ($p['status'] === 'sold'): ?>
                  <span class="badge bg-dark">Terjual</span>
                <?php else: ?>
                  <span class="badge bg-success">Tersedia</span>
                <?php endif; ?>
              </td>
              <td>
                <img src="<?= BASE_URL . (htmlspecialchars(str_replace('../', '', $p['image'])) ?: 'images/sample1.jpg'); ?>" width="55" height="55" class="shadow-sm">
              </td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                  <button class="btn btn-sm btn-warning rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editModal<?= $p['id']; ?>">
                    <i class="bi bi-pencil-square me-1"></i>Edit
                  </button>
                  <form method="POST" action="<?= BASE_URL; ?>admin/products/delete" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                    <input type="hidden" name="id" value="<?= $p['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal<?= $p['id']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-4 border-0 shadow">
                  <form method="POST" action="<?= BASE_URL; ?>admin/products" enctype="multipart/form-data">
                    <div class="modal-header border-0 pb-0">
                      <h5 class="fw-bold"><i class="bi bi-pencil-square text-warning me-2"></i>Ubah Produk</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                      <input type="hidden" name="id" value="<?= $p['id']; ?>">
                      
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label small fw-semibold">Nama Produk</label>
                          <input type="text" name="name" class="form-control rounded-3" value="<?= htmlspecialchars($p['name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-semibold">Kategori</label>
                          <select name="category" class="form-select rounded-3" required>
                            <?php foreach ($categories as $c): ?>
                              <option value="<?= $c['id']; ?>" <?= ($c['id'] == $p['category_id'] ? 'selected' : ''); ?>><?= htmlspecialchars($c['name']); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-semibold">Harga</label>
                          <input type="number" name="price" class="form-control rounded-3" value="<?= $p['price']; ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-semibold">Kondisi Barang</label>
                          <select name="condition" class="form-select rounded-3" required>
                            <option value="Seperti Baru" <?= ($p['product_condition'] === 'Seperti Baru' ? 'selected' : ''); ?>>Seperti Baru</option>
                            <option value="Sangat Baik" <?= ($p['product_condition'] === 'Sangat Baik' ? 'selected' : ''); ?>>Sangat Baik</option>
                            <option value="Layak Pakai" <?= ($p['product_condition'] === 'Layak Pakai' ? 'selected' : ''); ?>>Layak Pakai</option>
                            <option value="Pecah/Minus" <?= ($p['product_condition'] === 'Pecah/Minus' ? 'selected' : ''); ?>>Pecah/Minus</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-semibold">Status Ketersediaan</label>
                          <select name="status" class="form-select rounded-3" required>
                            <option value="available" <?= ($p['status'] === 'available' ? 'selected' : ''); ?>>Tersedia (Available)</option>
                            <option value="sold" <?= ($p['status'] === 'sold' ? 'selected' : ''); ?>>Terjual (Sold)</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label small fw-semibold">Foto Produk (Kosongkan jika tidak diubah)</label>
                          <input type="file" name="image" class="form-control rounded-3">
                        </div>
                        <div class="col-12">
                          <label class="form-label small fw-semibold">Deskripsi Singkat</label>
                          <textarea name="description" class="form-control rounded-3" rows="3"><?= htmlspecialchars($p['description']); ?></textarea>
                        </div>
                        <div class="col-12">
                          <label class="form-label small fw-semibold">Catatan Minus / Kerusakan (Kosongkan jika mulus)</label>
                          <textarea name="defect" class="form-control rounded-3" rows="2" placeholder="Contoh: lecet pemakaian wajar di sisi pojok kiri bawah..."><?= htmlspecialchars($p['defect'] ?? ''); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                      <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" name="edit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 border-0 shadow">
      <form method="POST" action="<?= BASE_URL; ?>admin/products" enctype="multipart/form-data">
        <div class="modal-header border-0 pb-0">
          <h5 class="fw-bold"><i class="bi bi-plus-circle text-primary me-2"></i>Tambah Produk Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body py-4">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label small fw-semibold">Nama Produk</label>
              <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Laptop Asus Zenbook" required>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-semibold">Kategori</label>
              <select name="category" class="form-select rounded-3" required>
                <option value="">--Pilih Kategori--</option>
                <?php foreach ($categories as $c): ?>
                  <option value="<?= $c['id']; ?>"><?= htmlspecialchars($c['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-semibold">Harga</label>
              <input type="number" name="price" class="form-control rounded-3" placeholder="Masukkan nominal harga..." required>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-semibold">Kondisi Barang</label>
              <select name="condition" class="form-select rounded-3" required>
                <option value="Seperti Baru">Seperti Baru</option>
                <option value="Sangat Baik">Sangat Baik</option>
                <option value="Layak Pakai" selected>Layak Pakai</option>
                <option value="Pecah/Minus">Pecah/Minus</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-semibold">Status Ketersediaan</label>
              <select name="status" class="form-select rounded-3" required>
                <option value="available" selected>Tersedia (Available)</option>
                <option value="sold">Terjual (Sold)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-semibold">Foto Produk</label>
              <input type="file" name="image" class="form-control rounded-3" required>
            </div>
            <div class="col-12">
              <label class="form-label small fw-semibold">Deskripsi Singkat</label>
              <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Jelaskan spesifikasi detail barang..."></textarea>
            </div>
            <div class="col-12">
              <label class="form-label small fw-semibold">Catatan Minus / Kerusakan (Kosongkan jika mulus)</label>
              <textarea name="defect" class="form-control rounded-3" rows="2" placeholder="Contoh: lecet halus pemakaian wajar di bagian belakang..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="add" class="btn btn-primary rounded-pill px-4">Tambah Produk</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
      }
    });
});
</script>
</body>
</html>
