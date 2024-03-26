<article class="row col-12 col-md-12 col-lg-12 col-xl-8  mx-auto mb-5 align-items-center">
    <!-- Img -->
    <div class="article_img col-8 col-md-4 col-lg-3 d-flex justify-content-center mx-auto">
        <!-- <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('thumbnail'); ?>
        </a> -->
        <?php
        if ($thumbnail_html = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium'))
            $thumbnail_src = $thumbnail_html[0];
        ?>
        <a href="<?php the_permalink(); ?>">
            <img class="img-fluid img-thumbnail" src="<?php echo $thumbnail_src; ?>" alt="">
        </a>

    </div>
    <!-- Article -->
    <div class="col-12 col-md-8 col-lg-9 mt-4 mt-sm-3 mt-md-0">
        <h2 class="text-left text-uppercase fs-4">
            <a class="text-decoration-none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <p>
            <?php echo display_attributs_articles(
                get_the_date(),
                get_the_category_list(', '),
                get_the_tag_list('', ', '),
                get_the_author(),
                get_comments_number(', pas de commentaire'),
            )
            ?>
        </p>
        <div class="w-100">
            <?php the_excerpt(); ?>
            <!-- <p>
                <a href="<?php the_permalink(); ?>" class="post__link">Lire la suite</a>
            </p> -->
        </div>
        <!-- <p class="post__meta"> Publié le <?php the_time(get_option('date_format')); ?></p> -->
        <!-- <p>Auteur : <?php the_author(); ?></p> -->
        <!-- <p>Commentaire : <?php comments_number('Pas de commentaire pour l\'instan'); ?></p> -->
        <!-- <p>Catégorie(s) : <?php the_category() ?></p> -->
        <!-- <p>Etiquette(s) : <?php the_tags('') ?></p> -->
        <!-- Lien lire la suite -->

    </div>
</article>