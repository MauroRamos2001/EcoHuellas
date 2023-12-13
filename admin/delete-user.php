<?php
require 'config/database.php';
session_start();

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Obtener usuario de la base de datos
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Asegurarse de que solo obtuvimos un usuario
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../img/' . $avatar_name; 
        // Eliminar imagen si está disponible
        if ($avatar_name && file_exists($avatar_path)) {
            unlink($avatar_path);
        }

        // Eliminamos la imagen de la base de datos segun el usario
        $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id='$id'";
        $thumbnails_result = mysqli_query($connection, $thumbnails_query);

        if (mysqli_num_rows($thumbnails_result) > 0) {
            while ($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
                $thumbnail_path = '../img/' . $thumbnail['thumbnail'];
                // eliminar miniatura de la carpeta de imágenes existe
                if (unlink($thumbnail_path)) {
                    unlink($thumbnail_path);
                }
            }
        }


        // Preparar para borrar el usuario de la base de datos
        $delete_query = "DELETE FROM users WHERE id=?";
        $delete_stmt = mysqli_prepare($connection, $delete_query);
        mysqli_stmt_bind_param($delete_stmt, 'i', $id);
        mysqli_stmt_execute($delete_stmt);

        if (mysqli_stmt_affected_rows($delete_stmt) > 0) {
            $_SESSION['delete-user-success'] = "El Usuario se ha eliminado exitosamente";
        } else {
            $_SESSION['delete-user'] = "No se encontró el usuario con el ID proporcionado.";
        }
        mysqli_stmt_close($delete_stmt); // Cerrar la sentencia preparada para eliminar
    } else {
        $_SESSION['delete-user'] = "El usuario no existe o no se pudo obtener.";
    }
    mysqli_stmt_close($stmt); // Cerrar la sentencia preparada para seleccionar

    // Redirigir a la página de administrar usuarios
    header('Location: ' . ROOT_URL . 'admin/manage-users.php');
    exit();
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>
    