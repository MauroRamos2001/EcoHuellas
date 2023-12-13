<?php
include 'partials/header.php';

// Buscamos las categorías en la base de datos
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);

// 
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>

<section class="form__section">

    <div class="container form__section-container">
        <h2>Editar publicación</h2>

        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Titulo" required>
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $post['category_id']) ? 'selected' : '' ?>>
                        <?= $category['title'] ?>
                    </option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Descripción" required><?=$post['body']?></textarea>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" <?= ($post['is_featured'] == 1) ? 'checked' : '' ?>>
                <label for="is_featured">Destacados</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Cambiar Imagen</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Actualizar Post</button>
        </form>
    </div>
</section>

<script src="../js/main.js"></script>
</body>
</html>
