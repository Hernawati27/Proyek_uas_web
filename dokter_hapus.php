<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM dokter WHERE id=$id");
header("Location: dokter_index.php");
exit;
