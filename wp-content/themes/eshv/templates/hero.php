<?php if (has_post_thumbnail()) { ?>
<section class="hero">
    <?php
    the_post_thumbnail();

    if (is_front_page()) {
        echo wpautop(get_post()->post_excerpt);
    } else {
        echo wpautop(get_the_title());
    } ?>
</section>
<?php } ?>
