<?php

// Add a custom theme function to flush the Redis cache
function custom_flush_redis_cache() {
  // Make sure the Redis object-cache drop-in is enabled
  if (function_exists('wp_cache_flush')) {
      // Flush the Redis cache
      wp_cache_flush();
  }
}
add_action('template_redirect', 'custom_flush_redis_cache');