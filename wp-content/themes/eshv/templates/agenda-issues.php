<?php
$issues = get_posts([
  'post_type' => 'vfar_agenda_item',
  'posts_per_page' => -1,
  'order' => 'ASC',
  'orderby' => 'ID',
]);

?>
<section class="content agenda-content">
  <p><strong>Explore Our Current Agenda Issues</strong></p>
  <ul>
    <?php foreach ( $issues as $issue ) {
      $thumb_id = get_post_thumbnail_id( $issue );
      [$src] = wp_get_attachment_image_src( $thumb_id, 'full' );
      $done = get_post_meta( $issue->ID, 'vfar_agenda_item_done', true ) === 'yes';
    ?>
      <li>
        <img src="<?php echo $src ?>" class="background" />
        <div class="agenda-overlay"></div>
        <?php if ( $done ) { ?>
          <img src="/wp-content/themes/eshv/images/done.png" class="done" />
        <?php } ?>
        <span><?php echo nl2br( get_post_meta( $issue->ID, 'vfar_agenda_item_title', true ) ) ?></span>
        <section data-button-url="<?php echo get_post_meta( $issue->ID, 'vfar_agenda_item_button_url', true  ?>">
          <div class="agenda-image">
            <img src="<?php echo $src ?>" />
          </div>
          <article>
            <strong><?php echo get_the_title( $issue ); ?></strong>
            <?php echo apply_filters( 'the_content', $issue->post_content ) ?>
        </section>
      </li>
    <?php } ?>
  </ul>
</section>
