<?php
    include 'partials/header.php';


    // recuperar los datos del formulario si hubo un error
    $firstname = $_SESSION['add-user-data'] ['firstname'] ?? null;
    $lastname = $_SESSION['add-user-data'] ['lastname'] ?? null;
    $username = $_SESSION['add-user-data'] ['username'] ?? null;
    $email = $_SESSION['add-user-data'] ['email'] ?? null;
    $createpassword = $_SESSION['add-user-data'] ['createpassword'] ?? null;
    $confirmpassword = $_SESSION['add-user-data'] ['confirmpassword'] ?? null;


    // Eliminara la sesion
    unset($_SESSION['add-user-data']);

?> 

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Añadir Usuario</h2>
            <?php if(isset($_SESSION['add-user'])) :  ?>
                <div class="alert__message error">
                <p>
                   <?= $_SESSION['add-user'];
                   unset($_SESSION['add-user']);
                   ?>
                </p>
            </div>
            <?php endif; ?>
            <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="Primer nombre">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Segundo nombre">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Nombre de Usuario">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Correo electrónico">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Contraseña">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirmar contraseña">
                <select name="userrole">
                    <option value="0">Autor</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form__control">
                    <label for="avatar">Selecciona una imagen </label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Añadir Usuario</button>
            </form>
        </div>
    </section>
    <script src="../js/main.js"></script>
</body>
</html> 
