<?php
/*
 * Template Name: Generic Page Template
 * Description: Page template with title and content
 */

the_post();

$crumbs = '';
$p = get_post();
$parent = null;
if ($p->post_parent > 0) {
  $parent = get_post( $p->post_parent );
  $crumbs = sprintf(
    '<div class="crumbs"><a href="%s">%s</a> &nbsp;&raquo;&nbsp; %s</div>',
    get_permalink($parent),
    $parent->post_title,
    $post->post_title
  );
} else {
  $crumbs = $post->post_title;
}

get_header() ?>
<article class="page-wrapper">
    <?php get_template_part('templates/hero'); ?>
    <section class="content centered-content page-content">
        <div class="page-content-wrapper">
            <?php echo $crumbs ?>
            <?php the_content() ?>
        </div>
    </section>
</article>
<?php get_footer();
