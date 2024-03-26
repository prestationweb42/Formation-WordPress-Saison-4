<?php

/**
 * Function to save Options into BDD
 *
 * @return void
 */
function dvmac_save_options()
{
    /**
     * To control the POST
     */
    // echo '<pre>';
    // var_dump($_POST);
    // die();

    /**
     * Check authorization
     */
    if (!current_user_can('publish_pages')) {
        wp_die('Vous n\'êtes pas autorisé à effectuer cette opération');
    }
    /**
     * check security -> wp_nonce_field
     */
    check_admin_referer(('dvmac_options_verify'));

    /**
     * Get array options
     */
    $opts = get_option('dvmac_opts');

    /**
     * save the legend and image sent by the form
     */
    $opts['legend_01'] = sanitize_text_field($_POST['dvmac_legend_01']);
    $opts['img_01_url'] = sanitize_text_field($_POST['dvmac_hidden_img_01']);
    // in the BDD
    update_option('dvmac_opts', $opts);

    /**
     * redirect to the options page -> codex
     */
    wp_redirect(admin_url('admin.php?page=dvmac_theme_opts&status=1'));
    exit;
}
