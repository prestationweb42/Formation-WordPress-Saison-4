<?php get_header(); ?>

<section class="container-fluid min-vh-100">
    <div class="container">
        <h1>Nos Médias</h1>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article_img col-8 d-flex justify-content-evenly align-items-center mx-auto mb-1">

            <a href="<?php the_permalink() ?>" target="_blank">
                <div class="img-fluid img-thumbnail">
                    <?php echo get_the_post_thumbnail($page->ID, 'medium'); ?>
                </div>
            </a>
            <h2><?php the_title(); ?></h2>
            <?php $dvmac_meta_an = get_post_meta($post->ID, '_media_meta_an', true); ?>
            <p class="mb-0"><?php echo $dvmac_meta_an ?></p>
        </div>

        <?php endwhile ?>
        <?php else : ?>
        <div>Pas de résultat</div>
        <?php endif ?>
        <!-- Pagination article suivant / precedent -->
        <!-- fonction Pagination apres la boucle -->
        <?php the_posts_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>