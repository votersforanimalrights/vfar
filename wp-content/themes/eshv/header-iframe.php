<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<meta property="fb:app_id" content="245483685859438" />
<script src="https://use.fontawesome.com/0554d22be7.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php echo ESHV\assetUrl( 'css/styles.css' ) ?>" rel="stylesheet" />
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
<main class="main">
