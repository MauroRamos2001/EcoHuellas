<?php
    include 'partials/header.php';

    $featured_query = "SELECT * FROM posts WHERE is_featured=1";
    $featured_result = mysqli_query($connection, $featured_query);
    $featured = mysqli_fetch_assoc($featured_result);

?>  
<?php if(mysqli_num_rows($featured_result) == 1) : ?>
        <section class="featured">
            <div class="container featured__container">
                <div class="post__thumbnail">
                    <img src="./img/<?= $featured['thumbnail']?>">
                </div>
                <div class="post__info">
                    <?php
                        $category_id = $featured['category_id'];
                        $category_query = "SELECT * FROM categories WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <a href="<? ROOT_URL ?>category-post.php?id=<? $category['id'] ?>" 
                    class="category__button"><?= $category['title']?></a>
                    <h2 class="post__title"><?= $featured['title']?></h2>
                    <p class="post__body">  
                        <?= substr( $featured['body'], 0 , 300)?>...
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./img/avatar12.jpg">
                        </div>
                        <div class="post__author-info"> 
                            <h5>By: Eco Huellas</h5>
                            <small>Julio 10 2023 - 07:23</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif ?>

                             <!-- FINAL DEL POUST PRINCIPAL-->

                             
    <!-- <section class="posts">
        <div class="container posts__container">

            <article class="post">
                <div class="post__thumbnail">
                    <img src="./img/blog101.jpg">
                </div>
                    <div class="post__info">
                        <a href="category-posts.html" class="category__button">Información</a>
                        <h3 class="post__title"><a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis.</a></h3>
                        <p class="post__body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi dicta error omnis unde perspiciatis magni in, voluptates harum repellendus et suscipit enim? Porro ut enim eos libero. Assumenda, deserunt reiciendis.
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./img/avatar2.jpg">
                            </div> 
                            <div class="post__author-info">
                                <h5>By: Eco Huellas</h5>
                                <small>Julio 11 2023 - 10:34</small>
                            </div>
                        </div>
                    </div>
            </article>
            
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./Img/blog3.jpg">
                </div>
                    <div class="post__info">
                        <a href="category-posts.html" class="category__button">Información</a>
                        <h3 class="post__title"><a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis.</a></h3>
                        <p class="post__body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi dicta error omnis unde perspiciatis magni in, voluptates harum repellendus et suscipit enim? Porro ut enim eos libero. Assumenda, deserunt reiciendis.
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./Img/avatar4.jpg">
                            </div> 
                            <div class="post__author-info">
                                <h5>By: Eco Huellas</h5>
                                <small>Julio 11 2023 - 10:34</small>
                            </div>
                        </div>
                    </div>
            </article>
            
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./Img/blog11.jpg">
                </div>
                    <div class="post__info">
                        <a href="category-posts.html" class="category__button">Información</a>
                        <h3 class="post__title"><a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis.</a></h3>
                        <p class="post__body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi dicta error omnis unde perspiciatis magni in, voluptates harum repellendus et suscipit enim? Porro ut enim eos libero. Assumenda, deserunt reiciendis.
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./Img/avatar5.jpg">
                            </div> 
                            <div class="post__author-info">
                                <h5>By: Eco Huellas</h5>
                                <small>Julio 11 2023 - 10:34</small>
                            </div>
                        </div>
                    </div>
            </article>

            <article class="post">
                <div class="post__thumbnail">
                    <img src="./Img/blog5.jpg">
                </div>
                    <div class="post__info">
                        <a href="category-posts.html" class="category__button">Información</a>
                        <h3 class="post__title"><a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis.</a></h3>
                        <p class="post__body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi dicta error omnis unde perspiciatis magni in, voluptates harum repellendus et suscipit enim? Porro ut enim eos libero. Assumenda, deserunt reiciendis.
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./Img/avatar6.jpg">
                            </div> 
                            <div class="post__author-info">
                                <h5>By: Eco Huellas</h5>
                                <small>Julio 11 2023 - 10:34</small>
                            </div>
                        </div>
                    </div>
            </article>

            <article class="post">
                <div class="post__thumbnail">
                    <img src="./Img/blog6.jpg">
                </div>
                    <div class="post__info">
                        <a href="category-posts.html" class="category__button">Información</a>
                        <h3 class="post__title"><a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis.</a></h3>
                        <p class="post__body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi dicta error omnis unde perspiciatis magni in, voluptates harum repellendus et suscipit enim? Porro ut enim eos libero. Assumenda, deserunt reiciendis.
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./Img/avatar7.jpg">
                            </div> 
                            <div class="post__author-info">
                                <h5>By: Eco Huellas</h5>
                                <small>Julio 11 2023 - 10:34</small>
                            </div>
                        </div>
                    </div>
            </article>

            <article class="post">
                <div class="post__thumbnail">
                    <img src="./Img/blog7.jpg">
                </div>
                    <div class="post__info">
                        <a href="category-posts.html" class="category__button">Información</a>
                        <h3 class="post__title"><a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis.</a></h3>
                        <p class="post__body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi dicta error omnis unde perspiciatis magni in, voluptates harum repellendus et suscipit enim? Porro ut enim eos libero. Assumenda, deserunt reiciendis.
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./Img/avatar8.jpg">
                            </div> 
                            <div class="post__author-info">
                                <h5>By: Eco Huellas</h5>
                                <small>Julio 11 2023 - 10:34</small>
                            </div>
                        </div>
                    </div>
            </article>
        </div>
    </section> -->

    <!-- FINAL DE LOS POST -->

    <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">CATEGORIA</a>
            <a href="" class="category__button">CATEGORIA</a>
            <a href="" class="category__button">CATEGORIA</a>
            <a href="" class="category__button">CATEGORIA</a>
            <a href="" class="category__button">CATEGORIA</a>
            <a href="" class="category__button">CATEGORIA</a>
        </div>
    </section>


<?php
    include 'partials/footer.php'
?>