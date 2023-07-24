<?php 

function mytheme_htaccess_options_page() {
  add_options_page(
      'Edit .htaccess',
      'Lyfe ( Edit .htaccess )',
      'manage_options',
      'mytheme-htaccess-options',
      'mytheme_htaccess_options_content'
  );
}
add_action('admin_menu', 'mytheme_htaccess_options_page');

function mytheme_htaccess_options_content() {
  if (!current_user_can('manage_options')) {
      wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  if (isset($_POST['submit'])) {
      $htaccess_content = $_POST['htaccess_content'];
      mytheme_update_htaccess_file($htaccess_content);
      echo '<div class="updated"><p>.htaccess file updated successfully.</p></div>';
  }

  $htaccess_content = mytheme_get_htaccess_file_content();

  ?>
  <div class="wrap">
      <h1>Edit .htaccess</h1>
      <form method="post">
          <textarea name="htaccess_content" rows="20" cols="80"><?php echo esc_textarea($htaccess_content); ?></textarea>
          <br>
          <input type="submit" class="button button-primary" name="submit" value="Save Changes">
      </form>
  </div>
  <?php
}

function mytheme_get_htaccess_file_content() {
  $htaccess_path = ABSPATH . '.htaccess';

  if (file_exists($htaccess_path)) {
      return file_get_contents($htaccess_path);
  }

  return '';
}

function mytheme_update_htaccess_file($content) {
  $htaccess_path = ABSPATH . '.htaccess';

  // Ensure that the user has write permissions for the .htaccess file
  if (!is_writable($htaccess_path)) {
      wp_die('The .htaccess file is not writable. Please update the permissions and try again.');
  }

  file_put_contents($htaccess_path, $content);
}
