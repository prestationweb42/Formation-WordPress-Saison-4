<?php
$args = array(
    'post_type'      => 'dvmac_custom_plugin',
    'post_status'    => 'publish',
    'posts_per_page'    => 4,
    'order'          => 'rand',
);

// The Query.
$the_media_query = new WP_Query($args);

if ($the_media_query->have_posts()) : ?>
<section id="section_articles" class="min-vh-100 d-flex align-items-center py-sm-5 py-lg-0">
    <div class="container h-auto">
        <div class="row">
            <!-- the loop -->
            <?php
                while ($the_media_query->have_posts()) :
                    $the_media_query->the_post();
                ?>
            <!-- Card here -->
            <div class="col-xs-10 col-md-6 col-lg-3">
                <div class="card mb-5 min-height-370">
                    <div class="card-body">
                        <!-- Img Article -->
                        <a href="<?php the_permalink() ?>">
                            <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                        </a>
                        <!-- Text -->
                    </div>
                    <div class="card-header">
                        <!-- Retrieve Artist Name -->
                        <?php $dvmac_meta_name_artist = get_post_meta(get_the_ID(), '_dvmac_meta_name_artist', true); ?>
                        <h2 class="fs-4 text-center"><?php echo esc_html($dvmac_meta_name_artist); ?><span
                                class="fs-5">&nbsp;-&nbsp;<?php the_ID(); ?></span></h2>
                        <!-- Retrieve Title Song -->
                        <?php $dvmac_meta_title_song = get_post_meta(get_the_ID(), '_dvmac_meta_title_song', true); ?>
                        <h3 class="fs-5 text-center"><?php echo esc_html($dvmac_meta_title_song); ?></h3>
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