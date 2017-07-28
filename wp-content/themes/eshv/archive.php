<?php get_header() ?>
<section class="page-wrapper">
  <section class="content centered-content page-content">
    <div class="page-content-wrapper archive-wrapper">
      <header>
        <h1>Press Releases</h1>
      </header>
      <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
        <article>
          <header>
            <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
          </header>
        </article>
      <?php endwhile; endif; ?>
    </div>
  </section>
</section>
<?php get_footer();
