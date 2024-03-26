<?php get_header(); ?>

<section class="container">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h1><?php the_title() ?></h1>

            <div class="article_img col-8 col-md-4 col-lg-3 d-flex justify-content-center mx-auto">
                <?php
                if ($thumbnail_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium'))
                    $thumbnail_src = $thumbnail_html[0];
                ?>
                <a href="<?php the_permalink(); ?>">
                    <img class="img-fluid img-thumbnail" src="<?php echo $thumbnail_src; ?>" alt="">
                </a>

            </div>


    <?php endwhile;
    endif; ?>
    <!-- Pagination article suivant / precedent -->
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <div class="">
                <?php previous_post_link('Article Précédent<br>%link'); ?>
            </div>
            <div class="">
                <?php next_post_link('Article Suivant<br>%link'); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>