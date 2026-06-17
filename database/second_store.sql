-- Buat database
CREATE DATABASE IF NOT EXISTS second_store;
USE second_store;

-- ======================
-- TABEL USERS (admin)
-- ======================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Dummy admin (password: 12345 -> md5)
INSERT INTO users (username, password) VALUES
('admin', MD5('12345'));

-- ======================
-- TABEL CATEGORY
-- ======================
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Dummy kategori
INSERT INTO category (name) VALUES
('Electronics'),
('Clothing'),
('Books'),
('Furniture'),
('Toys');

-- ======================
-- TABEL PRODUCT
-- ======================
CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category_id INT,
    image VARCHAR(255),
    product_condition ENUM('Pecah/Minus', 'Layak Pakai', 'Sangat Baik', 'Seperti Baru') DEFAULT 'Layak Pakai',
    status ENUM('available', 'sold') DEFAULT 'available',
    defect TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL
);

-- Dummy produk
INSERT INTO product (name, description, price, category_id, image, product_condition, status, defect) VALUES
('Laptop Acer Aspire', 'Laptop 14 inci dengan Intel i5, RAM 8GB', 5500000, 1, 'laptop.jpg', 'Sangat Baik', 'available', 'Lecet halus pada body bagian bawah, keyboard & layar aman.'),
('Kaos Polos Hitam', 'Kaos bahan katun combed 30s', 75000, 2, 'kaos.jpg', 'Seperti Baru', 'available', NULL),
('Novel Fiksi Petualangan', 'Novel seru untuk anak-anak dan dewasa', 65000, 3, 'novel.jpg', 'Layak Pakai', 'available', 'Ada lipatan kecil di halaman depan.'),
('Meja Kerja Minimalis', 'Meja kayu jati minimalis untuk kerja', 1200000, 4, 'meja.jpg', 'Sangat Baik', 'available', 'Ada sedikit goresan di pojok kanan bawah meja.'),
('Mainan Lego City', 'Set Lego City lengkap dengan 300 pcs', 350000, 5, 'lego.jpg', 'Seperti Baru', 'available', 'Box agak penyok, kelengkapan lego 100% aman.'),
('Smartphone Samsung A14', 'HP 6,5 inci RAM 4GB 128GB storage', 2200000, 1, 'samsung.jpg', 'Sangat Baik', 'sold', 'Tanpa charger bawaan, hanya unit HP saja.'),
('Jaket Hoodie Oversize', 'Hoodie kekinian bahan fleece', 150000, 2, 'hoodie.jpg', 'Layak Pakai', 'available', 'Warna sedikit pudar karena pencucian.');

-- ======================
-- TABEL BLOG
-- ======================
CREATE TABLE blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dummy blog
INSERT INTO blog (title, content) VALUES
('Tips Memilih Laptop untuk Mahasiswa', 'Berikut tips memilih laptop dengan harga terjangkau...'),
('Cara Merawat Baju Katun Agar Awet', 'Baju katun harus dicuci dengan air dingin...'),
('Tren Furniture Minimalis 2025', 'Furniture minimalis tetap jadi favorit tahun ini...'),
('5 Mainan Edukatif untuk Anak', 'Mainan edukatif membantu perkembangan otak anak...'),
('Rekomendasi Buku Terbaik 2025', 'Berikut daftar buku yang wajib dibaca tahun ini...');


