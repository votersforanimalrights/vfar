<?php
/*
 * Template Name: Endorsements
 * Description: Displays the latest Endorsement post content
 */

the_post();

// Get the latest endorsement post
$endorsements = get_posts([
  'post_type' => 'vfar_endorsement',
  'posts_per_page' => 1,
  'orderby' => 'date',
  'order' => 'DESC',
  'post_status' => 'publish',
]);

get_header() ?>
<article class="page-wrapper">
  <?php get_template_part('templates/hero'); ?>
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <?php if (!empty($endorsements)):
        $endorsement = $endorsements[0];
      ?>
        <h2><?php echo esc_html($endorsement->post_title); ?></h2>
        <?php echo apply_filters('the_content', $endorsement->post_content); ?>
      <?php else: ?>
        <p>No endorsements have been published yet.</p>
      <?php endif; ?>
    </div>
  </section>
</article>
<?php get_footer();
