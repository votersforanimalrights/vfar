<?php
namespace VFAR;

class Theme {
  public function __construct() {
    $this->removeFilters();

    add_action( 'init', [ $this, 'init' ] );
    add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
    add_action( 'widgets_init', [ $this, 'widgets_init' ] );
    add_filter( 'mce_buttons_2', [ $this, 'mce_buttons' ], 5 );
    add_rewrite_endpoint( 'iframe', EP_PAGES );
    add_shortcode( 'donate', [ $this, 'donate' ] );
    add_shortcode( 'animals', [ $this, 'animals' ] );
    add_shortcode( 'issues', [ $this, 'issues' ] );
    add_filter( 'wpseo_twitter_creator_account', [ $this, 'wpseo_twitter_creator_account' ] );
  }

  public function wpseo_twitter_creator_account( $account ) {
    return 'theanimalvoters';
  }

  public function donate() {
    ob_start();
    get_template_part('templates/donate');
    return ob_get_clean();
  }  

  public function animals() {
    ob_start();
    get_template_part('templates/animals');
    return ob_get_clean();
  }

  public function issues() {
    ob_start();
    get_template_part('templates/agenda-issues');
    return ob_get_clean();
  }

  public function mce_buttons( $buttons ) {
    $buttons[] = 'underline';
    $buttons[] = 'superscript';
    return $buttons;
  }

  public function init() {
    add_post_type_support( 'page', 'excerpt' );
  }

  public function after_setup_theme() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    register_nav_menu( 'header', 'Header Links' );
    register_nav_menu( 'footer', 'Footer Links' );
  }

  public function widgets_init() {
    foreach ( [ 'Footer' ] as $sidebar ) {
      $id = sanitize_title( $sidebar );
      register_sidebar( [
      	'id' => $id,
      	'name' => sprintf( '%s Widgets', $sidebar ),
      	'description' => 'Manage widgets',
      	'before_widget' => '',
      	'after_widget' => '',
      	'before_title' => '',
      	'after_title' => ''
      ] );
    }
  }

  public static function renderSidebar( $slug, $args = [] ) {
    ob_start();
    dynamic_sidebar( $slug );
    $sidebar = ob_get_clean();

    if ( empty( $args ) ) {
      return $sidebar;
    }

    $parsedArgs = [];
    foreach ( $args as $key => $value ) {
      $key = sprintf( '__%s__',  strtoupper( $key ) );
      $parsedArgs[ $key ] = $value;
    }

    return str_replace(
      array_keys( $parsedArgs ),
      array_values( $parsedArgs ),
      $sidebar
    );
  }

  public static function getNavMenuItems( $slug ) {
		$items = wp_get_nav_menu_items( $slug );
    if ( empty( $items ) ) {
      return [];
    }

		$top_level = [];
		$sub_items = [];

		foreach ( $items as $item ) {
			if ( 0 === (int) $item->menu_item_parent ) {
				$top_level[] = $item;
			} else {
				$sub_items[] = $item;
			}
		}
    $sub_items = wp_list_sort( $sub_items, 'menu_order', 'ASC' );
		$menu = [];
		foreach ( $top_level as $t ) {
			$menu[ $t->ID ] = $t;
			$menu[ $t->ID ]->children = [];
		}
		foreach ( $sub_items as $sub_item ) {
			$menu[ $sub_item->menu_item_parent ]->children[] = $sub_item;
		}

    $childIds = [];
    foreach ( $menu as $m ) {
      foreach ($m->children as $c) {
        $childIds[] = $c->object_id;
      }
    }

    $posts = get_posts([
      'post__in' => $childIds,
      'post_type' => 'page',
      'posts_per_page' => '-1',
    ]);

    $slugs = [];
    foreach ( $posts as $p ) {
      $slugs[$p->ID] = $p->post_name;
    }

		foreach ( $menu as &$m ) {
			$m->has_children = ! empty( $m->children );
      $m->children = wp_list_sort( $m->children, 'menu_order', 'ASC' );
      _wp_menu_item_classes_by_context($m->children);

      foreach ($m->children as &$child) {
        $child->slug = $slugs[$child->object_id];
      }
		}
    _wp_menu_item_classes_by_context($menu);

		return array_values( $menu );
	}

  public function removeFilters() {
    add_filter('show_admin_bar', '__return_false');
    remove_action( 'admin_init', '_maybe_update_core' );
		remove_action( 'admin_init', '_maybe_update_plugins' );
		remove_action( 'admin_init', '_maybe_update_themes' );
		// these are gross
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
		// these are gross
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
  }
}
