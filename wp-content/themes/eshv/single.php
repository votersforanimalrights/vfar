<?php
the_post();

get_header() ?>
<article class="page-wrapper">
  <?php get_template_part('templates/hero'); ?>
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <header>
        <h1><?php the_title() ?></h1>
      </header>
      <?php the_content() ?>
    </div>
  </section>
</article>
<?php get_footer();
