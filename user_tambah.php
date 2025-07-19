<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    $conn->query("INSERT INTO user (username, password, role)
                  VALUES ('$username', '$password', '$role')");
    header("Location: user_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah User</title></head>
<body>
<h1>Tambah User</h1>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Role:
    <select name="role">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select><br><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>
