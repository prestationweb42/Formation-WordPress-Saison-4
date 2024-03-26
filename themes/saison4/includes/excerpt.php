<?php

/**
 * Filter the excerpt length to 30 words.
 *
 * @param int $length Excerpt length.
 * @return int modified excerpt length.
 */
function wp_excerpt_length()
{
    return 30;
}
add_filter('excerpt_length', 'wp_excerpt_length');


function wp_excerpt_link_more()
{
    return '<a class="more-link" href="' . get_permalink() . '" >' . ' [lire la suite]' . '</a>';
}
add_filter('excerpt_more', 'wp_excerpt_link_more');
