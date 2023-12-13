<?php
    require_once 'config/constants.php';


    // Coneccion a la base d datos
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }

