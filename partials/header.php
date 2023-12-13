<?php
    require 'config/database.php';

    // Usuario actual de la base de datos
    if(isset($_SESSION['user-id'])) {
        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT avatar FROM users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
    }
?>

<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Huellas</title>
    <link rel="shortcut icon" href="<?= ROOT_URL ?>../img/Favicon.jpg" type="image/x-icon">
    <!-- Se agrega  el enlace a la hoja de estilos  -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/css/Style.css">

    <!-- flaticon enlace--> 
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>

    <!-- Estilo de GOOGLE FONTS (Montserrat)-->
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@300&family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

</head>
<body>

    <!-- INICIO DEL NAV -->
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">Eco Huellas</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">Acerca de Nosotros </a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Servicios</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contactos</a></li>
                <?php if(isset($_SESSION['user-id'])) : ?>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'img/' . $avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Panel</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                <?php else :  ?>
                <li><a href="<?= ROOT_URL ?>signin.php">Iniciar sesión</a></li>
                <?php endif?>
            </ul>
            <button id="open__nav-btn"><i class="fi fi-rr-settings-sliders"></i></button>
            <button id="close__nav-btn"><i class="fi fi-br-cross"></i></button>
        </div>
    </nav>

                                     <!-- FIN DE NAV -->