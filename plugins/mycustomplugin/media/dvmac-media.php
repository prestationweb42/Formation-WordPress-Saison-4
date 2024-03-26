<?php

// test after activation
// echo ('the plugin runs well and kills the script');
// die();

// Refresh the permalink
add_action('init', function () {
    flush_rewrite_rules();
});

// Register Custom Post Type
function dvmac_media_plugin()
{

    $labels = array(
        'name'                  => _x('Medias', 'Post Type General Name'),
        'singular_name'         => _x('Media', 'Post Type Singular Name'),
        'menu_name'             => __('Post Types'),
        'name_admin_bar'        => __('Post Type'),
        'archives'              => __('Item Archives'),
        'attributes'            => __('Item Attributes'),
        'parent_item_colon'     => __('Parent Item:'),
        'all_items'             => __('All Items'),
        'add_new_item'          => __('Add New Item'),
        'add_new'               => __('Add New'),
        'new_item'              => __('New Item'),
        'edit_item'             => __('Edit Item'),
        'update_item'           => __('Update Item'),
        'view_item'             => __('View Item'),
        'view_items'            => __('View Items'),
        'search_items'          => __('Search Item'),
        'not_found'             => __('Not found'),
        'not_found_in_trash'    => __('Not found in Trash'),
        'featured_image'        => __('Featured Image'),
        'set_featured_image'    => __('Set featured image'),
        'remove_featured_image' => __('Remove featured image'),
        'use_featured_image'    => __('Use as featured image'),
        'insert_into_item'      => __('Insert into item'),
        'uploaded_to_this_item' => __('Uploaded to this item'),
        'items_list'            => __('Items list'),
        'items_list_navigation' => __('Items list navigation'),
        'filter_items_list'     => __('Filter items list'),
    );
    $args = array(
        'labels'                => $labels,
        'label'                 => __('Media', 'text_domain'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'publicly_queryable'    => true,
        'query_var'             => true,
        'exclude_from_search'   => false,
        'description'           => __('My Description custom post type plugin', 'text_domain'),
        'supports'              => array('title', 'editor', 'thumbnail'),
        // 'rewrite'               => true,
        'rewrite'               => array('slug' => 'media'),
        'capability_type'       => 'post',
        'has_archive'          => true,
        'hierarchical'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-video',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
    );
    register_post_type('dvmac_custom_plugin', $args);
}
add_action('init', 'dvmac_media_plugin', 0);

/**==================================
 * Champs personnalisés -> meta boxes
 */
function dvmac_media_register_meta_box()
{
    add_meta_box('dvmac_media_meta', 'Référence du CD', 'dvmac_media_meta_building', 'dvmac_custom_plugin', 'normal', 'high');
    // echo ('toto');
    // die();
}
function dvmac_media_meta_building($post)
{
    // Security
    wp_nonce_field('dvmac_media_meta_box_saving', 'dvmac_42120');

    // Meta box 1 -> years
    // Test if _media_meta_an exist
    $dvmac_meta_an = get_post_meta($post->ID, '_media_meta_an', true);

    // Loop to create years
    $dvmac_years = array();
    $dvmac_years[0] = 'compil';
    for ($i = 1970; $i < 2000; $i++) {
        $dvmac_years[] = $i;
    }
    // Display field box years
    echo '<div>';
    echo '<p><label for="media_detail_an"> Année -&gt&nbsp</label>';
    echo '<select id="media_detail_an" name="media_detail_an">';
    foreach ($dvmac_years as $dvmac_year) :
        // Retrieve and display Years value
        echo '<option value="' . $dvmac_year . '"' . selected($dvmac_meta_an, $dvmac_year, false)  . '">' . $dvmac_year . '</option>';
    endforeach;
    echo '</select></p>';
    echo '</div>';

    // Meta box 2 -> Editor
    // Test if _media_meta_editor exist
    $dvmac_meta_editor = get_post_meta($post->ID, '_media_meta_editor', true);

    // Loop to create years
    $dvmac_editors = array('EMI', 'POLYGRAM', 'UNIVERSAL', 'SONY', 'ATLANTIC', 'VERTIGO');
    $dvmac_editors_count = count($dvmac_editors);
    $dvmac_editors[0] = 'Editeur';
    for ($j = 0; $j < $dvmac_editors_count; $j++) {
        $dvmac_editors[] = $j;
    }

    // Display field box years
    echo '<div>';
    echo '<p><label for="dvmac_meta_editor"> Editeur -&gt&nbsp</label>';
    echo '<select select id="dvmac_meta_editor" name="dvmac_meta_editor">';

    // Option pour la valeur déjà sauvegardée
    foreach ($dvmac_editors as $dvmac_editor) :
        echo '<option value="' . $dvmac_editor . '"' . selected($dvmac_meta_editor, $dvmac_editor, false)  . '">' . $dvmac_editor . '</option>';
    endforeach;
    echo '</select></p>';
    echo '</div>';

    // Meta box 3 -> Name Artist
    // Test if dvmac_meta_name_artist exist
    $dvmac_meta_name_artist = get_post_meta($post->ID, '_dvmac_meta_name_artist', true);
    // Display field box years
    echo '<div>';
    echo '<p><label for="dvmac_meta_name_artist"> Nom de l\'artiste -&gt&nbsp</label>';
    echo '<input id="dvmac_meta_name_artist" name="dvmac_meta_name_artist" value="' . $dvmac_meta_name_artist . '" >';

    // Meta box 4 -> Title song
    // Test if _dvmac_meta_title_song exist
    $dvmac_meta_title_song = get_post_meta($post->ID, '_dvmac_meta_title_song', true);
    // Display field box years
    echo '<div>';
    echo '<p><label for="dvmac_meta_title_song"> Titre de la chanson -&gt&nbsp</label>';
    echo '<input id="dvmac_meta_title_song" name="dvmac_meta_title_song" value="' . $dvmac_meta_title_song . '" >';
}

// Action hook
add_action('add_meta_boxes', 'dvmac_media_register_meta_box');

/**==================
 * Save -> meta boxes
 */
function dvmac_media_save_meta_box($post_id)
{
    // meta box 1 -> dvmac_meta_an
    if (get_post_type($post_id) == 'dvmac_custom_plugin' && isset($_POST['media_detail_an'])) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        check_admin_referer('dvmac_media_meta_box_saving', 'dvmac_42120');
        update_post_meta($post_id, '_media_meta_an', sanitize_text_field($_POST['media_detail_an']));
    }
    // meta box 2 -> dvmac_meta_editor
    if (get_post_type($post_id) == 'dvmac_custom_plugin' && isset($_POST['dvmac_meta_editor'])) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        check_admin_referer('dvmac_media_meta_box_saving', 'dvmac_42120');
        update_post_meta($post_id, '_media_meta_editor', sanitize_text_field($_POST['dvmac_meta_editor']));
    }
    // meta box 3 -> dvmac_meta_name_artist
    if (get_post_type($post_id) == 'dvmac_custom_plugin' && isset($_POST['dvmac_meta_name_artist'])) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        check_admin_referer('dvmac_media_meta_box_saving', 'dvmac_42120');
        update_post_meta($post_id, '_dvmac_meta_name_artist', sanitize_text_field($_POST['dvmac_meta_name_artist']));
    }
    // meta box 4 -> dvmac_meta_title_song
    if (get_post_type($post_id) == 'dvmac_custom_plugin' && isset($_POST['dvmac_meta_title_song'])) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        check_admin_referer('dvmac_media_meta_box_saving', 'dvmac_42120');
        update_post_meta($post_id, '_dvmac_meta_title_song', sanitize_text_field($_POST['dvmac_meta_title_song']));
    }
}
// Action hook
add_action('save_post', 'dvmac_media_save_meta_box');


