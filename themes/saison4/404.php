<?php get_header(); ?>

<section class="container min-vh-100 py-5">

    <h1 class="py-5">Page 404</h1>
    <h2 class="text-center">Cette page est introuvable mais voici nos derniers articles</h2>
    <div class="row">

        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,

        );
        $query = new WP_Query($args);

        ?>

        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-xs-10 col-md-6 g-4">

                    <div class="card">
                        <!-- Respectez le format lors du choix des images (portrait / paysage) -->
                        <div class="card-header">
                            <h2 class="text-center"><span class="text-light- fs-4"><?php the_ID(); ?></span>&nbsp;-&nbsp;<?php the_title(); ?>
                            </h2>
                        </div>
                        <div class="card-body">
                            <!-- Img Article -->
                            <a href="<?php the_permalink() ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'img-thumbnail mx-auto d-block']); ?>
                            </a>
                            <!-- Text -->
                            <p class="card-text"><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>


            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>

    </div>
</section>
<?php get_footer(); ?>