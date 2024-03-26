<?php
$args = array(
    'post_type'      => 'dvmac_slider',
    'post_status'    => 'publish',
    'posts_per_page'    => -1,
    'orderby'          => 'slide_order',
    'order'          => 'ASC',
    // 'order'          => 'DESC',
);

// The Query.
$slider_query = new WP_Query($args);
// echo "<pre>";
// var_dump($slider_query);
// die();

if ($slider_query->have_posts()) :
    // Test Balise img -> alt
    // Dans get_post_meta(n°ID valide);
    // $img_alt = get_post_meta(56, '_wp_attachment_image_alt');
    // echo "<pre>";
    // var_dump($img_alt[0]);
    // die();
?>
<section id="section_carousel" class="container-fluid d-flex align-items-center border border-2">
    <div class="container">
        <div id="carousel_01" class="carousel slide carousel-fade mx-auto" data-bs-pause="false" data-bs-ride="carousel"
            data-bs-interval="2500">
            <!-- Carousel Indicator -->
            <div class="carousel-indicators d-none d-md-flex">
                <?php
                    while ($slider_query->have_posts()) :
                        $slider_query->the_post();
                        echo '<button type="button" data-bs-target="#carousel_01" data-bs-slide-to="' . $slider_query->current_post . '" class="' . ($slider_query->current_post == 0 ?  "active" : "") . '"
                    aria-current="true" aria-label="Slide 1"></button>';
                    ?>
                <?php endwhile; ?>
            </div>
            <?php rewind_posts(); ?>
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <?php
                    $active_item = true;
                    while ($slider_query->have_posts()) :
                        $slider_query->the_post();
                        // Recup des img
                        if ($thumbnail_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')) :
                            $thumbnail_src = $thumbnail_html['0'];
                            // Recup img -> alt
                            $img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt');
                            $img_alt = $img_alt[0];
                    ?>
                <div class="carousel-item <?php echo $active_item ? "active" : ""; ?>">
                    <img src="<?php echo $thumbnail_src; ?>" class="d-block w-100 mx-auto"
                        alt="<?php echo $img_alt; ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5 class="animate__animated animate__bounceInDown animate__delay-1s"><?php the_title(); ?> -->
                        <h5 data-animation="animate__animated animate__bounceInDown"><?php the_title(); ?>
                        </h5>
                        <p data-animation="animate__animated animate__bounceInDown"><?php the_field('sous-titre'); ?>
                        </p>
                    </div>
                </div>
                <?php
                            $active_item = false;
                        endif;
                    endwhile;
                    wp_reset_postdata();
                    ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_01" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel_01" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<?php endif ?>