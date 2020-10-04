<?php
namespace VFAR;

function getPageChildren() {
  return get_posts(array(
    'post_type' => 'page',
    'post_parent' => get_the_ID(),
    'orderby' => 'menu_order',
    'order' => 'ASC',
  ));
}

function assetUrl($path) {
  static $assets = null;
  if ($assets === null) {
    $manifest = dirname(WP_CONTENT_DIR) . '/rev-manifest.json';
  	$assets = json_decode(file_get_contents($manifest), true);
  }

  if (isset($assets[$path])) {
  	$path = $assets[$path];
  }
  return '/public/' . $path;
}
