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
</article>
<?php get_footer() ?>
