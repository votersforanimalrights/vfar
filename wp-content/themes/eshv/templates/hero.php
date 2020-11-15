<?php
$_post = get_post();
$_post_parent_id = $_post->post_parent;

$no_title = get_post_meta( $_post->ID, 'vfar_page_hide_title_over_image', true ) === 'yes';

if ( has_post_thumbnail() ) {
  $thumb = get_the_post_thumbnail();
  $thumb_post = get_post();
} else if ($_post_parent_id && has_post_thumbnail( $_post_parent_id ) ) {
  $thumb = get_the_post_thumbnail( $_post_parent_id );
  $thumb_post = get_post( $_post_parent_id );
}

if ($thumb) { ?>
<section class="hero">
    <?php
    echo $thumb;

    if (is_front_page()) {
        echo wpautop( $thumb_post->post_excerpt );
    } else if ( ! $no_title ) {
        echo wpautop( get_the_title( $thumb_post ) );
    } ?>
</section>
<?php } ?>
