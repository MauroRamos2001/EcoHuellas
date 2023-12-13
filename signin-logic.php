<?php
    require 'config/database.php';

    if(isset($_POST['submit'])) {
        //Obtener los datos del post
        $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$username_email) {
            $_SESSION['signin'] = "Se requiere nombre de usuario o correo electrónico";
        } elseif (!$password) {
            $_SESSION['signin'] = "Se requiere una contraseña";
        } else {
            // Se busca el usuario en la base de datos
            $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
            $fetch_user_result = mysqli_query($connection, $fetch_user_query);

            if(mysqli_num_rows($fetch_user_result) == 1) {
                // Convertir el registro
                $user_record = mysqli_fetch_assoc($fetch_user_result);
                $db_password = $user_record['password'];
                // Compara la contraseña en la base de datos
                if(password_verify($password, $db_password)){
                    // Configurar la sesión para accesos
                    $_SESSION['user-id'] = $user_record['id'];
                    // Establecemos sesión si el usuario es admin
                    if($user_record['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }

                    // Si es solo usuario
                    header('location: '. ROOT_URL . 'admin/');
                    exit;
                } else {
                    $_SESSION['signin'] = "Oops! Parece que hubo un problema con tus datos de acceso. Por favor verifica tu información y prueba de nuevo.";
                }
            } else {
                $_SESSION['signin'] = "Usuario no encontrado";
            }
        }
        
        // Si hay algún problema, se redirige
        if(isset($_SESSION['signin'])) {
            $_SESSION['signin-data'] = $_POST;
            header('location: '. ROOT_URL . 'signin.php');
            exit();     
        }
    } else {
        header('location: '. ROOT_URL . 'signin.php');
        die();
    }
?>
