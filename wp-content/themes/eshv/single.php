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
?>
<article class="page-wrapper">
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <header>
        <h1><?php the_title() ?></h1>
      </header>
      <?php the_post_thumbnail(); ?>
      <section class="post-content">
        <p class="byline-time">
          By <span class="byline">
            <span class="author vcard"><?php echo get_the_author() ?></span>
          </span>
          <span class="posted-on">
            <span class="screen-reader-text">Posted on</span>
            <?php echo vfar_time() ?>
          </span>
        </p>
      <?php the_content() ?>
      </section>
    </div>
  </section>
</article>
<?php get_footer();
