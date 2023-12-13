<?php
    include 'partials/header.php';

    // Buscamos las coincidencias de pos en la base de datos
    $current_user_id = $_SESSION['user-id'];
    $query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
    $posts = mysqli_query($connection, $query);
?> 

<section class="dashboard">
            <?php if (isset($_SESSION['add-post-success'])) : ?>
                    <div class="alert__message success container">
                            <p>
                                <?= $_SESSION['add-post-success'];
                                unset($_SESSION['add-post-success']);
                                ?>
                            </p>
                    </div>
                    <?php elseif (isset($_SESSION['edit-post-success'])) : ?>
                    <div class="alert__message success container">
                            <p>
                                <?= $_SESSION['edit-post-success'];
                                unset($_SESSION['edit-post-success']);
                                ?>
                            </p>
                    </div>
                    <?php elseif (isset($_SESSION['delete-post-success'])) : ?>
                    <div class="alert__message success container">
                            <p>
                                <?= $_SESSION['delete-post-success'];
                                unset($_SESSION['delete-post-success']);
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

                    <li><a href="index.php" class="active"><i class="fi fi-rr-edit"></i>
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
  
                    <li><a href="manage-categories.php"><i class="fi fi-rr-ballot"></i>
                    <h5>Gestionar Categoria</h5>
                    </a>
                    </li>
                    <?php endif ?>
                </ul>
    </aside>

        <main>
            <h2>Administrar Publicación</h2>
            <?php if(mysqli_num_rows($posts) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                        <?php 
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_resul = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_resul);      
                        ?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL  ?>admin/edit-post.php?id=<?= $post['id']?>" class="btn sm">Editar</a></td>
                        <td><a href="<?= ROOT_URL  ?>admin/delete-post.php?id=<?= $post['id']?>" class="btn sm danger">Eliminar</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else :  ?>
                <div class="alert__message error"> <?= "No se han encontrado post" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>


<script src="../js/main.js"></script>
</body>
</html>