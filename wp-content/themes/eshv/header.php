<?php
$post_name = get_post()->post_name;
$is_page = is_page();
$is_launch = $is_page && ('launch' === $post_name || 'launch-party-waiting-list' === $post_name);
$is_circus = $is_page && 'may2circus' === $post_name;
$is_action = $is_page && 'action' === $post_name;
$is_volunteer = $is_page && 'volunteer' === $post_name;
$is_events = $is_page && 'events' === $post_name;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<meta property="fb:app_id" content="245483685859438" />
<meta property="og:site_name" content="<?php bloginfo( 'name' ) ?>" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@nyvoteshumane" />
<meta name="twitter:creator" content="@nyvoteshumane" />
<?php
$description = 'We work to elect candidates who support animal protection, lobby for stronger laws to stop animal cruelty, and hold elected officials accountable to humane voters.';
if ( is_singular() && ! is_front_page() ) {
  $excerpt = strip_tags( get_the_excerpt() );
  if (empty($excerpt)) {
    $excerpt = $description;
  }
?>
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink() ?>" />
<?php if ($is_action) {
  $title = 'Urge City Council To Ban Wild Animals in the Circus!';
  $desc = 'Call your City Council Member now.'
?>
<meta property="og:title" content="<?php echo $title ?>" />
<meta name="twitter:title" content="<?php echo $title ?>" />
<meta property="og:description" content="<?php echo $desc ?>" />
<meta name="twitter:description" content="<?php echo $desc ?>" />
<meta name="twitter:text:description" content="<?php echo $desc ?>" />
<?php } else { ?>
<meta property="og:title" content="<?php the_title_attribute() ?> - <?php bloginfo( 'name' ) ?>" />
<meta name="twitter:title" content="<?php the_title_attribute() ?> - <?php bloginfo( 'name' ) ?>" />
<meta property="og:description" content="<?php echo esc_attr( $excerpt ) ?>" />
<meta name="twitter:description" content="<?php echo esc_attr( $excerpt ) ?>" />
<meta name="twitter:text:description" content="<?php echo esc_attr( $excerpt ) ?>" />
<?php } ?>
<?php } else {
?>
<meta property="og:url" content="<?php echo home_url() ?>" />
<meta property="og:title" content="<?php bloginfo( 'name' ) ?>" />
<meta name="twitter:title" content="<?php bloginfo( 'name' ) ?>">
<meta property="og:description" content="<?php echo esc_attr( $description ) ?>" />
<meta name="twitter:description" content="<?php echo esc_attr( $description ) ?>" />
<meta name="twitter:text:description" content="<?php echo esc_attr( $description ) ?>" />
<?php } ?>
<?php if ( $is_launch ) { ?>
<meta property="og:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/launch-kitten.jpg" />
<meta name="twitter:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/launch-kitten.jpg" />
<?php } elseif ( $is_events ) { ?>
  <meta property="og:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/circus-vote.jpg" />
  <meta name="twitter:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/circus-vote.jpg" />
<?php } elseif ( $is_circus ) { ?>
<meta property="og:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/circus-action.jpg" />
<meta name="twitter:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/circus-action.jpg" />
<?php } elseif ( $is_action ) { ?>
<meta property="og:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/action.jpg" />
<meta name="twitter:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/action.jpg" />
<?php } else if ( $is_volunteer ) { ?>
<meta property="og:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/volunteer.jpg" />
<meta name="twitter:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/volunteer.jpg" />
<?php } else { ?>
<meta property="og:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/splash-og.png" />
<meta name="twitter:image" content="<?php echo WP_CONTENT_URL ?>/themes/eshv/splash-og.png" />
<?php } ?>
<script src="https://use.fontawesome.com/0554d22be7.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php echo ESHV\assetUrl( 'css/styles.css' ) ?>" rel="stylesheet" />
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
<header class="masthead">
  <h1>
    <a href="<?php echo home_url() ?>" class="logo">
      <img
        src="/wp-content/themes/eshv/images/logo-2x.png"
        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"
      />
    </a>
    <a href="<?php echo home_url() ?>" class="logo-small">
      <img
        src="/wp-content/themes/eshv/images/logo-small.png"
        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"
      />
    </a>
  </h1>
  <?php $links = ESHV\Theme::getNavMenuItems( 'header-links' ); ?>
  <nav class="header-nav">
    <?php
    foreach ( $links as $link ) {
      printf(
        '<a href="%s">%s</a>',
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
        printf(
          '<li><a href="%s">%s</a></li>',
          $link->url,
          $link->title
        );
      }
      ?>
    </ul>
  </nav>
  <nav class="header-actions">
    <a id="join-the-pack" href="<?php echo home_url() ?>#join-the-pack">Join the Pack</a>
    <a href="<?php echo home_url( '/donate/' ) ?>">Donate</a>
  </nav>
</header>
<main class="main">
