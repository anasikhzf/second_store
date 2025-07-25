<?php
session_start();
include '../config/database.php';
$error = '';

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = md5($_POST['password']);
  $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");
  if (mysqli_num_rows($query)>0) {
    $_SESSION['admin'] = $user;
    header('Location: index.php');
    exit;
  } else {
    $error = 'Username atau Password salah!';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Admin Second Store</title>
  <link rel="icon" href="../images/icon_second_store.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
  <img src="../images/icon_second_store.png" alt="icon" class="mb-3" style="width: 75px; height: 75px; object-fit: cover; display: block; margin: 0 auto;">
  <h4 class="mb-3 text-center">Login</h4>
  <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
  <form method="POST">
    <div class="mb-3">
      <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
    </div>
    <div class="mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
</div>
</body>
</html>
