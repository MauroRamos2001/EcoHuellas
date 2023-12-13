<?php
    require 'config/database.php';

    // Datos del formulario si se registran
    if (isset($_POST['submit'])) {
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];

        // Validar los campos...
        if (!$firstname) {
            $_SESSION['signup'] = "Por favor escribe tu primer nombre";
        } elseif (!$lastname) {
            $_SESSION['signup'] = "Por favor escribe tu apellido";
        } elseif (!$username) {
            $_SESSION['signup'] = "Por favor escribe tu nombre de usuario";
        } elseif (!$email) {
            $_SESSION['signup'] = "Por favor escribe un correo válido";
        } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
            $_SESSION['signup'] = "La contraseña debería ser de 8 o más caracteres";
        } elseif (!$avatar['name']) {
            $_SESSION['signup'] = "Por favor selecciona una imagen";
        } else {
            if ($createpassword !== $confirmpassword) {
                $_SESSION['signup'] = "Las contraseñas no coinciden";
            } else {
                $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

                $user_check_query = "SELECT * FROM users WHERE username=? OR email=?";
                $stmt = mysqli_prepare($connection, $user_check_query);
                mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['signup'] = "El usuario o el correo electrónico ya existe";
                } else {
                    // Cargar imagen
                    $allowed_files = ['png', 'jpg', 'jpeg'];
                    $file_extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                    if (in_array(strtolower($file_extension), $allowed_files)) {
                        if ($avatar['size'] < 1000000) {
                            $time = time();
                            $new_avatar_name = $time . '_' . bin2hex(random_bytes(8)) . '.' . $file_extension;
                            $avatar_tmp_name = $avatar['tmp_name'];
                            $avatar_destination_path = 'img/' . $new_avatar_name;

                            if (move_uploaded_file($avatar_tmp_name, $avatar_destination_path)) {
                                $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES (?, ?, ?, ?, ?, ?, 0)";
                                $stmt = mysqli_prepare($connection, $insert_user_query);
                                mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $username, $email, $hashed_password, $new_avatar_name);

                                if (mysqli_stmt_execute($stmt)) {
                                    $_SESSION['signup-success'] = "Registro exitoso. Por favor inicia sesión";
                                    header('Location: '. ROOT_URL . 'signin.php');
                                    exit();
                                } else {
                                    $_SESSION['signup'] = "Hubo un error al registrar el usuario.";
                                }
                            } else {
                                $_SESSION['signup'] = "Error al subir el archivo.";
                            }
                        } else {
                            $_SESSION['signup'] = "El archivo es demasiado grande, debe ser menor a un megabyte";
                        }
                    } else {
                        $_SESSION['signup'] = "El formato del archivo debe ser jpg, png o jpeg";
                    }
                }
            }
        }

        // Volver a la página de registro si hay un problema
        if (isset($_SESSION['signup'])) {
            $_SESSION['signup-data'] = $_POST;
            header('Location: ' . ROOT_URL . 'signup.php');
            exit();
        }
    } else {
        // Si no se completan los datos, se regresa al formulario de registro
        header('Location: ' . ROOT_URL . 'signup.php');
        exit();
    }
?>
