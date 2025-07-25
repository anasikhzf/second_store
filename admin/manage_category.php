<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include '../config/database.php';

// Tambah kategori
if (isset($_POST['add'])) {
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  mysqli_query($conn,"INSERT INTO category (name) VALUES ('$name')");
  header("Location: manage_category.php");
}

// Edit kategori
if (isset($_POST['edit'])) {
  $id = intval($_POST['id']);
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  mysqli_query($conn,"UPDATE category SET name='$name' WHERE id=$id");
  header("Location: manage_category.php");
}

// Hapus kategori
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn,"DELETE FROM category WHERE id=$id");
  header("Location: manage_category.php");
}

// Ambil data
$categories = mysqli_query($conn,"SELECT * FROM category ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<?php include 'components/head.php'; ?>
<body class="d-md-flex">
  <?php include 'components/sidebar.php'; ?>
  
  <main class="flex-fill p-4" style="min-width:0; overflow-x:hidden;">
    <h4>Manage Kategori</h4>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah</button>
    
    <div class="table-responsive"> <!-- tambahkan wrapper ini -->
      <table id="table" class="table table-striped">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Aksi</th></tr>
        </thead>
        <tbody>
          <?php while($c=mysqli_fetch_assoc($categories)): ?>
          <tr>
            <td><?= $c['id']; ?></td>
            <td><?= htmlspecialchars($c['name']); ?></td>
            <td>
              <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?=$c['id'];?>">Edit</button>
              <a href="?delete=<?=$c['id'];?>" onclick="return confirm('Hapus?')" class="btn btn-sm btn-danger">Hapus</a>
            </td>
          </tr>

          <!-- Modal Edit -->
          <div class="modal fade" id="editModal<?=$c['id'];?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="post">
                  <div class="modal-header"><h5>Edit Kategori</h5></div>
                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?=$c['id'];?>">
                    <input type="text" name="name" class="form-control" value="<?=htmlspecialchars($c['name']);?>" required>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>

<!-- Modal Add -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header"><h5>Tambah Kategori</h5></div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control" placeholder="Nama kategori" required>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add" class="btn btn-primary">Tambah</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>$(document).ready(()=>$('#table').DataTable());</script>
</body>
</html>
