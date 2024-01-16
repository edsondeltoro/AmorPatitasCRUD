<?php
global $conn;
include('db.php');

if (isset($_POST['save_inact'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $type = $_POST['type'];
    $query = "INSERT INTO inactivos(name, type, image) VALUES ('$name', '$type', '$image')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die("Query Failed.");
    }

    $token = bin2hex(random_bytes(16));
    $_SESSION['token'] = $token;
    setcookie('session_token', $token, time() + 3600, '/');
    $_SESSION['message'] = 'Mascota guardada';
    $_SESSION['message_type'] = 'success';
    header('Location: tablainactivos.php');

}