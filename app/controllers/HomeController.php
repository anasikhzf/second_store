<?php

require_once 'app/core/Controller.php';

class HomeController extends Controller {
    
    public function index() {
        // Get Latest Products
        $productModel = $this->model('Product');
        $products = $productModel->getLatest(8); // Show 8 products instead of 5 for a richer layout

        // Render Home View
        $this->view('home', [
            'title' => 'Home - Second Store',
            'products' => $products
        ]);
    }
}
