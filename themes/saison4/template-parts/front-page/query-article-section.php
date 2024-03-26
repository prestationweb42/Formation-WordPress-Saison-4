<?php
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page'    => 2,
    'order'          => 'ASC',
    // 'order'          => 'DESC',
);

// The Query.
$the_query = new WP_Query($args);

if ($the_query->have_posts()) : ?>
<section id="section_articles" class="min-vh-100 d-flex align-items-center py-sm-5 py-lg-0">
    <div class="container h-auto">
        <div class="row">
            <!-- the loop -->
            <?php
                while ($the_query->have_posts()) :
                    $the_query->the_post();
                ?>
            <!-- pagination here -->
            <div class="col-xs-10 col-md-6">
                <div class="card mb-5">
                    <div class="card-header">
                        <h2 class="text-center"><span
                                class="text-light- fs-4"><?php the_ID(); ?></span>&nbsp;-&nbsp;<?php the_title(); ?>
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
                    <div class="px-3 pb-3 card-header">
                        <?php echo display_attributs_articles(
                                    get_the_date(),
                                    get_the_category_list(', '),
                                    get_the_tag_list('', ', '),
                                    get_the_author(),
                                    get_comments_number(', pas de commentaire'),
                                )
                                ?>
                    </div>
                </div>
            </div>

            <!-- end of the loop -->
            <?php endwhile; ?>
        </div>
    </div>
</section>


<?php wp_reset_postdata(); ?>

<?php else : ?>
<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>