<?php
the_post();

get_header() ?>
<article>
  <?php
  get_template_part('templates/hero');
  get_template_part('templates/subscribe-bar');
  ?>
  <section class="content">
    <?php the_content() ?>
  </section>
</article>
<?php get_footer() ?>
