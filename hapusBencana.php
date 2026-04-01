<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    exit();
}

$id = $_GET['id'];

$get_img = mysqli_query($conn, "SELECT gambar FROM bencana WHERE id = '$id'");
$data = mysqli_fetch_assoc($get_img);

if (file_exists("assets/" . $data['gambar'])) {
    unlink("assets/" . $data['gambar']);
}

mysqli_query($conn, "DELETE FROM bencana WHERE id = '$id'");

header("Location: kelolaBencana.php");
?>