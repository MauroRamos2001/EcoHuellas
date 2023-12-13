<?php 
    require 'config/database.php';

    if(isset($_POST['submit'])){
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$title) {
            $_SESSION['add-category'] = "Introduce el título";
        } elseif (!$description) {
            $_SESSION['add-category'] = "Introduce la descripcion";
        }


        // redirigir nuevamente para agregar la página de categoría con datos del formulario si hubo una entrada no válida
        if(isset($_SESSION['add-category'])) {
            $_SESSION['add-category-data'] = $_POST;
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            // Insertamos categoria en la base de datos
            $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
            $result = mysqli_query($connection, $query);
            if(mysqli_errno($connection)){
                $_SESSION['add-category'] = "No se pudo agregar categoría";
                header('location: ' . ROOT_URL . 'admin/add-category.php');
                die();
            } else {
                $_SESSION['add-categoria-success'] = "Categoría $title agregada correctamente";
                header('location: ' . ROOT_URL . 'admin/manage-categories.php');
                die();
            }
        }
    }
?>

