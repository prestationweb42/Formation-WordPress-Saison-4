<?php

/**
 * Slider Post Type
 */


function dvmac_slider_post_type()
{

    $labels = array(

        'name'                     => __('Carousel', 'TEXTDOMAINHERE'),  // display name Dashboard
        'singular_name'            => __('Slider Accueil', 'TEXTDOMAINHERE'), // display name ACF
        'menu_name'                => __('Slider Front Page'),  // display name left column Dashboard
        'add_new'                  => __('Ajouter un item', 'TEXTDOMAINHERE'),
        'add_new_item'             => __('Ajouter une image accueil', 'TEXTDOMAINHERE'),
        'edit_item'                => __('Modifier un item', 'TEXTDOMAINHERE'),
        'new_item'                 => __('Nouveau', 'TEXTDOMAINHERE'),
        'all_items'                => __('Tous les items', 'TEXTDOMAINHERE'),
        'view_item'                => __('Voir un item', 'TEXTDOMAINHERE'),
        'search_items'             => __('Chercher une image', 'TEXTDOMAINHERE'),
        'not_found'                => __('Aucun item trouvé.', 'TEXTDOMAINHERE'),
        'not_found_in_trash'       => __('Aucun item dans la corbeille.', 'TEXTDOMAINHERE'),
    );

    $args = array(

        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        // 'rewrite'               => true,
        'rewrite'               => array('slug' => 'slider'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => true,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-images-alt2',
        'exclude_from_search'   => true,
        // 'supports'              => array('title', 'editor', 'page-attributes', 'thumbnail')
        'supports'              => array('title', 'page-attributes', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),

    );
    // nom du custom post type
    register_post_type('dvmac_slider', $args);
}

add_action('init', 'dvmac_slider_post_type');

/**
 * Ajout de l'image et du numéro d'ordre de passage d'un item dans le carousel -> dans le menu de la liste des items du Dashboard
 * Très important le format du hook personnalisé
 *    manage_edit-{custom-post-type}_columns
 */

add_filter('manage_edit-dvmac_slider_columns', 'dvmac_col_change');

// function
function dvmac_col_change($columns)
{
    $columns['dvmac_slider_image_order'] = 'Ordre';
    $columns['dvmac_slider_image'] = 'Imgage affichée';
    return $columns;
};


/**
 * Affichage des éléments des items dans le dashboard s'ils existent -> préparés ci-dessus,
 * Très important la aussi avec un hook personnalisé comme ceci :
 *     manage_{custom-post-type}_posts_custom_column
 */
add_action('manage_dvmac_slider_posts_custom_column', 'dvmac_content_show', 10, 2);

// function
function dvmac_content_show($column, $post_id)
{
    global $post;
    if ($column == 'dvmac_slider_image') {
        echo the_post_thumbnail(array(100, 100));
    }
    if ($column == 'dvmac_slider_image_order') {
        echo $post->menu_order;
    }
}

/**
 * Triage Auto de l'ordre de défilement des items
 */
// function dvmac_change_slides_ordre($query)
// {
//     global $post_type, $pagenow;
//     if ($pagenow == 'edit.php' && $post_type == 'dvmac_slider') {
//         $query->query_vars['orderby'] = 'menu_order';
//         $query->query_vars['order'] = 'asc';
//     }
// }
// add_action('pre_get_posts', 'dvmac_change_slides_ordre');

/**
 * Triage de l'ordre de passge des items dans le carousel,
 * Très important la aussi avec un hook personnalisé comme ceci :
 *     manage_edit-{custom-post-type}_sortable_column
 */
add_filter('manage_edit-dvmac_slider_sortable_columns', 'my_sortable_dvmac_slider');
function my_sortable_dvmac_slider($columns)
{
    $columns['dvmac_slider_image_order'] = 'slide_order';
    return $columns;
}
