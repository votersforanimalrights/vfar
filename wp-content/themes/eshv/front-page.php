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
  <section class="content animal-content">
    <div class="animal-svg">
      <?php get_template_part('svg/companion-animals'); ?>
    </div>
    <div class="animal-svg">
      <?php get_template_part('svg/animals-used-for-food'); ?>
    </div>
    <div class="animal-svg">
      <?php get_template_part('svg/animals-used-for-clothing'); ?>
    </div>
    <div class="animal-svg">
      <?php get_template_part('svg/animals-in-the-wild'); ?>
    </div>
    <div class="animal-svg">
      <?php get_template_part('svg/animals-used-for-entertainment'); ?>
    </div>
  </section>
</article>
<?php get_footer() ?>
