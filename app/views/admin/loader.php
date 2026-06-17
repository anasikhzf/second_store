<?php
// app/views/admin/loader.php
?>
<style>
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

<div id="loading-overlay">
  <div class="loader-spinner mb-3"></div>
  <div class="text-white fw-bold">Memproses...</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
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
