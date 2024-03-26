<?php get_header(); ?>
<!-- <?php
echo '<pre>';
var_dump($wp_query)
?> -->

<section class="container-fluid">
    <div class="container">

        <h4 class="text-center py-5">Styles Musicaux</h4>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php the_title() ?>
        <div class="img-fluid img-thumbnail">
            <a href="<?php the_permalink() ?>" target="_blank">

                <?php echo get_the_post_thumbnail($page->ID, 'medium'); ?>
            </a>
        </div>

        <?php endwhile;
        endif; ?>
    </div>
</section>

<?php get_footer(); ?>