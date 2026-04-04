<?php
session_start();
include 'config.php';

if (isset($_POST['id']) && isset($_POST['nominal'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nominal = (int)$_POST['nominal'];

    $sql = "UPDATE bencana SET terkumpul = terkumpul + $nominal WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>