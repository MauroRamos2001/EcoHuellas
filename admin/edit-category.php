<?php
    include 'partials/header.php';

    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


        $query = "SELECT * FROM categories WHERE id=$id";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) == 1) {
            $category = mysqli_fetch_assoc($result);
        }

    } else {
        header('location : ' . ROOT_URL . 'admin/manager-categories');
        die();
    }
?> 

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Editar categoría</h2>
            <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($category['title']) ?>" placeholder="Titulo">
                <textarea rows="30" name="description" placeholder="Descripción"><?= htmlspecialchars($category['description']) ?></textarea>
                <button type="submit" name="submit" class="btn">Actualizar categoría</button>
            </form>
        </div>
        </section>

 
