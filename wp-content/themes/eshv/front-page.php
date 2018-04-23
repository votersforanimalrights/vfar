<?php
the_post();

get_header() ?>
<article>
  <?php
  get_template_part('templates/hero');
  get_template_part('templates/subscribe-bar');
  ?>
  <section class="content">
    <div class="home-content">
      <?php the_content() ?>
    </div>
  </section>
  <section class="content animal-content">
    <p><strong>We campaign for all animals.</strong></p>
    <?php get_template_part('templates/animals') ?>
  </section>
  <?php get_template_part('templates/agenda-issues'); ?>
</article>
<?php get_footer() ?>
