<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM pembayaran WHERE id=$id");
header("Location: pembayaran_index.php");
exit;
