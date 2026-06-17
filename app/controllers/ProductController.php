<?php

require_once 'app/core/Controller.php';

class ProductController extends Controller {

    public function index() {
        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        // Parameters
        $search = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? '';
        $page = max(1, intval($_GET['page'] ?? 1));
        $limit = 8;
        $offset = ($page - 1) * $limit;

        // Data
        $products = $productModel->getAll($limit, $offset, $search, $category);
        $totalProducts = $productModel->countAll($search, $category);
        $categories = $categoryModel->getAll();
        
        $totalPages = ceil($totalProducts / $limit);

        $this->view('product/index', [
            'title' => 'Produk Bekas Berkualitas - Second Store',
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'currentCategory' => $category,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function detail($id) {
        $productModel = $this->model('Product');
        
        $product = $productModel->getById($id);
        if (!$product) {
            $this->redirect('/product');
        }

        $related = $productModel->getRelated($id, 4);

        $this->view('product/detail', [
            'title' => $product['name'] . ' - Second Store',
            'product' => $product,
            'related' => $related
        ]);
    }
}
