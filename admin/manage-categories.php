<?php
   include 'partials/header.php';

    // Buscar categorias en la base de datos
    $query = "SELECT * FROM categories ORDER BY  title";
    $categories = mysqli_query($connection, $query);
?> 

    <section class="dashboard">
        <?php if (isset($_SESSION['add-categoria-success'])) : ?>
                    <div class="alert__message success container">
                            <p>
                                <?= $_SESSION['add-categoria-success'];
                                unset($_SESSION['add-categoria-success']);
                                ?>
                            </p>
                    </div>
                <?php elseif (isset($_SESSION['add-category'])) : ?>
                    <div class="alert__message error container">
                            <p>
                                <?= $_SESSION['add-category'];
                                unset($_SESSION['add-category']);
                                ?>
                            </p>
                    </div>
                    <?php elseif (isset($_SESSION['edit-category'])) : ?>
                    <div class="alert__message error container">
                            <p>
                                <?= $_SESSION['edit-category'];
                                unset($_SESSION['edit-category']);
                                ?>
                            </p>
                    </div>
                    <?php elseif (isset($_SESSION['edit-category-success'])) : ?>
                    <div class="alert__message success container">
                            <p>
                                <?= $_SESSION['edit-category-success'];
                                unset($_SESSION['edit-category-success']);
                                ?>
                            </p>
                    </div>
                    <?php elseif (isset($_SESSION['delete-cagory-success'])) : ?>
                    <div class="alert__message success container">
                            <p>
                                <?= $_SESSION['delete-cagory-success'];
                                unset($_SESSION['delete-cagory-success']);
                                ?>
                            </p>
                    </div>
                <?php endif ?>
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="fi fi-br-angle-small-right"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="fi fi-br-angle-small-left"></i></button>
            <aside >
                <ul>
                    <li><a href="add-post.php"><i class="fi fi-rr-pencil"></i>
                        <h5>Añadir Publicación</h5>
                        </a>
                    </li>

                    <li><a href="index.php"><i class="fi fi-rr-edit"></i>
                    <h5>Administrar Publicación</h5>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['user_is_admin'])) : ?>

                    <li><a href="add-user.php"><i class="fi fi-rr-user "></i>
                    <h5>Añadir usuario</h5>
                        </a>
                    </li>

                    <li><a href="manage-users.php"><i class="fi fi-rr-users"></i>
                    <h5>Gestionar usuario</h5>
                    </a>
                    </li>

                    <li><a href="add-category.php"><i class="fi fi-rr-list"> </i>
                    <h5>Añadir categoriá</h5>
                   </a>
                    </li>

                    <li><a href="manage-categories.php" class="active"><i class="fi fi-rr-ballot"></i>
                    <h5>Gestionar Categoria</h5>
                    </a>
                    </li>
                    <?php endif ?>
                </ul>
    </aside>
            <main>
            <?php if(mysqli_num_rows($categories) > 0) : ?>
                <h2>Administrar categoriás</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                        <tr>
                            <td><?= $category['title'] ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Editar</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Eliminar</a></td>
                        </tr>
                    <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                <div class="alert__message error"> <?= "No se han encontrado Categorias" ?></div>
                <?php endif ?>
            </main>
        </div>
</section>
<script src="../js/main.js"></script>
</body>
</html>