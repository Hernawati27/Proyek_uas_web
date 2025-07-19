<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM poliklinik WHERE id=$id");
header("Location: poliklinik_index.php");
exit;
