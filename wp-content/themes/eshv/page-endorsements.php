<?php
/*
 * Template Name: Past Endorsements
 * Description: Displays all Endorsement posts except the latest
 */

the_post();

// Get the latest endorsement
$latest = get_posts([
  'post_type' => 'vfar_endorsement',
  'posts_per_page' => 1,
  'orderby' => 'date',
  'order' => 'DESC',
  'post_status' => 'publish',
]);

// Get all endorsement posts except the latest
$endorsements = get_posts([
  'post_type' => 'vfar_endorsement',
  'posts_per_page' => -1,
  'orderby' => 'date',
  'order' => 'DESC',
  'post_status' => 'publish',
  'post__not_in' => !empty($latest) ? [ $latest[0]->ID ] : [],
]);

get_header() ?>
<article class="page-wrapper">
  <?php get_template_part('templates/hero'); ?>
  <section class="content centered-content page-content">
    <div class="page-content-wrapper">
    NOTE: CURRENT ENDORSEMENTS ARE <a href="https://vfar.org/voterguide/"><strong>POSTED HERE.</strong></a>
    <hr />
    <br/>
    <p>How do we decide who to support? All candidates complete a questionnaire and some are invited to participate in a Zoom interview; after which our Elections Team and Board of Directors evaluates and votes. Click on each candidate's name to read their responses. Please remember that while the questionnaires are very important, they are just one of the factors that we use when considering an endorsement for a candidate. Interviews give us an opportunity to go more in depth with our candidates and to confirm their positions on record.</p>
    <hr />
    <br/>

      <?php if (!empty($endorsements)): ?>
        <?php foreach ($endorsements as $endorsement): ?>
          <div class="past-endorsement">
            <h2><?php echo esc_html($endorsement->post_title); ?></h2>
            <div style="margin: 20px 0">
            <?php echo apply_filters('the_content', $endorsement->post_content); ?>
            <p><br/></p>
            <hr />
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No past endorsements found.</p>
      <?php endif; ?>
    </div>
  </section>
</article>
<?php get_footer();
