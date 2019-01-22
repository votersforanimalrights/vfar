<?php get_header() ?>
<section class="page-wrapper">
  <section class="content centered-content page-content">
    <div class="page-content-wrapper archive-wrapper">
      <header>
        <h1>News</h1>
      </header>
      <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
        <article class="archive-post">
          <figure>
            <?php the_post_thumbnail('medium-large'); ?>
          </figure>
          <section>
            <header>
              <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
            </header>
            <p><?php echo ! empty( $post->post_excerpt ) ? get_the_excerpt() : '' ?></p>
          </section>
        </article>
      <?php endwhile; endif; ?>
    </div>
  </section>
</section>
<?php get_footer();
