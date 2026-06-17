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
  </style>
</head>
<body class="d-flex">

<!-- Include Sidebar -->
<?php require_once 'app/views/admin/sidebar.php'; ?>

<!-- Main Section -->
<main class="flex-fill p-4" style="min-width: 0; overflow-y: auto; height: 100vh;">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h3 class="fw-bold mb-1">Kelola Kategori</h3>
      <p class="text-secondary small mb-0">Tambah, ubah, dan hapus kategori klasifikasi produk</p>
    </div>
    <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
      <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
    </button>
  </div>

  <div class="main-content p-4 shadow-sm" style="max-width: 700px;">
    <div class="table-responsive">
      <table id="categoriesTable" class="table table-hover align-middle">
        <thead>
          <tr class="table-light">
            <th>ID</th>
            <th>Nama Kategori</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categories as $c): ?>
            <tr>
              <td><?= $c['id']; ?></td>
              <td class="fw-semibold"><?= htmlspecialchars($c['name']); ?></td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                  <button class="btn btn-sm btn-warning rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editModal<?= $c['id']; ?>">
                    <i class="bi bi-pencil-square me-1"></i>Edit
                  </button>
                  <form method="POST" action="<?= BASE_URL; ?>admin/categories/delete" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                    <input type="hidden" name="id" value="<?= $c['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal<?= $c['id']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content rounded-4 border-0 shadow">
                  <form method="POST" action="<?= BASE_URL; ?>admin/categories">
                    <div class="modal-header border-0 pb-0">
                      <h5 class="fw-bold"><i class="bi bi-pencil-square text-warning me-2"></i>Ubah Kategori</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                      <input type="hidden" name="id" value="<?= $c['id']; ?>">
                      <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Kategori</label>
                        <input type="text" name="name" class="form-control rounded-3" value="<?= htmlspecialchars($c['name']); ?>" required>
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
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0 shadow">
      <form method="POST" action="<?= BASE_URL; ?>admin/categories">
        <div class="modal-header border-0 pb-0">
          <h5 class="fw-bold"><i class="bi bi-plus-circle text-primary me-2"></i>Tambah Kategori Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body py-4">
          <div class="mb-3">
            <label class="form-label small fw-semibold">Nama Kategori</label>
            <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Otomotif" required>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="add" class="btn btn-primary rounded-pill px-4">Tambah Kategori</button>
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
    $('#categoriesTable').DataTable({
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
      }
    });
});
</script>
</body>
</html>
