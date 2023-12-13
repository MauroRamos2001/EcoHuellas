<?php
    include 'partials/header.php';

    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        header('location: '. ROOT_URL .'admin/manager-users.php');
        die();
    }
?> 


    <section class="form__section">
        <div class="container form__section-container">
            <h2>Editar Usuario</h2>
            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
                <!-- cambiar depues para evitar mala practia -->
                <input type="hidden" value="<?= $user['id'] ?>" name="id"> 
                <!-- /////////////////////////////////////////// -->
                <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="Primer nombre">
                <input type="text" value="<?= $user['lastname']  ?>" name="lastname" placeholder="Segundo nombre">
                <select name="userrole">
                    <option value="0">Autor</option>
                    <option value="1">Admin</option>
                </select>
                <button type="submit" name="submit" class="btn">Editar Usuario</button>

            </form>
        </div>
        </section>
    <script src="../js/main.js"></script>
</body>
</html> 

