<?php
global $conn;
include('db.php');

if (isset($_POST['save_dog'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $query = "INSERT INTO perros(name, image) VALUES ('$name', '$image')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query Failed.");
    }

    $_SESSION['message'] = 'Perro guardado';
    $_SESSION['message_type'] = 'success';
    $token = bin2hex(random_bytes(16));
    $_SESSION['token'] = $token;
    setcookie('session_token', $token, time() + 3600, '/');
    header('Location: tablaperros.php');

}


