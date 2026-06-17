<footer class="py-5 bg-dark text-white mt-auto border-top border-secondary">
  <div class="container">
    <div class="row g-4 justify-content-between">
      <div class="col-md-4">
        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-recycle text-accent"></i> SecondStore</h5>
        <p class="text-secondary small">Destinasi terpercaya untuk barang bekas berkualitas tinggi. Belanja lebih bijak, lebih hemat, dan dukung kelestarian lingkungan.</p>
        <div class="d-flex gap-3 mt-3">
          <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>
      <div class="col-md-2">
        <h6 class="fw-bold mb-3">Tautan Cepat</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 small">
          <li><a href="<?= BASE_URL; ?>" class="text-secondary text-decoration-none hover-primary">Home</a></li>
          <li><a href="<?= BASE_URL; ?>product" class="text-secondary text-decoration-none hover-primary">Semua Produk</a></li>
          <li><a href="<?= BASE_URL; ?>blog" class="text-secondary text-decoration-none hover-primary">Tips & Blog</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold mb-3">Hubungi Kami</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 small text-secondary">
          <li><i class="bi bi-geo-alt me-2"></i> Jl. Universitas Muhammadiyah Lamongan, Jawa Timur</li>
          <li><i class="bi bi-telephone me-2"></i> +62 856-4885-7716</li>
          <li><i class="bi bi-envelope me-2"></i> info@secondstore.com</li>
        </ul>
      </div>
    </div>
    <hr class="my-4 border-secondary">
    <div class="text-center text-secondary small">
      <p class="mb-0">© <?= date('Y'); ?> Second Store. All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Dark Mode Toggle Logic
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('darkModeToggle');
    const toggleIcon = document.getElementById('darkModeIcon');
    
    // Check local storage for preference
    const isDark = localStorage.getItem('darkMode') === 'enabled';
    if (isDark) {
        document.body.classList.add('dark-mode');
        if (toggleIcon) {
            toggleIcon.classList.remove('bi-moon-fill');
            toggleIcon.classList.add('bi-sun-fill');
        }
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const darkEnabled = document.body.classList.contains('dark-mode');
            
            if (darkEnabled) {
                localStorage.setItem('darkMode', 'enabled');
                if (toggleIcon) {
                    toggleIcon.classList.remove('bi-moon-fill');
                    toggleIcon.classList.add('bi-sun-fill');
                }
            } else {
                localStorage.setItem('darkMode', 'disabled');
                if (toggleIcon) {
                    toggleIcon.classList.remove('bi-sun-fill');
                    toggleIcon.classList.add('bi-moon-fill');
                }
            }
        });
    }

    // Loading overlay controls
    const showLoader = () => {
        const overlay = document.getElementById('loading-overlay');
        if (overlay) overlay.classList.add('active');
    };

    // Show loader on page transitions via links
    document.querySelectorAll('a').forEach(link => {
        const href = link.getAttribute('href');
        const target = link.getAttribute('target');
        if (href && 
            !href.startsWith('#') && 
            !href.startsWith('javascript:') && 
            !link.hasAttribute('data-bs-toggle') &&
            target !== '_blank') {
            link.addEventListener('click', (e) => {
                if (e.metaKey || e.ctrlKey) return;
                showLoader();
            });
        }
    });

    // Show loader on form submission (login, CRUD, search etc.)
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (form.checkValidity()) {
                showLoader();
                form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(btn => {
                    btn.disabled = true;
                    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...`;
                });
            }
        });
    });
});
</script>
<style>
.hover-primary:hover {
  color: var(--primary-color) !important;
  transition: color 0.2s;
}
</style>
</body>
</html>
