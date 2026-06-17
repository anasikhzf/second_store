<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Terjadi Kesalahan - Second Store'); ?></title>
  <link rel="icon" href="<?= defined('BASE_URL') ? BASE_URL : ''; ?>images/PHP-logo.svg.png" type="image/png">
  
  <!-- Outfit Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #0f172a;
      color: #f1f5f9;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .error-card {
      background: #1e293b;
      border: 1px solid #334155;
      border-radius: 1.5rem;
      padding: 3rem 2rem;
      max-width: 500px;
      width: 100%;
      text-align: center;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
    }
    .error-icon {
      font-size: 4rem;
      color: #f59e0b;
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    .btn-primary {
      background-color: #4f46e5;
      border-color: #4f46e5;
      border-radius: 0.75rem;
      padding: 0.75rem 1.5rem;
      font-weight: 500;
      transition: all 0.2s;
    }
    .btn-primary:hover {
      background-color: #4338ca;
      border-color: #4338ca;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center">
    <div class="error-card">
      <div class="mb-4">
        <i class="bi bi-exclamation-triangle-fill error-icon"></i>
      </div>
      <h3 class="fw-bold mb-3">Terjadi Kesalahan Sistem</h3>
      <p class="text-secondary mb-4">
        Mohon maaf, sistem kami sedang mengalami gangguan atau halaman tidak dapat dimuat. Silakan kembali ke halaman utama atau coba lagi nanti.
      </p>
      <div>
        <a href="<?= defined('BASE_URL') ? BASE_URL : '/'; ?>" class="btn btn-primary shadow-sm">
          <i class="bi bi-house-door me-2"></i>Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>
</body>
</html>
