<?php
$no_title = ['2019animalrights', 'birds'];

if (has_post_thumbnail()) { ?>
<section class="hero">
    <?php
    the_post_thumbnail();

    if (is_front_page()) {
        echo wpautop(get_post()->post_excerpt);
    } else if ( ! in_array( get_post()->post_name, $no_title ) ) {
        echo wpautop(get_the_title());
    } ?>
</section>
<?php } ?>
