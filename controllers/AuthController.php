<?php

class AuthController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function handleEmailForm($email)
    {
        // Periksa apakah email sudah terdaftar
        $user = $this->userModel->findByEmail($email);
        if ($user) {
            // Generate OTP
            $otp = rand(100000, 999999);
            $this->userModel->saveOtp($email, $otp);

            // Kirim email dengan PHPMailer
            require 'vendor/autoload.php';
            require 'vendor/phpmailer\phpmailer/src/PHPMailer.php';
            require 'vendor/phpmailer\phpmailer/src/Exception.php';
            require 'vendor/phpmailer\phpmailer/src/SMTP.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'extentionrays@gmail.com';
                $mail->Password = 'xpgt bryq zjkh agtr'; // Ganti dengan password email Anda
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('testforgot@gmail.com', 'forgot');
                $mail->addAddress($email);
                $mail->Subject = 'Your OTP Code';
                $mail->Body = "Your OTP code is: $otp";

                $mail->send();

                // Redirect ke halaman OTP
                include 'views/otp_form.php';
            } catch (Exception $e) {
                echo "Email tidak dapat dikirim. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Email tidak terdaftar.";
        }
    }

    public function verifyOtp($email, $otpInput)
    {
        // Periksa OTP dari database
        $otp = $this->userModel->getOtpByEmail($email);
        if ($otp && $otp === $otpInput) {
            // Hapus OTP setelah diverifikasi
            $this->userModel->deleteOtp($email);

            // Redirect ke halaman ganti sandi
            include 'views/reset_password_form.php';
        } else {
            echo "Kode OTP salah.";
        }
    }

    public function resetPassword($email, $newPassword)
    {
        // Hash password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Perbarui password di database
        $this->userModel->updatePassword($email, $hashedPassword);

        echo "Password berhasil diperbarui.";
    }

        public function showEmailForm()
    {
        // Tampilkan form input email
        include 'views/email_form.php';
    }
    

}

?>
