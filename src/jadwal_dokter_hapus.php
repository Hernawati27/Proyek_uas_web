<?php
include "config.php";
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM jadwal_dokter WHERE id=$id");
header("Location: jadwal_dokter_index.php");
exit;
