<?php
    include 'partials/header.php';

    $current_admin_id = $_SESSION['user-id'];

    $query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
    $users = mysqli_query($connection, $query);
?> 

<section class="dashboard">
        <?php if (isset($_SESSION['add-user-success'])) : ?>
                <div class="alert__message success container">
                        <p>
                             <?= $_SESSION['add-user-success'];
                            unset($_SESSION['add-user-success']);
                            ?>
                        </p>
                 </div>
            <?php endif ?>
            <?php if (isset($_SESSION['edit-user-success'])) : ?>
                <div class="alert__message success container">
                        <p>
                             <?= $_SESSION['edit-user-success'];
                            unset($_SESSION['edit-user-success']);
                            ?>
                        </p>
                 </div>
            <?php endif ?>
            <?php if (isset($_SESSION['edit-user'])) : ?>
                <div class="alert__message error container">
                        <p>
                             <?= $_SESSION['edit-user'];
                            unset($_SESSION['edit-user']);
                            ?>
                        </p>
                 </div>
            <?php endif ?>
            <?php if (isset($_SESSION['delete-user'])) : ?>
                <div class="alert__message error container">
                        <p>
                             <?= $_SESSION['delete-user'];
                            unset($_SESSION['delete-user']);
                            ?>
                        </p>
                 </div>
            <?php endif ?>
            <?php if (isset($_SESSION['delete-user-success'])) : ?>
                <div class="alert__message success container">
                        <p>
                             <?= $_SESSION['delete-user-success'];
                            unset($_SESSION['delete-user-success']);
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

                    <li><a href="manage-users.php" class="active"><i class="fi fi-rr-users"></i>
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

        <?php if(mysqli_num_rows($users) > 0) : ?>
            <h2>Administrar Usuarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                        <tr>
                            <td><?= "{$user['firstname']} {$user['lastname']}"?></td>
                            <td><?= "{$user['username']}" ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Editar</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Eliminar</a></td>
                            <td> <?= $user['is_admin'] ? 'Sí' : 'No' ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"> <?= "No se han encontrado usuarios" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

<script src="./main.js"></script>
</body>
</html>