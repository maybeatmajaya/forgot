<?php

class UserModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveOtp($email, $otp)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET otp = ?, otp_created_at = NOW() WHERE email = ?");
        return $stmt->execute([$otp, $email]);
    }

    public function verifyOtp($email, $otp)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ? AND otp = ?");
        $stmt->execute([$email, $otp]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($email, $password)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET password = ?, otp = NULL WHERE email = ?");
        return $stmt->execute([password_hash($password, PASSWORD_BCRYPT), $email]);
    }

    public function getOtpByEmail($email)
{
    $query = "SELECT otp FROM users WHERE email = :email";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return OTP jika ditemukan, atau null jika tidak ada
    return $result ? $result['otp'] : null;
}

public function deleteOtp($email)
{
    $query = "UPDATE users SET otp = NULL WHERE email = :email";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    return $stmt->execute();
}


}
