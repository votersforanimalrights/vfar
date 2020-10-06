<?php
ob_start();
require_once __DIR__ . '/svg/caret.php';
$caret = ob_get_clean();

$post_name = get_post() ? get_post()->post_name : '';
$is_page = is_page();
$parent_page = $is_page ? get_post( wp_get_post_parent_id() ) : null;
$parent_name = $parent_page ? $parent_page->post_name : '';
$is_launch = $is_page && ('launch' === $post_name || 'launch-party-waiting-list' === $post_name);
$is_circus = $is_page && 'may2circus' === $post_name;
$is_action = $is_page && 'action' === $post_name;
$is_volunteer = $is_page && 'volunteer' === $post_name;
$is_events = $is_page && 'circusparty' === $post_name;
$is_election_center = $is_page && ('election-center' === $post_name || 'election-center' === $parent_name);
$is_agenda = $is_page && '2019animalrights' === $post_name;
$is_deer = $is_page && 'statenislanddeer' === $post_name;
$is_membership = $is_page && 'membership' === $post_name;
$is_birds = $is_page && 'birds' === $post_name;
$is_puppy = $is_page && 'puppy' === $post_name;
$is_bags = $is_page && 'banplasticbags' === $post_name;
$is_opposed = $is_page && 'vfar-opposes-dec-proposal-to-remove-protections-from-wildlife-in-new-york' === $post_name;
$attachment_id = get_post_thumbnail_id();

$title = get_bloginfo('name');
$description = 'We work to elect candidates who support animal protection, lobby for stronger laws to stop animal cruelty, and hold elected officials accountable to humane voters.';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:article="http://ogp.me/ns/article#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# fb: https://www.facebook.com/2008/fbml#">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="icon" href="/logo.png" type="image/x-icon"/>
<link rel="shortcut icon" href="/logo.png" type="image/x-icon"/>
<meta property="fb:app_id" content="245483685859438" />
<meta property="og:site_name" content="<?php bloginfo( 'name' ) ?>" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@theanimalvoters" />
<meta name="twitter:creator" content="@theanimalvoters" />
<?php
if ( is_singular() && ! is_front_page() ) {
  $excerpt = strip_tags( get_the_excerpt() );
  if (empty($excerpt)) {
    $excerpt = $description;
  }
  $title = the_title_attribute([ 'echo' => false ]) . ' - ' . get_bloginfo('name');
  $description = $excerpt;

  $children = $is_page ? VFAR\getPageChildren() : null;
  $time_post = $children && count($children) > 0 ? reset( $children ) : get_post();

  $pub = mysql2date( DATE_W3C, $time_post->post_date_gmt, false );
  $mod = mysql2date( DATE_W3C, $time_post->post_modified_gmt, false );
?>
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink() ?>" />
<meta property="article:published_time" content="<?php echo $pub ?>" />
<?php if ($mod !== $pub) { ?>
  <meta property="article:modified_time" content="<?php echo $mod ?>" />
  <meta property="og:updated_time" content="<?php echo $mod ?>" />
<?php
}

  if ($is_election_center) {
    $title = 'Voters for Animal Rights’ 2020 New York General Election Endorsements - VOTE by November 3!';
  } elseif ($is_bags) {
    $title = 'Voters for Animal Rights’ Policy Recommendation on Plastic Bag Reduction, Reuse, and Recycling';
    $description = 'New York should be enforcing the ban on plastic bags, not weakening it.';
  } elseif ($is_puppy) {
    $title = 'ACTION ALERT: Ask your New York State Assembly Member to Support A.6298!';
    $description = '';
  } elseif ($is_action) {
    $title = 'NYC Council: Ban The Sale of Foie Gras From Force-Fed Birds';
    $description = 'Contact your City Council Member now.';
  } elseif ($is_opposed) {
    $title = 'VFAR Opposes DEC Proposal to Remove Protections from Wildlife in New York';
    $description = 'Changes will impact Humpback Whales, Ospreys, Cooper’s Hawks and other species.';
  } elseif ($is_birds) {
    $title = 'Tell your NYC Council Member to VOTE YES on Intro1482B To Protect NYC Birds From Glass Buildings';
    $description = 'Contact your City Council Member now.';
  } elseif ($is_events) {
    $title = 'Please RSVP';
    $description = '';
  }
} else { ?>
<meta property="og:url" content="<?php echo home_url() ?>" /><?php
}

if ( $is_launch ) {
  $image = WP_CONTENT_URL . '/themes/eshv/launch-kitten.jpg';
} elseif ( $is_deer ) {
  $image = 'https://vfar.org/wp-content/uploads/2019/11/Image-from-iOS.jpg';
} elseif ( $is_puppy ) {
  $image = WP_CONTENT_URL . '/themes/eshv/puppy.jpg';
} elseif ( $is_membership ) {
  $image = WP_CONTENT_URL . '/themes/eshv/membership_v2.jpg';
} elseif ( $is_events ) {
  $image = WP_CONTENT_URL . '/themes/eshv/circus-party.jpg';
} elseif ( $is_circus ) {
  $image = WP_CONTENT_URL . '/themes/eshv/circus-action.jpg';
} elseif ( $is_action ) {
  $image = WP_CONTENT_URL . '/themes/eshv/foie-v2.jpg';
} else if ( $is_volunteer ) {
  $image = WP_CONTENT_URL . '/themes/eshv/volunteer.jpg';
} else if ( $is_agenda ) {
  $image = WP_CONTENT_URL . '/themes/eshv/agenda-image.jpg';
} else if ( $is_opposed ) {
  $image = WP_CONTENT_URL . '/themes/eshv/opposed.jpg';
} else if ( $is_bags ) {
  $image = WP_CONTENT_URL . '/themes/eshv/banplasticbags.jpg';
} else if ( ! empty( $attachment_id ) ) {
  $atts = wp_get_attachment_image_src( $attachment_id, 'large' );
  $image = reset( $atts );
} else {
  $image = WP_CONTENT_URL . '/themes/eshv/splash-og.png';
}

if ( ! empty( $title ) ) { ?>
<meta property="og:title" content="<?php echo esc_attr( $title ) ?>" />
<meta name="twitter:title" content="<?php echo esc_attr( $title ) ?>" />
<?php }

if ( ! empty( $description ) ) { ?>
<meta property="og:description" content="<?php echo esc_attr( $description ) ?>" />
<meta name="twitter:description" content="<?php echo esc_attr( $description ) ?>" />
<meta name="twitter:text:description" content="<?php echo esc_attr( $description ) ?>" />
<?php }

if ( ! empty( $image ) ) { ?>
<meta property="og:image" content="<?php echo $image ?>" />
<meta name="twitter:image" content="<?php echo $image ?>" />
<?php }

?>
<script src="https://use.fontawesome.com/0554d22be7.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php echo VFAR\assetUrl( 'css/styles.css' ) ?>" rel="stylesheet" />
<?php
remove_all_actions( 'wpseo_twitter' );
remove_action( 'wpseo_head', array( 'WPSEO_Twitter', 'get_instance' ), 40 );
remove_all_actions( 'wpseo_opengraph' );
wp_head(); ?>
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
