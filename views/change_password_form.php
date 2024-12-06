<form method="POST" action="index.php?action=updatePassword">
    <label for="password">New Password:</label>
    <input type="password" name="password" required>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>
    <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
    <button type="submit">Update Password</button>
</form>
