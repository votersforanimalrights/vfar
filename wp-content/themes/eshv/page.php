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

$children = get_posts(array(
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'orderby' => 'menu_order',
  'order' => 'ASC',
));

get_header() ?>
<article class="page-wrapper">
  <?php
  get_template_part('templates/hero');
  ?>
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <?php
      if (count($children) > 0) {
        foreach ($children as $child) { ?>
        <div id="<?php echo $child->post_name ?>" class="child-page">
          <h2><?php echo $child->post_title ?></h2>
          <?php echo apply_filters('the_content', $child->post_content) ?>
        </div>
      <?php }
      } else {
        the_content();
      }
      ?>
    </div>
  </section>
</article>
<?php get_footer() ?>
