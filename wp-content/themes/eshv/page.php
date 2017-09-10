<?php
the_post();

$is_iframe = get_query_var('iframe', 100) !== 100;

if ($is_iframe) {
  get_header('iframe') ?>
  <article class="page-wrapper">
    <section class="content centered-content page-content">
      <div class="page-content-wrapper">
        <?php the_content() ?>
      </div>
    </section>
  </article>
  <?php get_footer('iframe');
  return;
}

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
