<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include '../config/database.php';

// Tambah produk
if (isset($_POST['add'])) {
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $category_id = intval($_POST['category']);
  $price = intval($_POST['price']);
  mysqli_query($conn,"INSERT INTO product (name,category_id,price) VALUES ('$name',$category_id,$price)");
  $last_id = mysqli_insert_id($conn);
  // upload
  if ($_FILES['image']['tmp_name']) {
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/product/product_$last_id.jpg");
    mysqli_query($conn,"UPDATE product SET image='../images/product/product_$last_id.jpg' WHERE id=$last_id");
  }
  header("Location: manage_product.php");
}

// Edit produk
if (isset($_POST['edit'])) {
  $id = intval($_POST['id']);
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $category_id = intval($_POST['category']);
  $price = intval($_POST['price']);
  mysqli_query($conn,"UPDATE product SET name='$name', category_id=$category_id, price=$price WHERE id=$id");
  if ($_FILES['image']['tmp_name']) {
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/product/product_$id.jpg");
    mysqli_query($conn,"UPDATE product SET image='../images/product/product_$id.jpg' WHERE id=$id");
  }
  header("Location: manage_product.php");
}

// Hapus
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn,"DELETE FROM product WHERE id=$id");
  @unlink("../images/product/product_$id.jpg");
  header("Location: manage_product.php");
}

$products = mysqli_query($conn,"SELECT p.*, c.name as category FROM product p LEFT JOIN category c ON p.category_id=c.id ORDER BY p.id DESC");
$categories = mysqli_query($conn,"SELECT * FROM category");
?>
<!DOCTYPE html>
<html>
<?php include 'components/head.php'; ?>
<body class="d-md-flex">
<?php include 'components/sidebar.php'; ?>

<main class="flex-fill p-4" style="min-width:0; overflow-x:hidden;">
  <h4>Manage Produk</h4>
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah</button>

  <div class="table-responsive"> <!-- Tambahkan wrapper agar tabel responsif -->
    <table id="table" class="table table-striped">
      <thead>
        <tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>
      </thead>
      <tbody>
        <?php while($p=mysqli_fetch_assoc($products)): ?>
        <tr>
          <td><?=$p['id'];?></td>
          <td><?=htmlspecialchars($p['name']);?></td>
          <td><?=htmlspecialchars($p['category']);?></td>
          <td>Rp <?=number_format($p['price'],0,',','.');?></td>
          <td><?php if($p['image']): ?><img src="<?=$p['image'];?>" width="50"><?php endif; ?></td>
          <td>
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?=$p['id'];?>">Edit</button>
            <a href="?delete=<?=$p['id'];?>" onclick="return confirm('Hapus?')" class="btn btn-sm btn-danger">Hapus</a>
          </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal<?=$p['id'];?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post" enctype="multipart/form-data">
                <div class="modal-header"><h5>Edit Produk</h5></div>
                <div class="modal-body">
                  <input type="hidden" name="id" value="<?=$p['id'];?>">
                  <input type="text" name="name" class="form-control mb-2" value="<?=htmlspecialchars($p['name']);?>" required>
                  <select name="category" class="form-select mb-2" required>
                    <?php mysqli_data_seek($categories,0); while($c=mysqli_fetch_assoc($categories)): ?>
                      <option value="<?=$c['id'];?>" <?=($c['id']==$p['category_id']?'selected':'')?>><?=htmlspecialchars($c['name']);?></option>
                    <?php endwhile; ?>
                  </select>
                  <input type="number" name="price" class="form-control mb-2" value="<?=$p['price'];?>" required>
                  <input type="file" name="image" class="form-control">
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
  </div> <!-- Tutup .table-responsive -->
</main>

<!-- Modal Add -->
<div class="modal fade" id="addModal">
<div class="modal-dialog"><div class="modal-content">
<form method="post" enctype="multipart/form-data">
<div class="modal-header"><h5>Tambah Produk</h5></div>
<div class="modal-body">
<input type="text" name="name" class="form-control mb-2" placeholder="Nama produk" required>
<select name="category" class="form-select mb-2" required>
<option value="">--Kategori--</option>
<?php mysqli_data_seek($categories,0); while($c=mysqli_fetch_assoc($categories)): ?>
<option value="<?=$c['id'];?>"><?=htmlspecialchars($c['name']);?></option>
<?php endwhile; ?>
</select>
<input type="number" name="price" class="form-control mb-2" placeholder="Harga" required>
<input type="file" name="image" class="form-control" required>
</div>
<div class="modal-footer">
<button type="submit" name="add" class="btn btn-primary">Tambah</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>
</form></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>$(document).ready(()=>$('#table').DataTable());</script>
</body></html>