/**
 * Ajout de l'image et du numéro d'ordre de passage d'un item dans le carousel -> dans le menu de la liste des items du Dashboard
 * Très important le format du hook personnalisé
 *    manage_edit-{custom-post-type}_columns
 */

add_filter('manage_edit-dvmac_custom_plugin_columns', 'dvmac_media_col_change');

// function
function dvmac_media_col_change($columns)
{
    $columns['dvmac_media_annee'] = 'Année';
    $columns['dvmac_media_image'] = 'Imgage affichée';
    $columns['dvmac_media_editeur'] = 'Editeur label';
    return $columns;
};

/**
 * Affichage des éléments des items dans le dashboard s'ils existent -> préparés ci-dessus,
 * Très important la aussi avec un hook personnalisé comme ceci :
 *     manage_{custom-post-type}_posts_custom_column
 */
add_action('manage_dvmac_custom_plugin_posts_custom_column', 'dvmac_media_show', 10, 2);

// function
function dvmac_media_show($column, $post_id)
{
    global $post;
    if ($column == 'dvmac_media_image') {
        echo the_post_thumbnail(array(110, 110));
    }
    if ($column == 'dvmac_media_annee') {
        $dvmac_meta_annee = get_post_meta($post_id, '_media_meta_an', true);
        echo $dvmac_meta_annee;
    }
    if ($column == 'dvmac_media_editeur') {
        $dvmac_meta_editeur = get_post_meta($post_id, '_media_meta_editor', true);
        echo $dvmac_meta_editeur;
    }
}

/**
 * Custom Taxonomy
 */
function dvmac_media_plugin_taxonomy()
{

    $labels = array(
        'name'              => ('Styles Musicaux'),
        'singular_name'     => ('Style'),
        'all_items'         => ('Tous les styles'),
        'edit_item'         => ('Modifier le style'),
        'update_item'       => ('Mettre à jour le style'),
        'add_new_item'      => ('Ajouter un style'),
        'search_items'      => ('Rechercher les styles'),
        'new_item_name'     => ('Nouveau nom de style'),
        'menu_name'         => ('Styles des Disques'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'publicly_queryable' => true,
        'hierarchical'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'style'),
        'show_admin_column' => true, // display Medias column
    );


    register_taxonomy('genre', 'dvmac_custom_plugin', $args);
}
add_action('init', 'dvmac_media_plugin_taxonomy');
