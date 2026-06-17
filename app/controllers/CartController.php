<?php

require_once 'app/core/Controller.php';

class CartController extends Controller {

    public function index() {
        $cart = $_SESSION['cart'] ?? [];

        $this->view('cart/index', [
            'title' => 'Keranjang Belanja - Second Store',
            'cart' => $cart
        ]);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                $this->redirect('/product');
            }

            $productModel = $this->model('Product');
            $product = $productModel->getById($id);

            if (!$product) {
                $this->redirect('/product');
            }

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // check if already in cart
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    $item['qty'] += 1;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'] ?: 'images/sample1.jpg',
                    'price' => $product['price'],
                    'qty' => 1
                ];
            }
        }
        $this->redirect('/cart');
    }

    public function remove($id) {
        $id = intval($id);
        $cart = $_SESSION['cart'] ?? [];

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($cart); // Re-index array
        $this->redirect('/cart');
    }

    public function checkout() {
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            $this->redirect('/product');
        }

        $this->view('cart/checkout', [
            'title' => 'Checkout - Second Store',
            'cart' => $cart
        ]);
    }
}
