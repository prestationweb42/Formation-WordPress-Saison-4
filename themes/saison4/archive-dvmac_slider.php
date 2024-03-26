<?php get_header(); ?>

<section class="container-fluid">
    <div class="container">
        <h1>Nos Items Slider</h1>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="article_img col-8 col-md-6 d-flex justify-content-evenly align-items-center mx-auto mb-1">
            <a href="<?php the_permalink(); ?>" target="_blank">
                <div class="img-fluid img-thumbnail">
                    <?php echo get_the_post_thumbnail($page->ID, 'medium'); ?>
                </div>
            </a>
            <h2><?php the_title() ?></h2>

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
    </div>
</section>
<?php get_footer(); ?>