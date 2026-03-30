<?php
the_post();

get_header() ?>
<article class="page-wrapper">
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <h1><?php the_title(); ?></h1>
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail(); ?>
      <?php endif; ?>
      <?php the_content(); ?>
    </div>
  </section>
</article>
<?php get_footer();
