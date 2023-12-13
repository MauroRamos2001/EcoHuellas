<?php
require 'config/database.php';
if (isset($_POST['submit'])) {
    // Obtener los datos actualizados del formulario
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // Verificar la entrada válida
    if (!$firstname || !$lastname) {
        $_SESSION['edit-user'] = "Entrada de formulario no válida en la página de edición.";
        header('Location: ' . ROOT_URL . 'admin/edit-user.php?id=' . $id);
        exit();
    } else {
        // Actualizar usuario
        $query = "UPDATE users SET firstname=?, lastname=?, is_admin=? WHERE id=? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssii', $firstname, $lastname, $is_admin, $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['edit-user-success'] = "Usuario $firstname $lastname actualizado con éxito.";
            } else {
                // No se actualizó ningún registro, posiblemente porque el usuario no existe o los datos son los mismos.
                $_SESSION['edit-user'] = "No se encontraron cambios para actualizar.";
            }
        } else {
            $_SESSION['edit-user'] = "Error al actualizar: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt); // Cerrar la sentencia preparada
    }
} 

// Redirigir de vuelta a la lista de usuarios
header('Location: ' . ROOT_URL . 'admin/manage-users.php');
exit();
?>
