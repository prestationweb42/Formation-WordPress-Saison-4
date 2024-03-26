<?php get_header(); ?>
<section class="container">
    <h1 class="text-center">Nos articles</h1>
    <!-- Boucle affichage des articles -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/articles/article'); ?>
    <?php endwhile;
    endif; ?>
    <!-- fonction Pagination apres la boucle -->
    <?php the_posts_pagination(); ?>
    <!-- fonction Pagination avec le fonction paginate_links() -->
    <div class="d-flex align-items-center" id="custom_pagination">
        <?php
        global $wp_query;
        $big = 999999999; // need an unlikely integer
        $translated = __('Page', 'mytextdomain'); // Supply translatable string
        ?>
        <div class="custom_links_pagination col-6 mx-auto">
            <?php
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
            ));
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>