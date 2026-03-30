<?php
/*
 * Template Name: Past Endorsements
 * Description: Displays all Endorsement posts except the latest
 */

the_post();

// Get all endorsement posts except the latest
$endorsements = get_posts([
  'post_type' => 'vfar_endorsement',
  'posts_per_page' => -1,
  'orderby' => 'date',
  'order' => 'DESC',
  'post_status' => 'publish',
  'offset' => 1,
]);

get_header() ?>
<article class="page-wrapper">
  <?php get_template_part('templates/hero'); ?>
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
      <?php if (!empty($endorsements)): ?>
        <?php foreach ($endorsements as $endorsement): ?>
          <div class="past-endorsement">
            <h2><?php echo esc_html($endorsement->post_title); ?></h2>
            <?php echo apply_filters('the_content', $endorsement->post_content); ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No past endorsements found.</p>
      <?php endif; ?>
    </div>
  </section>
</article>
<?php get_footer();
