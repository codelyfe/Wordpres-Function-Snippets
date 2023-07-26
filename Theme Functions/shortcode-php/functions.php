<?php
// Define the shortcode function
function mytheme_php_embed_shortcode($atts) {
    // Your PHP code here
    ob_start();
    // You can use regular PHP code and echo the output
    echo "Hello from PHP shortcode!";
    return ob_get_clean();
  }
  add_shortcode('php_embed', 'mytheme_php_embed_shortcode');
  
  // [php_embed]
  