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
  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #0f172a;
    }
    .card {
      border: none;
      border-radius: 1.5rem;
      background-color: #1e293b;
      color: #f8fafc;
    }
    .form-control {
      background-color: #0f172a;
      border-color: #334155;
      color: #f8fafc;
      border-radius: 0.75rem;
    }
    .form-control:focus {
      background-color: #0f172a;
      border-color: #6366f1;
      color: #f8fafc;
      box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }
    .btn-primary {
      background-color: #6366f1;
      border-color: #6366f1;
      border-radius: 0.75rem;
    }
    .btn-primary:hover {
      background-color: #4f46e5;
      border-color: #4f46e5;
    }
    .hover-primary:hover {
      color: #6366f1 !important;
      transition: color 0.2s;
    }
    /* Loading Overlay Style */
    #loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(5px);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 99999;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }
    #loading-overlay.active {
      opacity: 1;
      pointer-events: auto;
    }
    .loader-spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #334155;
      border-top-color: #6366f1;
      border-radius: 50%;
      animation: spinner 0.8s linear infinite;
    }
    @keyframes spinner {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
<div class="card shadow-lg p-4 p-md-5" style="width: 100%; max-width: 420px;">
  <div class="text-center mb-4">
    <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
      <i class="bi bi-shield-lock fs-1 text-indigo"></i>
    </div>
    <h4 class="fw-bold mb-1">Portal Admin</h4>
    <p class="text-secondary small">Masuk untuk mengelola SecondStore</p>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger border-0 rounded-3 text-center small"><?= htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="<?= BASE_URL; ?>admin/login">
    <div class="mb-3">
      <label class="form-label small fw-semibold text-secondary">Username</label>
      <div class="input-group">
        <span class="input-group-text bg-transparent border-end-0 border-secondary text-secondary"><i class="bi bi-person"></i></span>
        <input type="text" name="username" class="form-control border-start-0" placeholder="Username Anda" required autofocus>
      </div>
    </div>
    <div class="mb-4">
      <label class="form-label small fw-semibold text-secondary">Password</label>
      <div class="input-group">
        <span class="input-group-text bg-transparent border-end-0 border-secondary text-secondary"><i class="bi bi-key"></i></span>
        <input type="password" name="password" class="form-control border-start-0" placeholder="Password Anda" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2.5 fw-semibold"><i class="bi bi-box-arrow-in-right me-2"></i>Login Admin</button>
  </form>
  
  <div class="text-center mt-3">
    <a href="<?= BASE_URL; ?>" class="text-secondary small text-decoration-none hover-primary">
      <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
    </a>
  </div>
</div>

<div id="loading-overlay">
  <div class="loader-spinner mb-3"></div>
  <div class="text-white fw-bold">Memproses...</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const showLoader = () => {
        document.getElementById('loading-overlay').classList.add('active');
    };

    // Show on form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', (e) => {
            if (form.checkValidity()) {
                showLoader();
                const btn = form.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...`;
                }
            }
        });
    }

    // Show on link navigation
    document.querySelectorAll('a').forEach(link => {
        const href = link.getAttribute('href');
        const target = link.getAttribute('target');
        if (href && !href.startsWith('#') && !href.startsWith('javascript:') && target !== '_blank') {
            link.addEventListener('click', (e) => {
                if (e.metaKey || e.ctrlKey) return;
                showLoader();
            });
        }
    });
});
</script>
</body>
</html>
