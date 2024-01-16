<?php
// Inicia la sesión si no está iniciada.
session_start();

// Elimina la cookie 'session_token' del cliente.
if(isset($_COOKIE['session_token'])) {
    unset($_COOKIE['session_token']);
    setcookie('session_token', null, -1, '/');
}

// Elimina la variable de sesión 'token'.
if(isset($_SESSION['token'])) {
    unset($_SESSION['token']);
}

// Redirige al usuario a la página de inicio de sesión u otra página deseada.
header("Location: index.php");
exit;
?>
