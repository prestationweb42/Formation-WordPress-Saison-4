<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- Affichage 1 article -->
        <article class="container">
            <h1 class="display-4"><?php the_title(); ?></h1>
            <div class="col-lg-3 mx-auto d-flex justify-content-center">
                <?php the_post_thumbnail('medium'); ?>
            </div>
            <!-- Texte -->
            <p class="my-5 h1"><?php the_content(); ?></p>


            <div class="my-5 border border-3">
                <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                <p class="d-flex flex-column"></p>
                <p>Publié le <?php the_date(); ?></p>
                <p>Auteur :<?php the_author(); ?></p>
                <p>Dans les catégories : <?php the_category(', '); ?></p>
                <p>Avec les étiquettes : <?php the_tags(''); ?> </p>
            </div>
            <!-- commentaire-->
            <?php comments_template(); // Par ici les commentaires 
            ?>
        </article>

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
<?php get_footer(); ?>