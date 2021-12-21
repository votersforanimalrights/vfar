<?php
namespace VFAR;

class PostTypes {
  public static function inflection( $name, $plural = '' ) {
  	if ( empty( $plural ) ) {
  		$plural = $name . 's';
  	}

  	$lower = strtolower( $name );
  	$plower = strtolower( $plural );

  	return [
      'name' => $plural,
      'singular_name' => $name,
      'add_new_item' => 'Add New ' . $name,
      'edit_item' => 'Edit ' . $name,
      'new_item' => 'New ' . $name,
      'view_item' => 'View ' . $name,
      'search_items' => 'Search ' . $plural,
      'not_found' => 'No ' . $plower . ' found.',
      'not_found_in_trash' => 'No ' . $plower . ' found in Trash.',
      'all_items' => 'All ' . $plural,
      'archives' => $name . ' Archives',
      'insert_into_item' => 'Insert into ' . $lower,
      'uploaded_to_this_item' => 'Uploaded to this ' . $lower,
      'filter_items_list' => 'Filter ' . $plower . ' list',
      'items_list_navigation' => $plower . ' list navigation',
      'items_list' => $plural . ' list',
  	];
  }

  public function __construct() {
    register_post_type( 'vfar_agenda_item', [
      'public' => true,
      'menu_icon' => 'dashicons-clipboard',
      'has_archive' => false,
      'rewrite' => false,
      'show_in_nav_menus' => false,
      'labels' => static::inflection( 'Agenda Item' ),
      'supports' => [ 'title', 'editor', 'thumbnail' ],
      'taxonomies' => [ 'post_tag' ],
      'register_meta_box_cb' => [ $this, 'vfar_agenda_item_meta_box_cb' ]
    ] );

    add_action( 'save_post_vfar_agenda_item', [ $this, 'save_post_vfar_agenda_item' ] );
  }

  protected function can_save_post( $post_id ) {
    // needs to work for PUT, POST, etc
    if ( 'GET' === $_SERVER['REQUEST_METHOD']
      || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      || ( defined( 'DOING_AJAX' ) && DOING_AJAX )
      || 'auto-draft' === get_post( $post_id )->post_status
      || wp_is_post_revision( $post_id )
      || wp_is_post_autosave( $post_id ) ) {
      return false;
    }

    // Checks user caps
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return false;
    }

    return true;
  }

  public function save_post_vfar_agenda_item( $post_id ) {
    if ( ! $this->can_save_post( $post_id )) {
      return;
    }

    update_post_meta( $post_id, 'vfar_agenda_item_title', stripslashes( $_POST['vfar_agenda_item_title'] ) );
    update_post_meta( $post_id, 'vfar_agenda_item_done', stripslashes( $_POST['vfar_agenda_item_done'] ) );
    update_post_meta( $post_id, 'vfar_agenda_item_button_url', stripslashes( $_POST['vfar_agenda_item_button_url'] ) );
  }

  public function vfar_agenda_item_meta_box_cb( $post ) {
    add_meta_box(
      'inputs',
      'Inputs',
      [ $this, 'box' ],
      $post->post_type
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

  private function text($post, $title, $key) {
    $value = empty($post) ? '' : get_post_meta($post->ID, $key, true);
    ?>
    <p>
      <strong><?php echo $title ?>:</strong><br />
      <input type="text" name="<?php echo $key ?>" value="<?php echo esc_attr( $value ) ?>" />
    </p>
    <?php
  }

  public function box( $post ) {
    $title = get_post_meta( $post->ID, 'vfar_agenda_item_title', true );
?>
<p>
  <strong>Title with line breaks</strong>:<br />
  <textarea class="widefat" rows="8" name="vfar_agenda_item_title"><?php echo esc_textarea( $title ) ?></textarea>
</p>
<?php
    $this->radio( $post, 'Mark as Done', 'vfar_agenda_item_done' );
    $this->text( $post, 'Button URL', 'vfar_agenda_item_button_url' );
  }
}
