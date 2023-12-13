<?php
    require '../partials/header.php';

    // UVerificar si es un admin
    if(!isset($_SESSION['user-id'])) {
       header('locaition '. ROOT_URL . 'signin.php');
       die();
    }
?>
