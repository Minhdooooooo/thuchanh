<?php
require_once 'models/ProductModel.php';

class ProductController {
    private $model;
    
    public function __construct() {
        $this->model = new ProductModel();
    }
    
    public function shop() {
        $products = $this->model->getAll();
        require 'views/header.php';
        require 'views/shop.php';
        require 'views/footer.php';
    }
    
    public function adminDashboard() {
        $products = $this->model->getAll();
        require 'views/header.php';
        require 'views/admin/dashboard.php';
        require 'views/footer.php';
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = (float)$_POST['price'];
            $this->model->create($name, $price);
            redirect('index.php?action=admin');
        }
        require 'views/header.php';
        require 'views/admin/add_product.php';
        require 'views/footer.php';
    }
    
    public function edit() {
        $id = (int)$_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = (float)$_POST['price'];
            $this->model->update($id, $name, $price);
            redirect('index.php?action=admin');
        }
        
        $product = $this->model->getById($id);
        require 'views/header.php';
        require 'views/admin/edit_product.php';
        require 'views/footer.php';
    }
    
    public function delete() {
        $id = (int)$_GET['id'];
        $this->model->delete($id);
        redirect('index.php?action=admin');
    }
}
?>