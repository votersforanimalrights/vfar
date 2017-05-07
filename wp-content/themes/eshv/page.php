<?php
the_post();

get_header() ?>
<article class="page-wrapper">
  <?php
  get_template_part('templates/hero');
  ?>
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <?php the_content() ?>
    </div>
  </section>
</article>
<?php get_footer() ?>
