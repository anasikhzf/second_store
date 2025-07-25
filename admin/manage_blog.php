<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include '../config/database.php';

// Tambah blog
if (isset($_POST['add'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  mysqli_query($conn, "INSERT INTO blog (title, content) VALUES ('$title', '$content')");
  $last_id = mysqli_insert_id($conn);
  if ($_FILES['image']['tmp_name']) {
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/blog_$last_id.jpg");
    mysqli_query($conn, "UPDATE blog SET image='../images/blog_$last_id.jpg' WHERE id=$last_id");
  }
  header("Location: manage_blog.php");
}

// Edit blog
if (isset($_POST['edit'])) {
  $id = intval($_POST['id']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  mysqli_query($conn, "UPDATE blog SET title='$title', content='$content' WHERE id=$id");
  if ($_FILES['image']['tmp_name']) {
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/blog_$id.jpg");
    mysqli_query($conn, "UPDATE blog SET image='../images/blog_$id.jpg' WHERE id=$id");
  }
  header("Location: manage_blog.php");
}

// Hapus
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  mysqli_query($conn, "DELETE FROM blog WHERE id=$id");
  @unlink("../images/blog_$id.jpg");
  header("Location: manage_blog.php");
}

// Ambil data
$blogs = mysqli_query($conn, "SELECT * FROM blog ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<?php include 'components/head.php'; ?>
<body class="d-md-flex">
<?php include 'components/sidebar.php'; ?>

<main class="flex-fill p-4" style="min-width:0; overflow-x:hidden;">
  <h4>Manage Blog</h4>
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah</button>

  <div class="table-responsive"> <!-- Tambahkan wrapper table-responsive -->
    <table id="table" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Judul</th>
          <th>Konten</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php while($b=mysqli_fetch_assoc($blogs)): ?>
      <tr>
        <td><?=$b['id'];?></td>
        <td><?=htmlspecialchars($b['title']);?></td>
        <td><?=substr(strip_tags($b['content']),0,50).'...';?></td>
        <td><?php if($b['image']): ?><img src="<?=$b['image'];?>" width="60"><?php endif; ?></td>
        <td>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?=$b['id'];?>">Edit</button>
          <a href="?delete=<?=$b['id'];?>" onclick="return confirm('Hapus?')" class="btn btn-sm btn-danger">Hapus</a>
        </td>
      </tr>

      <!-- Modal Edit -->
      <div class="modal fade" id="editModal<?=$b['id'];?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
              <div class="modal-header"><h5>Edit Blog</h5></div>
              <div class="modal-body">
                <input type="hidden" name="id" value="<?=$b['id'];?>">
                <input type="text" name="title" class="form-control mb-2" value="<?=htmlspecialchars($b['title']);?>" required>
                <textarea name="content" class="form-control mb-2" rows="4" required><?=htmlspecialchars($b['content']);?></textarea>
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
  </div>
</main>

<!-- Modal Add -->
<div class="modal fade" id="addModal">
<div class="modal-dialog"><div class="modal-content">
<form method="post" enctype="multipart/form-data">
<div class="modal-header"><h5>Tambah Blog</h5></div>
<div class="modal-body">
<input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>
<textarea name="content" class="form-control mb-2" rows="4" placeholder="Konten" required></textarea>
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
</body>
</html>
