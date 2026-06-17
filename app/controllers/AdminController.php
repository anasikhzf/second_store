<?php

require_once 'app/core/Controller.php';

class AdminController extends Controller {

    private function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
            $this->redirect('/admin/login');
        }
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['admin'])) {
            $this->redirect('/admin');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->login($username, $password);

            if ($user) {
                $_SESSION['admin'] = $user['username'];
                $this->redirect('/admin');
            } else {
                $error = 'Username atau Password salah!';
            }
        }

        $this->view('admin/login', [
            'title' => 'Login Admin - Second Store',
            'error' => $error
        ]);
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['admin']);
        session_destroy();
        $this->redirect('/');
    }

    public function dashboard() {
        $this->checkAuth();

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');
        $blogModel = $this->model('Blog');

        // Total Counts
        $productCount = $productModel->countAll();
        $categoryCount = $categoryModel->countAll();
        $blogCount = $blogModel->countAll();

        // Get Available vs Sold counts directly
        $db = Database::getInstance();
        $db->query("SELECT COUNT(*) as count FROM product WHERE status = 'available'");
        $availableCount = $db->single()['count'] ?? 0;

        $db->query("SELECT COUNT(*) as count FROM product WHERE status = 'sold'");
        $soldCount = $db->single()['count'] ?? 0;

        // Get count of products by category
        $db->query("SELECT c.name as category, COUNT(p.id) as count 
                    FROM category c 
                    LEFT JOIN product p ON p.category_id = c.id 
                    GROUP BY c.id");
        $categoryDistribution = $db->resultSet();

        $catLabels = [];
        $catCounts = [];
        foreach ($categoryDistribution as $row) {
            $catLabels[] = $row['category'];
            $catCounts[] = (int)$row['count'];
        }

        $this->view('admin/dashboard', [
            'title' => 'Admin Dashboard - Second Store',
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'blogCount' => $blogCount,
            'availableCount' => $availableCount,
            'soldCount' => $soldCount,
            'catLabels' => $catLabels,
            'catCounts' => $catCounts
        ]);
    }

    // Products Management (GET for listing, POST for add/edit)
    public function products() {
        $this->checkAuth();

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        // Handle Add
        if (isset($_POST['add'])) {
            $data = [
                'name' => $_POST['name'],
                'category_id' => intval($_POST['category']),
                'price' => floatval($_POST['price']),
                'description' => $_POST['description'] ?? '',
                'condition' => $_POST['condition'] ?? 'Layak Pakai',
                'status' => $_POST['status'] ?? 'available',
                'defect' => !empty($_POST['defect']) ? $_POST['defect'] : null,
                'image' => ''
            ];

            $lastId = $productModel->add($data);

            if ($lastId && !empty($_FILES['image']['tmp_name'])) {
                $uploadDir = 'images/product/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . 'product_' . $lastId . '.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                $productModel->update($lastId, array_merge($data, ['image' => $imagePath]));
            }
            $this->redirect('/admin/products');
        }

        // Handle Edit
        if (isset($_POST['edit'])) {
            $id = intval($_POST['id']);
            $data = [
                'name' => $_POST['name'],
                'category_id' => intval($_POST['category']),
                'price' => floatval($_POST['price']),
                'description' => $_POST['description'] ?? '',
                'condition' => $_POST['condition'] ?? 'Layak Pakai',
                'status' => $_POST['status'] ?? 'available',
                'defect' => !empty($_POST['defect']) ? $_POST['defect'] : null
            ];

            if (!empty($_FILES['image']['tmp_name'])) {
                $uploadDir = 'images/product/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . 'product_' . $id . '.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                $data['image'] = $imagePath;
            }

            $productModel->update($id, $data);
            $this->redirect('/admin/products');
        }

        $products = $productModel->getAll();
        $categories = $categoryModel->getAll();

        $this->view('admin/products', [
            'title' => 'Kelola Produk - Second Store',
            'products' => $products,
            'categories' => $categories
        ]);
    }

    // Secure POST Product Delete
    public function deleteProduct() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id > 0) {
                $productModel = $this->model('Product');
                $product = $productModel->getById($id);
                if ($product && !empty($product['image'])) {
                    @unlink($product['image']);
                }
                $productModel->delete($id);
            }
        }
        $this->redirect('/admin/products');
    }

    // Categories Management (GET for listing, POST for add/edit)
    public function categories() {
        $this->checkAuth();

        $categoryModel = $this->model('Category');

        // Handle Add
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $categoryModel->add($name);
            $this->redirect('/admin/categories');
        }

        // Handle Edit
        if (isset($_POST['edit'])) {
            $id = intval($_POST['id']);
            $name = $_POST['name'];
            $categoryModel->update($id, $name);
            $this->redirect('/admin/categories');
        }

        $categories = $categoryModel->getAll();

        $this->view('admin/categories', [
            'title' => 'Kelola Kategori - Second Store',
            'categories' => $categories
        ]);
    }

    // Secure POST Category Delete
    public function deleteCategory() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id > 0) {
                $categoryModel = $this->model('Category');
                $categoryModel->delete($id);
            }
        }
        $this->redirect('/admin/categories');
    }

    // Blogs Management (GET for listing, POST for add/edit)
    public function blogs() {
        $this->checkAuth();

        $blogModel = $this->model('Blog');

        // Handle Add
        if (isset($_POST['add'])) {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => ''
            ];

            $lastId = $blogModel->add($data);

            if ($lastId && !empty($_FILES['image']['tmp_name'])) {
                $uploadDir = 'images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . 'blog_' . $lastId . '.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                $blogModel->update($lastId, array_merge($data, ['image' => $imagePath]));
            }
            $this->redirect('/admin/blogs');
        }

        // Handle Edit
        if (isset($_POST['edit'])) {
            $id = intval($_POST['id']);
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content']
            ];

            if (!empty($_FILES['image']['tmp_name'])) {
                $uploadDir = 'images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imagePath = $uploadDir . 'blog_' . $id . '.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
                $data['image'] = $imagePath;
            }

            $blogModel->update($id, $data);
            $this->redirect('/admin/blogs');
        }

        $blogs = $blogModel->getAll();

        $this->view('admin/blogs', [
            'title' => 'Kelola Blog - Second Store',
            'blogs' => $blogs
        ]);
    }

    // Secure POST Blog Delete
    public function deleteBlog() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id > 0) {
                $blogModel = $this->model('Blog');
                $blog = $blogModel->getById($id);
                if ($blog && !empty($blog['image'])) {
                    @unlink($blog['image']);
                }
                $blogModel->delete($id);
            }
        }
        $this->redirect('/admin/blogs');
    }
}
