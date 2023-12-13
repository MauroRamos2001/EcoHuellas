<?php
    require 'config/constants.php';

    $username_email = $_SESSION['signin-data']['username_email'] ?? null ;
    $password = $_SESSION['signin-data']['password'] ?? null ;

    unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Huellas</title>
    <link rel="shortcut icon" href="../img/Favicon.jpg" type="image/x-icon">
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
            <h2>Inicia Sesión</h2>
            <?php if(isset ($_SESSION['signup-success'])) :  ?>

                <div class="alert__message success">
                    <p>
                            <?= $_SESSION['signup-success'];
                                unset($_SESSION['signup-success']);
                            ?>
                        
                     </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>

            <div class="alert__message error">
                    <p>
                            <?= $_SESSION['signin'];
                                unset($_SESSION['signin']);
                            ?>
                        
                     </p>
                </div>
            <?php endif; ?>
                <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                    <input type="text" name="username_email" value="<?= ($username_email) ?>" placeholder="Nombre de Usuario">
                    <input type="password" name="password" value="<?php $password ?>" placeholder="Contraseña">
                    <button type="submit" name="submit" class="btn">Inicia sesión</button>
                    <!-- <small>¿No tienes una cuenta?<a href="signup.php">  Registrate</a></small> -->
                </form>
        </div>
        </section>

    
</body>
</html>