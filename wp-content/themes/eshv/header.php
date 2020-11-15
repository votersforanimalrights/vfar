<?php
ob_start();
require_once __DIR__ . '/svg/caret.php';
$caret = ob_get_clean();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:article="http://ogp.me/ns/article#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# fb: https://www.facebook.com/2008/fbml#">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="icon" href="/logo.png" type="image/x-icon"/>
<link rel="shortcut icon" href="/logo.png" type="image/x-icon"/>
<meta property="fb:app_id" content="245483685859438" />
<meta name="twitter:card" content="summary_large_image" />
<script src="https://use.fontawesome.com/0554d22be7.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php echo VFAR\assetUrl( 'css/styles.css' ) ?>" rel="stylesheet" />
<?php wp_head(); ?>
</head>
<body <?php
$classes = '';
if (is_page()) {
  $classes = 'page-' . get_post()->post_name;
}
body_class($classes) ?>>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-93781805-1', 'auto');
ga('send', 'pageview');
</script>
<?php
get_template_part( 'templates/modal' );
?>
<header class="masthead" id="masthead">
  <h1>
    <a href="<?php echo home_url() ?>" class="logo">
      <?php get_template_part('logo') ?>
    </a>
  </h1>
  <?php $links = VFAR\Theme::getNavMenuItems( 'header-links' ); ?>
  <nav class="header-nav" id="header-nav">
    <?php
    foreach ( $links as $link ) {
      $active = in_array( 'current-menu-item', $link->classes ) || in_array( 'current-page-ancestor', $link->classes );

      printf(
        '<a id="nav-%d" class="%s" href="%s">%s</a>',
        $link->ID,
        $active ? 'active' : '',
        $link->url,
        $link->title
      );
    }
    ?>
  </nav>
  <button class="hamburger" id="hamburger">&#9776;</button>
  <nav class="mobile-nav">
    <ul>
      <?php
      foreach ( $links as $link ) {
        $subnav = '';
        if (count($link->children) > 0) {
          $subnav = $caret . '<ul>';
          foreach ( $link->children as $child ) {
            $active = in_array( 'current-menu-item', $child->classes ) || in_array( 'current-page-ancestor', $child->classes );
            if (strpos($child->url, $link->url) === 0) {
              $subnav .= sprintf(
                '<li><a href="%s#%s" class="%s">%s</a></li>',
                $link->url,
                $child->slug,
                $active ? 'active' : '',
                $child->title
              );
            } else {
              $subnav .= sprintf(
                '<li><a href="%s" class="%s">%s</a></li>',
                $child->url,
                $active ? 'active' : '',
                $child->title
              );
            }
          }
          $subnav .= '</ul>';
        }

        printf(
          '<li><a href="%s">%s</a>%s</li>',
          $link->url,
          $link->title,
          $subnav
        );
      }
      ?>
    </ul>
  </nav>
  <nav class="header-actions">
    <a id="join-us" href="<?php echo home_url() ?>#join-us">Join Us</a>
    <a href="<?php echo home_url( '/donate/' ) ?>">Donate</a>
  </nav>
  <nav class="subnav" id="subnav">
    <?php
    foreach ( $links as $link ) {
      if ($link->children) {
        $parentActive = in_array( 'current-menu-item', $link->classes ) || in_array( 'current-page-ancestor', $link->classes );
      ?>
      <div id="subnav-<?php echo $link->ID ?>" class="subnav-links<?php echo $parentActive ? ' active' : '' ?>">
        <ul>
        <?php
          foreach ( $link->children as $child ) {
            $active = in_array( 'current-menu-item', $child->classes ) || in_array( 'current-page-ancestor', $child->classes );
            if (strpos($child->url, $link->url) === 0) {
              printf(
                '<li class="%s"><a href="%s#%s" class="%s">%s</a></li>',
                $parentActive ? 'active' : '',
                $link->url,
                $child->slug,
                $active ? 'active' : '',
                $child->title
              );
            } else {
              printf(
                '<li class="%s"><a href="%s" class="%s">%s</a></li>',
                $parentActive ? 'active' : '',
                $child->url,
                $active ? 'active' : '',
                $child->title
              );
            }
          }
        ?>
        </ul>
      </div>
      <?php
      }
    } ?>
  </nav>
</header>
<main class="main">
