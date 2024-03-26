<?php

/* Template Name: liste par style */

?>

<?php get_header(); ?>

<?php
$dvmac_term_list = get_terms(array('taxonomy' => 'genre', 'hide_empty' => true));
if (count($dvmac_term_list) > 0) { ?>

<?php foreach ($dvmac_term_list as $the_term) {
        $list_taxo_media = array(
            'post_type' => 'dvmac_custom_plugin',
            'post_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => $the_term->slug,
                )
            )
        );
        $req_list_taxo_media = new WP_Query($list_taxo_media); ?>
<!-- loop wordpress  -->
<?php if ($req_list_taxo_media->have_posts()) : ?>
<section class="container min-height-60">
    <div class="row">
        <!-- Title Genre -->
        <h2><?php echo $the_term->name; ?></h2>

        <?php while ($req_list_taxo_media->have_posts()) : $req_list_taxo_media->the_post(); ?>
        <?php
                        // echo '<pre>';
                        // var_dump($req_list_taxo_media);
                        // echo '</pre>';
                        // die(); 
                        ?>
        <!-- Card here -->
        <article class="col-xs-10 col-md-6 col-lg-3">
            <div class="card min-height-370">
                <div class="card-body">
                    <a href="<?php the_permalink() ?>">
                        <?php the_post_thumbnail('medium', ['class' => 'img-thumbnail img-fluid d-block mx-auto']); ?>
                    </a>
                </div>
                <div class="car-header">
                    <!-- <h2 class="text-center fs-4"><?php the_title(); ?></h2> -->
                    <!-- Retrieve Artist Name -->
                    <?php $dvmac_meta_name_artist = get_post_meta(get_the_ID(), '_dvmac_meta_name_artist', true); ?>
                    <h2 class="fs-4 text-center"><?php echo esc_html($dvmac_meta_name_artist); ?></h2>
                    <!-- Retrieve Title Song -->
                    <?php $dvmac_meta_title_song = get_post_meta(get_the_ID(), '_dvmac_meta_title_song', true); ?>
                    <h3 class="fs-5 text-center"><?php echo esc_html($dvmac_meta_title_song); ?></h3>
                </div>
            </div>
        </article>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

        <?php else : ?>
        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div> <!-- row -->
</section> <!-- container -->
<?php }; // endforeach
        ?>

<?php }; // endif 
    ?>

<?php get_footer(); ?>