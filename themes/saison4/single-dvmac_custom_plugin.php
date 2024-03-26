<?php get_header(); ?>

<section class="container-fluid">
    <div class="container">
        <h1>Nos médias</h1>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2 class="display-4 text-center"><?php the_title(); ?></h2>
                <div class="col-lg-3 mx-auto d-flex justify-content-center">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
                <!-- Texte -->
                <p class="fs-3"><?php the_content(); ?></p>
            <?php endwhile ?>
        <?php else : ?>
            <div>Pas de résultat</div>
        <?php endif ?>
    </div>
</section>

<?php get_footer(); ?>