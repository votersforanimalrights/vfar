<?php
the_post();

get_header() ?>
<article class="page-wrapper">
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <header>
        <h1><?php the_title() ?></h1>
      </header>
      <?php the_post_thumbnail(); ?>
      <?php the_content() ?>
    </div>
  </section>
</article>
<?php get_footer();
