# Second Store - Toko Online Barang Bekas Premium

**Second Store** adalah sebuah aplikasi web e-commerce minimalis & premium yang dirancang khusus untuk memfasilitasi penjualan barang-barang bekas (secondhand) yang berkualitas dan terkurasi. Mengusung konsep belanja ramah lingkungan (*Eco-Friendly Shopping*), proyek ini membantu memperpanjang masa pakai barang guna mendukung ekonomi sirkular.

Aplikasi ini dibangun menggunakan arsitektur **MVC (Model-View-Controller)** sederhana berbasis PHP Native tanpa framework besar untuk memberikan performa yang cepat dan struktur kode yang mudah dipahami.

---

## 🌟 Fitur Utama

### 👥 Sisi Pengunjung (Public Website)
- **Katalog Produk Terorganisir**: Menampilkan produk berdasarkan kategori, lengkap dengan label kondisi barang (*Seperti Baru*, *Sangat Baik*, *Layak Pakai*, dan *Pecah/Minus*).
- **Detail Produk Transparan**: Halaman informasi detail produk yang memaparkan catatan minus (*defect*) secara jujur.
- **Watermark Terjual**: Penanda visual (*sold watermark*) otomatis untuk produk yang stoknya habis.
- **Keranjang Belanja & Checkout**: Simulasi alur checkout pembelian produk dengan kalkulasi harga.
- **Blog & Tips Kelestarian**: Halaman berisi artikel bermanfaat seputar tips merawat barang dan gaya hidup ramah lingkungan.
- **Mode Gelap (Dark Mode)**: Pengaturan tema website yang adaptif menggunakan local storage.

### 🛡️ Sisi Admin (Admin Panel)
- **Dashboard Ringkasan**: Dilengkapi visualisasi grafik interaktif menggunakan **Chart.js** untuk melihat perbandingan stok (Tersedia vs Terjual) serta sebaran kategori produk.
- **Kelola Produk (CRUD)**: Manajemen penuh untuk menambah, mengubah, dan menghapus katalog produk dengan unggah foto produk.
- **Kelola Kategori (CRUD)**: Klasifikasi kategori produk secara dinamis.
- **Kelola Blog & Tips (CRUD)**: Publikasi artikel edukatif bagi pengunjung.

### ⚡ Keamanan & UX Tambahan
- **Global Error Handling**: Pencegahan kebocoran informasi stack trace (PDO/PHP raw errors) ke pengguna. Sistem secara otomatis menampilkan halaman error premium buatan kustom jika terjadi kendala database/sistem.
- **Universal Loading Overlay**: Efek transisi pemuatan halaman (*loading state*) yang mulus setiap kali melakukan interaksi database, berpindah halaman, atau mengirimkan form CRUD.

---

## 🛠️ Teknologi yang Digunakan

- **Core Engine**: PHP (Arsitektur MVC & Routing Dinamis)
- **Database**: MySQL / MariaDB
- **User Interface**: 
  - Bootstrap 5 (Responsive Framework)
  - Bootstrap Icons
  - Outfit (Google Fonts)
  - Vanilla CSS3 & Vanilla JavaScript
- **Admin Utilities**:
  - DataTables (Tabel data interaktif dengan pagination & pencarian)
  - Chart.js (Grafik inventaris & statistik)
  - SweetAlert2

---

## 💾 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek **Second Store** di komputer lokal Anda:

### 1. Prasyarat Sistem
- **Web Server**: Apache/Nginx (Rekomendasi: XAMPP, Laragon, atau MAMP)
- **PHP Version**: PHP 8.0 ke atas
- **Database Server**: MySQL / MariaDB

### 2. Langkah Pemasangan
1. **Unduh/Kloning Repositori**:
   Tempatkan folder proyek ini di dalam direktori web server Anda (misal `C:/xampp/htdocs/second_store` atau `/var/www/html/second_store`).

2. **Konfigurasi Database**:
   - Buka MySQL client Anda (seperti phpMyAdmin atau HeidiSQL).
   - Buat database baru bernama `second_store`.
   - Impor berkas SQL yang terletak di: [database/second_store.sql](file:///d:/www/second_store/database/second_store.sql) ke dalam database tersebut.

3. **Ubah Konfigurasi Aplikasi** (Jika diperlukan):
   Buka file [config/config.php](file:///d:/www/second_store/config/config.php) untuk menyesuaikan kredensial koneksi database server Anda:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'second_store');
   ```

4. **Jalankan Aplikasi**:
   Buka browser Anda dan akses URL proyek tersebut, misalnya:
   `http://localhost/second_store/`

---

## 🔑 Demo Kredensial Admin

Untuk masuk ke Panel Admin dan mencoba fitur CRUD, silakan akses halaman login admin di `http://localhost/second_store/admin/login` menggunakan kredensial default berikut:

- **Halaman Login**: [Login Admin](file:///d:/www/second_store/app/views/admin/login.php)
- **Username**: `admin`
- **Password**: `12345`