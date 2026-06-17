<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Second Store - Toko Online Barang Bekas'); ?></title>
  
  <!-- Icon -->
  <link rel="icon" href="<?= BASE_URL; ?>images/PHP-logo.svg.png" type="image/png">
  
  <!-- Google Fonts (Outfit) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Custom Minimalist Premium Styles -->
  <style>
    :root {
      --primary-color: #4f46e5;
      --primary-hover: #4338ca;
      --accent-color: #f59e0b;
      --bg-light: #f8fafc;
      --card-bg-light: #ffffff;
      --text-dark: #0f172a;
      
      --bg-dark: #0f172a;
      --card-bg-dark: #1e293b;
      --text-light: #f1f5f9;
      --border-dark: #334155;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background-color: var(--bg-light);
      color: var(--text-dark);
      transition: background-color 0.3s, color 0.3s;
    }

    body.dark-mode {
      background-color: var(--bg-dark);
      color: var(--text-light);
    }

    .navbar {
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.8) !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      transition: background-color 0.3s, border-color 0.3s;
    }

    body.dark-mode .navbar {
      background-color: rgba(15, 23, 42, 0.8) !important;
      border-bottom: 1px solid var(--border-dark);
    }

    .card {
      background-color: var(--card-bg-light);
      border: 1px solid rgba(0, 0, 0, 0.05);
      border-radius: 1rem;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s, border-color 0.3s;
    }

    body.dark-mode .card {
      background-color: var(--card-bg-dark);
      border-color: var(--border-dark);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    body.dark-mode .card:hover {
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      font-weight: 500;
      border-radius: 0.5rem;
      padding: 0.6rem 1.2rem;
      transition: all 0.2s;
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
    }

    .badge-condition {
      font-size: 0.75rem;
      font-weight: 600;
      padding: 0.35em 0.65em;
      border-radius: 2rem;
    }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      z-index: 1030;
      background-color: rgba(255, 255, 255, 0.9) !important;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
      backdrop-filter: blur(10px);
      transition: background-color 0.3s, border-color 0.3s;
    }

    body.dark-mode .bottom-nav {
      background-color: rgba(15, 23, 42, 0.9) !important;
      border-top: 1px solid var(--border-dark);
    }

    .bottom-nav .nav-link {
      font-size: 1.3rem;
      color: #64748b;
      padding: 0.5rem 0;
      transition: color 0.2s;
    }

    .bottom-nav .nav-link.active,
    .bottom-nav .nav-link:hover {
      color: var(--primary-color) !important;
    }

    body.dark-mode .bottom-nav .nav-link {
      color: #94a3b8;
    }

    body.dark-mode .bottom-nav .nav-link.active {
      color: #a5b4fc !important;
    }

    /* Hero section styles */
    .hero-section {
      background: linear-gradient(135deg, #e0e7ff 0%, #e0f2fe 100%);
      border-radius: 2rem;
      padding: 4rem 2rem;
      margin-bottom: 3rem;
      position: relative;
      overflow: hidden;
    }

    body.dark-mode .hero-section {
      background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);
    }

    /* Custom Table for Cart */
    .table {
      color: inherit;
    }

    body.dark-mode .table th {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
      border-color: var(--border-dark);
    }

    body.dark-mode .table td {
      border-color: var(--border-dark);
    }

    /* Input dark mode */
    body.dark-mode .form-control,
    body.dark-mode .form-select {
      background-color: var(--card-bg-dark);
      border-color: var(--border-dark);
      color: var(--text-light);
    }

    body.dark-mode .form-control:focus,
    body.dark-mode .form-select:focus {
      background-color: var(--card-bg-dark);
      border-color: var(--primary-color);
      color: var(--text-light);
      box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }

    /* Dark Mode visibility overrides */
    body.dark-mode .bg-light,
    body.dark-mode .bg-body-tertiary {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
    }
    body.dark-mode .text-dark,
    body.dark-mode .text-dark-emphasis,
    body.dark-mode .text-slate-800 {
      color: var(--text-light) !important;
    }
    body.dark-mode .text-secondary,
    body.dark-mode .text-muted {
      color: #94a3b8 !important;
    }
    body.dark-mode .border,
    body.dark-mode .border-top,
    body.dark-mode .border-bottom,
    body.dark-mode .border-start,
    body.dark-mode .border-end {
      border-color: var(--border-dark) !important;
    }
    body.dark-mode .list-group-item {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
      border-color: var(--border-dark) !important;
    }
    body.dark-mode .modal-content {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
      border-color: var(--border-dark) !important;
    }
    body.dark-mode .dropdown-menu {
      background-color: var(--card-bg-dark) !important;
      color: var(--text-light) !important;
      border-color: var(--border-dark) !important;
    }

    @media (max-width: 575.98px) {
      .card-body {
        padding: 0.5rem !important;
      }
      .card-title {
        font-size: 0.85rem !important;
        margin-bottom: 0.25rem !important;
      }
      .card-body p {
        font-size: 0.85rem !important;
        margin-bottom: 0.5rem !important;
      }
      .card-body .btn {
        font-size: 0.75rem !important;
        padding: 0.35rem 0.5rem !important;
      }
      .badge-condition {
        font-size: 0.55rem !important;
        padding: 0.2em 0.4em !important;
        margin: 0.5rem !important;
      }
      .position-absolute.top-0.end-0.m-3 {
        margin: 0.5rem !important;
        font-size: 0.55rem !important;
        padding: 0.2em 0.5em !important;
      }
      /* Adjust TERJUAL watermark size on mobile */
      .position-absolute[style*="background-color"] span {
        font-size: 0.75rem !important;
        padding: 0.2rem 0.4rem !important;
        border-width: 1px !important;
      }
      /* Set image heights to look balanced in 3 columns */
      .card [style*="height: 200px"] {
        height: 110px !important;
      }
      .card [style*="height: 180px"] {
        height: 100px !important;
      }
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
<body class="d-flex flex-column min-vh-100">

<div id="loading-overlay">
  <div class="loader-spinner mb-3"></div>
  <div class="text-white fw-bold">Memuat Halaman...</div>
</div>
