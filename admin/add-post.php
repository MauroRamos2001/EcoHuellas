<?php
    include 'partials/header.php';

    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);

    // recuperar datos si el formulario no era válido
    $title =$_SESSION['add-post-data']['title'] ?? null;
    $body =$_SESSION['add-post-data']['body'] ?? null;

    // eliminar de la sección de datos
    unset($_SESSION['add-post-data']);
?> 

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Añadir publicación</h2>

            <?php if(isset($_SESSION['add-post'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION ['add-post'];
                        unset($_SESSION['add-post']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-post-logic.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" value="<?= $title ?>" placeholder="Titulo">
                    <select name="category">
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                        <?php endwhile; ?>
                    </select>

                    <textarea rows="10" name="body" placeholder="Descripción"> <?= $body ?></textarea>

                    <?php if(isset($_SESSION['user_is_admin'])) : ?>
                    <div class="form__control inline">
                        <input type="checkbox" name="is_featured" value="1" id="is__featured" checked>
                        <label for="is__featured" >Destacados</label>
                    </div>
                    <?php endif ?>

                    <div class="form__control">
                        <label for="thumbnail">Agrega Imagen</label>
                        <input type="file" name="thumbnail" id="thumbnail">
                    </div>

                    <button type="submit" name="submit" class="btn">Agrega Post</button>
                </form>
    </section>
                
                <script src="../js/main.js"></script>
</body>
</html>