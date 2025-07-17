<?php
class CartController {
    public function view() {
        $cart = $_SESSION['cart'] ?? [];
        require 'views/header.php';
        require 'views/cart.php';
        require 'views/footer.php';
    }
    
    public function add() {
        $id = (int)$_GET['id'];
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        redirect('index.php?action=cart');
    }
    
    public function remove() {
        $id = (int)$_GET['id'];
        unset($_SESSION['cart'][$id]);
        redirect('index.php?action=cart');
    }
    
    public function update() {
        foreach ($_POST['quantity'] as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;
            
            if ($qty > 0) {
                $_SESSION['cart'][$id] = $qty;
            } else {
                unset($_SESSION['cart'][$id]);
            }
        }
        redirect('index.php?action=cart');
    }
}
?>