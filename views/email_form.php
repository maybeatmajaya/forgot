<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukkan Email</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form action="index.php?action=handleEmail" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Kirim OTP</button>
    </form>
</body>
</html>
