<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Jika ingin membatasi role tertentu, aktifkan baris di bawah ini:
// if ($_SESSION['user']['role'] != 'admin') {
//     header("Location: index.php");
//     exit;
// }
?>
