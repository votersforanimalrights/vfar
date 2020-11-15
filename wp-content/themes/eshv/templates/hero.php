<?php
$no_title = ['2019animalrights', '2021animalrights', 'birds', 'victories'];

if ( has_post_thumbnail() ) {
  $thumb = get_the_post_thumbnail();
  $thumb_post = get_post();
} else if (wp_get_post_parent_id() && has_post_thumbnail( wp_get_post_parent_id() ) ) {
  $thumb = get_the_post_thumbnail( wp_get_post_parent_id() );
  $thumb_post = get_post( wp_get_post_parent_id() );
}

if ($thumb) { ?>
<section class="hero">
    <?php
    echo $thumb;

    if (is_front_page()) {
        echo wpautop( $thumb_post->post_excerpt );
    } else if ( ! in_array( $thumb_post->post_name, $no_title ) ) {
        echo wpautop( get_the_title( $thumb_post ) );
    } ?>
</section>
<?php } ?>
