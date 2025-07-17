<?php
require 'config.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        require 'controllers/AuthController.php';
        (new AuthController())->login();
        break;
        
    case 'logout':
        require 'controllers/AuthController.php';
        (new AuthController())->logout();
        break;
        
    case 'shop':
        require 'controllers/ProductController.php';
        (new ProductController())->shop();
        break;
        
    case 'cart':
        require 'controllers/CartController.php';
        $cartAction = $_GET['do'] ?? 'view';
        $cart = new CartController();
        
        if ($cartAction === 'add') $cart->add();
        elseif ($cartAction === 'remove') $cart->remove();
        elseif ($cartAction === 'update') $cart->update();
        else $cart->view();
        break;
        
    case 'admin':
        if (!isset($_SESSION['admin'])) {
            redirect('index.php?action=login');
        }
        require 'controllers/ProductController.php';
        $adminAction = $_GET['do'] ?? 'dashboard';
        $product = new ProductController();
        
        if ($adminAction === 'add') $product->add();
        elseif ($adminAction === 'edit') $product->edit();
        elseif ($adminAction === 'delete') $product->delete();
        else $product->adminDashboard();
        break;
        
    default:
        require 'views/home.php';
}
?>