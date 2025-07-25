<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include '../config/database.php';

// Filter
$filter = $_GET['filter'] ?? 'day'; // day, month, year
$date = $_GET['date'] ?? date('Y-m-d'); // default hari ini
$month = $_GET['month'] ?? date('Y-m'); // default bulan ini
$year = $_GET['year'] ?? date('Y'); // default tahun ini

$data = [];
$labels = [];

if ($filter == 'day') {
  for ($i=0; $i<24; $i++) {
    $hour = str_pad($i,2,'0',STR_PAD_LEFT);
    $count = mysqli_fetch_row(mysqli_query($conn,
      "SELECT COUNT(*) FROM visitor WHERE DATE(date)='$date' AND HOUR(date)='$hour'"))[0];
    $labels[] = "$hour:00";
    $data[] = $count;
  }
} elseif ($filter == 'month') {
  $days = date('t', strtotime($month.'-01'));
  for ($i=1; $i<=$days; $i++) {
    $day = str_pad($i,2,'0',STR_PAD_LEFT);
    $count = mysqli_fetch_row(mysqli_query($conn,
      "SELECT COUNT(*) FROM visitor WHERE DATE_FORMAT(date,'%Y-%m')='$month' AND DAY(date)='$day'"))[0];
    $labels[] = "$day";
    $data[] = $count;
  }
} else {
  for ($i=1; $i<=12; $i++) {
    $month_num = str_pad($i,2,'0',STR_PAD_LEFT);
    $count = mysqli_fetch_row(mysqli_query($conn,
      "SELECT COUNT(*) FROM visitor WHERE YEAR(date)='$year' AND MONTH(date)='$month_num'"))[0];
    $labels[] = date('M', mktime(0,0,0,$i,1));
    $data[] = $count;
  }
}

// Hitung total
$product_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM product"))[0];
$category_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM category"))[0];
$blog_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM blog"))[0];
?>
<!DOCTYPE html>
<html>
<?php include 'components/head.php'; ?>
<body class="d-md-flex">
<?php include 'components/sidebar.php'; ?>
<main class="flex-fill p-3" style="overflow-x:hidden;">
  <h3>Dashboard</h3>
  <div class="mt-4">
    <h5>Grafik Pengunjung</h5>
    <form method="get" class="row g-2 align-items-end mb-3">
      <div class="col-auto">
        <select name="filter" class="form-select" onchange="this.form.submit()">
          <option value="day" <?=($filter=='day'?'selected':'')?>>Harian</option>
          <option value="month" <?=($filter=='month'?'selected':'')?>>Bulanan</option>
          <option value="year" <?=($filter=='year'?'selected':'')?>>Tahunan</option>
        </select>
      </div>
      <?php if ($filter=='day'): ?>
      <div class="col-auto">
        <input type="date" name="date" value="<?=$date?>" class="form-control" onchange="this.form.submit()">
      </div>
      <?php elseif ($filter=='month'): ?>
      <div class="col-auto">
        <input type="month" name="month" value="<?=$month?>" class="form-control" onchange="this.form.submit()">
      </div>
      <?php else: ?>
      <div class="col-auto">
        <input type="number" name="year" value="<?=$year?>" class="form-control" onchange="this.form.submit()" min="2000" max="<?=date('Y')?>">
      </div>
      <?php endif; ?>
    </form>
    <div class="bg-white p-2 rounded shadow-sm">
      <canvas id="visitorChart" height="150"></canvas>
    </div>
  </div>
  <div class="row g-4 mt-3">
    <div class="col-md-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <i class="bi bi-box-seam fs-1 text-primary"></i>
          <h5 class="mt-2">Total Produk</h5>
          <p class="fs-4 fw-bold mb-0"><?=$product_count;?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <i class="bi bi-tags fs-1 text-success"></i>
          <h5 class="mt-2">Total Kategori</h5>
          <p class="fs-4 fw-bold mb-0"><?=$category_count;?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <i class="bi bi-journal-text fs-1 text-danger"></i>
          <h5 class="mt-2">Total Blog</h5>
          <p class="fs-4 fw-bold mb-0"><?=$blog_count;?></p>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
const ctx = document.getElementById('visitorChart').getContext('2d');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?=json_encode($labels)?>,
    datasets: [{
      label: 'Pengunjung',
      data: <?=json_encode($data)?>,
      borderColor: 'rgba(75, 192, 192, 1)',
      backgroundColor: 'rgba(75,192,192,0.2)',
      fill: true,
      tension: 0.3
    }]
  },
  options: {
    responsive:true,
    maintainAspectRatio:false,
    scales: {
      y: { beginAtZero:true }
    }
  }
});
</script>
</body>
</html>
