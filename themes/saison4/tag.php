<?php get_header(); ?>
<h6>Articles -> tag.php</h6>
<h1>Nos archives de l'étiquette <?php single_cat_title('') ?>
</h1>
<!-- Boucle affichage des articles -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/article'); ?>
<?php endwhile;
endif; ?>
<!-- fonction Pagination apres la boucle -->
<?php the_posts_pagination(); ?>
<?php get_footer(); ?>