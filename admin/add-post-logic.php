<?php 

require 'config/database.php';

if (isset($_POST['submit'])) {
    // Obtenemos el ID del autor de la sesión.
    $author_id = $_SESSION['user-id'];
    // Sanitizamos y asignamos las variables.
    $title = filter_var($_POST["title"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST["body"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured == 1 ?: 0;
    
    // Validamos los datos del formulario.
    if (empty($title)) {
        $_SESSION['add-post'] = "Ingrese el título de la publicación";
    } elseif ((!$category_id)) {
        $_SESSION['add-post'] = "Seleccione la categoría de la publicación";
    } elseif ((!$body)) {
        $_SESSION['add-post'] = "Ingrese el cuerpo de la publicación";
    } elseif ((!$thumbnail['name'])) {
        $_SESSION['add-post'] = "Elija la miniatura de la publicación";
    } else {
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tpm_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../img/' . $thumbnail_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
        if(in_array($extension, $allowed_files)) {
            // No deve de ser mayor a 2mb o el espacio designado
            if($thumbnail['size'] < 2_000_000) {
                move_uploaded_file($thumbnail_tpm_name, $thumbnail_destination_path);
            }else {
                $_SESSION['add-post'] = "Archivo demasiado grande, debe ser menor a 2 MB";
            }
        } else {
            $_SESSION['add-post'] = "Solo se permiten archivos PNG, JPG y JPEG";
        }
    }

    // Se redirige si se tiene algun problema al agregar el post
    if(isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
        if($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES
        ('$title', '$body', '$thumbnail_name', '$category_id', '$author_id', '$is_featured')";        
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "Nuevo Post se ha agregado correctamente";
            header('location:' . ROOT_URL . 'admin/');
            die();
        }
    }
}
header('location: ' . ROOT_URL .'admin/add-post.php');
die();