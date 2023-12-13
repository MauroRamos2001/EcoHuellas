<?php 
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured == 1 ? 1 : 0;

    if (!$title || !$category_id || !$body) {
        $_SESSION['edit-post'] = "No se pudo actualizar la publicación. Datos de formato no válidos en la página de edición de publicación.";
    } else {
        if ($thumbnail['name']) {
            $previous_thumbnail_name = '../img/' . $previous_thumbnail_name;
            if ($previous_thumbnail_name) {
                unlink($previous_thumbnail_name);
            }

            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $destination_path = '../img/' . $thumbnail_name;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($thumbnail_name, PATHINFO_EXTENSION);

            if (in_array($extension, $allowed_files) && $thumbnail['size'] < 2000000) {
                move_uploaded_file($thumbnail_tmp_name, $destination_path);
            } else {
                $_SESSION['edit-post'] = "No se pudo actualizar la publicación. La imagen debe ser en formato jpg, png o jpeg, y su tamaño no puede exceder los 2 MB.";
            }
        }
    }

    if (!isset($_SESSION['edit-post'])) {
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        $thumbnail_to_insert = isset($thumbnail_name) ? $thumbnail_name : $previous_thumbnail_name;

        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-post-success'] = "Post actualizado correctamente";
        }
    }
}

header('location:' . ROOT_URL . 'admin/');
die();
?>
