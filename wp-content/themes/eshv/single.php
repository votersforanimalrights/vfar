<?php
the_post();

get_header();

function vfar_time() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  return sprintf(
    $time_string,
    get_the_date( DATE_W3C ),
    get_the_date(),
    get_the_modified_date( DATE_W3C ),
    get_the_modified_date()
  );
}

$twitter = get_the_author_meta('twitter');
$email = get_the_author_meta('email');
?>
<article class="page-wrapper">
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <header>
        <h1><?php the_title() ?></h1>
      </header>
      <?php the_post_thumbnail(); ?>
      <section class="post-content">
        <div class="byline-time">
          By <span class="byline">
            <span class="author vcard"><?php echo get_the_author() ?></span>
            <?php if (!empty($twitter)): ?>
              <span class="sep"></span>
              <a href="https://twitter.com/<?php echo esc_url( $twitter ) ?>">Twitter</a>
            <?php endif; ?>
            <?php if (!empty($email)): ?>
              <span class="sep"></span>
              <a href="mailto:<?php echo esc_url( $email ) ?>">Email</a>
            <?php endif; ?>
          </span>
          <span class="posted-on">
            Posted on <span><?php echo vfar_time() ?></span>
          </span>
        </div>
      <?php the_content() ?>
      </section>
    </div>
  </section>
</article>
<?php get_footer();
