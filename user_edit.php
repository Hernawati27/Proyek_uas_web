<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$id = $_GET['id'];
$user = $conn->query("SELECT * FROM user WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $conn->query("UPDATE user SET username='$username', password='$password', role='$role' WHERE id=$id");
    } else {
        $conn->query("UPDATE user SET username='$username', role='$role' WHERE id=$id");
    }
    header("Location: user_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit User</title></head>
<body>
<h1>Edit User</h1>
<form method="POST">
    Username: <input type="text" name="username" value="<?= $user['username']; ?>" required><br><br>
    Password (Kosongkan jika tidak diubah): <input type="password" name="password"><br><br>
    Role:
    <select name="role">
        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : ''; ?>>Staff</option>
    </select><br><br>
    <button type="submit">Update</button>
</form>
</body>
</html>
