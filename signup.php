<?php
    require 'config/constants.php';

    //Regresar los datos si hubo un registro 
    $firstname = $_SESSION['signup-data']['firstname'] ?? null;
    $lastname = $_SESSION['signup-data']['lastname'] ?? null;
    $username = $_SESSION['signup-data']['username'] ?? null;
    $email = $_SESSION['signup-data']['email'] ?? null;
    $createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
    $confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
    
    // Elminamos la seccion 
    unset ($_SESSION['signuuo-data']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Huellas</title>
    <link rel="shortcut icon" href="<?= ROOT_URL ?>./img/Favicon.jpg" type="image/x-icon">
    <!-- Se agrega  el enlace a la hoja de estilos  -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>./css/Style.css">

    <!-- flaticon enlace-->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css'>

    <!-- Estilo de GOOGLE FONTS (Montserrat)-->
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@300&family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

</head>
<body>

    <section class="form__section">
    <div class="container form__section-container">
        <h2>Registrarse</h2>

        <?php if(isset($_SESSION['signup'])): ?> 
                <div class="alert__message error">
                    <p>
                         <?= $_SESSION['signup'];
                        unset($_SESSION['signup']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST" >
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="Primer nombre">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Segundo nombre">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Nombre de Usuario">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Correo electrónico">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Contraseña">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirmar contraseña">
                <div class="from__control">
                    <label for="avatar">Selecciona una imagen </label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn" >Registrarse</button>
                <small>¿Ya tienes una cuenta?<a href="signin.php">  Inicia Sesión</a></small>
            </form>
    </div>
    </section>
</body>
</html>