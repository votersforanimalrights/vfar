<?php
namespace ESHV;

class Theme {
  public function __construct() {
    $this->removeFilters();

    add_action( 'init', [ $this, 'init' ] );
    add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
    add_action( 'widgets_init', [ $this, 'widgets_init' ] );
    add_filter( 'mce_buttons_2', [ $this, 'mce_buttons' ], 5 );
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
		$GLOBALS['_menu_item_sort_prop'] = 'menu_order';
		foreach ( $items as $item ) {
			if ( 0 === (int) $item->menu_item_parent ) {
				$top_level[] = $item;
			} else {
				$sub_items[] = $item;
			}
		}
		usort( $sub_items, '_sort_nav_menu_items' );
		$menu = [];
		foreach ( $top_level as $t ) {
			$menu[ $t->ID ] = $t;
			$menu[ $t->ID ]->children = [];
		}
		foreach ( $sub_items as $sub_item ) {
			$menu[ $sub_item->menu_item_parent ]->children[] = $sub_item;
		}
		foreach ( $menu as &$m ) {
			$m->has_children = ! empty( $m->children );
			usort( $m->children, '_sort_nav_menu_items' );
		}
		return array_values( $menu );
	}

  public function removeFilters() {
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
