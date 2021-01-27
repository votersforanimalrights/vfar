<?php
namespace VFAR;

class Admin {
  public $hide_splash_key = 'vfar_page_hide_splash';
  public $hide_title_key = 'vfar_page_hide_title';
  public $hide_title_over_image_key = 'vfar_page_hide_title_over_image';

  public function __construct() {
    add_action('admin_init', [$this, 'admin_init']);
    add_action('save_post_page', [$this, 'save_post_page'], 10, 2);
  }

  public function admin_init() {
    add_meta_box(
      'vfar-page-toggles-meta-box',
      'Page Options',
      [$this, 'page_meta_box'],
      'page',
      'advanced',
      'high'
    );
  }

  private function radio($post, $title, $key) {
    $stored = empty($post) ? false : get_post_meta($post->ID, $key, true) === 'yes';
    ?>
    <p>
      <strong><?php echo $title ?>:</strong><br />
      <input type="radio" name="<?php echo $key ?>" value="yes" <?php echo $stored ? 'checked' : '' ?>/> Yes
      &nbsp;<input type="radio" name="<?php echo $key ?>" value="no" <?php echo $stored ? '' : 'checked' ?>/> No
    </p>
    <?php
  }

  public function page_meta_box($post) {
    $this->radio($post, 'Hide splash', $this->hide_splash_key);
    $this->radio($post, 'Hide title', $this->hide_title_key);
    $this->radio($post, 'Hide title over featured image', $this->hide_title_over_image_key);
  }

  public function can_save_page() {
    if ('POST' !== $_SERVER['REQUEST_METHOD']) {
      return;
    }
    if (defined('DOING_AJAX') || defined('DOING_CRON')|| defined('DOING_AUTOSAVE')) {
      return;
    }

    return true;
  }

  private function save_key($post, $key) {
    if (!empty($_POST[$key])) {
      update_post_meta($post->ID, $key, stripslashes($_POST[$key]));
    }
  }

  public function save_post_page($post_id, $post) {
    if (!$this->can_save_page()) {
      return;
    }

    $this->save_key($post, $this->hide_splash_key);
    $this->save_key($post, $this->hide_title_key);
    $this->save_key($post, $this->hide_title_over_image_key);
  }
}
