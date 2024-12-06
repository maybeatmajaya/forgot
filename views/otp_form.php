<form method="POST" action="index.php?action=verifyOtp">
    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" required>
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    <button type="submit">Verify</button>
</form>
