<?php

function mytheme_wpconfig_options_page() {
  add_options_page(
      'Edit wp-config',
      'Lyfe ( Edit wp-config )',
      'manage_options',
      'mytheme-wpconfig-options',
      'mytheme_wpconfig_options_content'
  );
}
add_action('admin_menu', 'mytheme_wpconfig_options_page');

function mytheme_wpconfig_options_content() {
  if (!current_user_can('manage_options')) {
      wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  if (isset($_POST['submit'])) {
      $wpconfig_content = $_POST['wpconfig_content'];
      mytheme_update_wpconfig_file($wpconfig_content);
      echo '<div class="updated"><p>wp-config.php file updated successfully.</p></div>';
  }

  $wpconfig_content = mytheme_get_wpconfig_file_content();

  ?>
  <div class="wrap">
      <h1>Edit .wpconfig</h1>
      <form method="post">
          <textarea name="wpconfig_content" rows="20" cols="80"><?php echo esc_textarea($wpconfig_content); ?></textarea>
          <br>
          <input type="submit" class="button button-primary" name="submit" value="Save Changes">
      </form>
  </div>
  <?php
}

function mytheme_get_wpconfig_file_content() {
  $wpconfig_path = ABSPATH . 'wp-config.php';

  if (file_exists($wpconfig_path)) {
      return file_get_contents($wpconfig_path);
  }

  return '';
}

function mytheme_update_wpconfig_file($content) {
  $wpconfig_path = ABSPATH . 'wp-config.php';

  // Ensure that the user has write permissions for the .wpconfig file
  if (!is_writable($wpconfig_path)) {
      wp_die('The wp-config.php file is not writable. Please update the permissions and try again.');
  }

  file_put_contents($wpconfig_path, $content);
}