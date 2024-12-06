<!-- views/reset_password_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form method="POST" action="index.php?action=updatePassword">
        <input type="hidden" name="email" value="<?php echo $email; ?>" />
        <label for="password">New Password:</label>
        <input type="password" name="password" required /><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required /><br><br>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
