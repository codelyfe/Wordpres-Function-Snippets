<?php

/* Read style.css File */
function mytheme_enqueue_styles() {
  wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );
/* Read style.css File */