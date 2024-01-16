<?php
include("db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM perros WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query Failed.");
    }

    $token = bin2hex(random_bytes(16));
    $_SESSION['token'] = $token;
    setcookie('session_token', $token, time() + 3600, '/');
    $_SESSION['message'] = 'La mascota se eliminó';
    $_SESSION['message_type'] = 'danger';
    header('Location: tablaperros.php');
}

?>
