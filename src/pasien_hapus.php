<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM pasien WHERE id=$id");
header("Location: pasien_index.php");
exit;
