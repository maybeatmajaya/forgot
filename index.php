<?php
// Autoload file konfigurasi dan model
require 'config/database.php';
require 'models/UserModel.php';
require 'controllers/AuthController.php';

// Inisialisasi objek model dan controller
$db = new PDO('mysql:host=localhost;dbname=forgot', 'root', ''); // Ganti sesuai dengan konfigurasi database Anda
$userModel = new UserModel($db);
$authController = new AuthController($userModel);

// Ambil aksi dari query string atau gunakan default
$action = $_GET['action'] ?? 'showEmailForm';

switch ($action) {
    case 'handleEmail':
        // Proses pengiriman email OTP
        if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $authController->handleEmailForm($_POST['email']);
        } else {
            echo "Masukkan email yang valid.";
        }
        break;

    case 'verifyOtp':
        // Proses verifikasi OTP
        if (!empty($_POST['email']) && !empty($_POST['otp'])) {
            $authController->verifyOtp($_POST['email'], $_POST['otp']);
        } else {
            echo "Email dan OTP harus diisi.";
        }
        break;

    case 'updatePassword':
        // Proses pembaruan password
        if (!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['email'])) {
            if ($_POST['password'] === $_POST['confirm_password']) {
                $authController->resetPassword($_POST['email'], $_POST['password']);
            } else {
                echo "Password dan konfirmasi password tidak cocok.";
            }
        } else {
            echo "Semua kolom harus diisi.";
        }
        break;

    default:
        // Tampilkan form input email
        $authController->showEmailForm();
        break;
}
?>
