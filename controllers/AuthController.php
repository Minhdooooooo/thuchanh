<?php
class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if ($username === 'admin' && $password === '123') {
                $_SESSION['admin'] = true;
                redirect('index.php?action=admin');
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu";
                require 'views/login.php';
            }
        } else {
            require 'views/login.php';
        }
    }
    
    public function logout() {
        session_destroy();
        redirect('index.php');
    }
}
?>