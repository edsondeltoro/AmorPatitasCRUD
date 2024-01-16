<?php
global $conn;
include('db.php');

if (isset($_POST['save_cat'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $query = "INSERT INTO gatos(name, image) VALUES ('$name', '$image')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query Failed.");
    }

    $token = bin2hex(random_bytes(16));
    $_SESSION['token'] = $token;
    setcookie('session_token', $token, time() + 3600, '/');
    $_SESSION['message'] = 'Gato guardado';
    $_SESSION['message_type'] = 'success';
    header('Location: tablagatos.php');

}