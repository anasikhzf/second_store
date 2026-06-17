<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title); ?></title>
  <link rel="icon" href="<?= BASE_URL; ?>images/PHP-logo.svg.png" type="image/png">
  
  <!-- Outfit Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  
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
    .metric-card {
      border: none;
      border-radius: 1.25rem;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .metric-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    }
    .chart-container {
      background-color: #ffffff;
      border-radius: 1.5rem;
      border: 1px solid rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
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
      <h3 class="fw-extrabold mb-1 text-slate-800">Ringkasan Sistem</h3>
      <p class="text-secondary small mb-0">Kelola katalog produk, kategori, dan artikel blog dalam satu portal terpadu</p>
    </div>
    <a href="<?= BASE_URL; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3" target="_blank">
      <i class="bi bi-globe me-1"></i>Lihat Website
    </a>
  </div>

  <!-- Metric Badges -->
  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="card metric-card shadow-sm p-4 bg-primary text-white position-relative overflow-hidden">
        <div class="position-relative z-1 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1 text-white-50 small fw-semibold uppercase">Total Produk</h6>
            <h1 class="fw-extrabold mb-0"><?= $productCount; ?></h1>
          </div>
          <div class="rounded-circle bg-white bg-opacity-20 p-3">
            <i class="bi bi-box-seam fs-2"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card metric-card shadow-sm p-4 bg-success text-white position-relative overflow-hidden">
        <div class="position-relative z-1 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1 text-white-50 small fw-semibold uppercase">Total Kategori</h6>
            <h1 class="fw-extrabold mb-0"><?= $categoryCount; ?></h1>
          </div>
          <div class="rounded-circle bg-white bg-opacity-20 p-3">
            <i class="bi bi-tags fs-2"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card metric-card shadow-sm p-4 bg-info text-white position-relative overflow-hidden">
        <div class="position-relative z-1 d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1 text-white-50 small fw-semibold uppercase">Total Artikel</h6>
            <h1 class="fw-extrabold mb-0"><?= $blogCount; ?></h1>
          </div>
          <div class="rounded-circle bg-white bg-opacity-20 p-3">
            <i class="bi bi-journal-text fs-2"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="row g-4 mb-4">
    <!-- Doughnut Chart for Stocks Available vs Sold -->
    <div class="col-md-5">
      <div class="chart-container shadow-sm h-100">
        <h5 class="fw-bold mb-4">Status Stok Inventaris</h5>
        <div style="position: relative; height: 260px;">
          <canvas id="stockChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Bar Chart for Categories Distribution -->
    <div class="col-md-7">
      <div class="chart-container shadow-sm h-100">
        <h5 class="fw-bold mb-4">Distribusi Produk per Kategori</h5>
        <div style="position: relative; height: 260px;">
          <canvas id="categoryChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Stock Status Chart (Doughnut)
    const stockCtx = document.getElementById('stockChart').getContext('2d');
    new Chart(stockCtx, {
        type: 'doughnut',
        data: {
            labels: ['Tersedia', 'Terjual'],
            datasets: [{
                data: [<?= $availableCount; ?>, <?= $soldCount; ?>],
                backgroundColor: ['#10b981', '#64748b'],
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // 2. Category Distribution Chart (Bar)
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($catLabels); ?>,
            datasets: [{
                label: 'Jumlah Produk',
                data: <?= json_encode($catCounts); ?>,
                backgroundColor: 'rgba(79, 70, 229, 0.75)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>
