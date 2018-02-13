</main>
<footer class="footer">
  <div class="columns">
    <div class="column left-column">
      <h3>Follow Us</h3>
      <nav>
        <a href="https://www.facebook.com/votersforanimalrights/" target="_blank" class="fa fa-facebook"></a>
        <a href="https://twitter.com/theanimalvoters" target="_blank" class="fa fa-twitter"></a>
        <a href="https://www.instagram.com/votersforanimalrights/" target="_blank" class="fa fa-instagram"></a>
      </nav>
    </div>
    <div class="column right-column">
      <?php
      $links = VFAR\Theme::getNavMenuItems( 'footer-links' );
      if ( ! empty( $links ) ): ?>
      <nav class="nav-column">
        <?php
        foreach ( $links as $link ) {
          printf(
            '<a href="%s">%s</a>',
            $link->url,
            $link->title
          );
        }
        ?>
      </nav>
      <?php endif;

      echo VFAR\Theme::renderSidebar( 'footer', [
        'year' => date( 'Y' ),
        'site_name' => get_bloginfo( 'name' ),
      ] ) ?>
    </div>
  </div>
</footer>
<?php wp_footer() ?>
<script src="<?php echo VFAR\assetUrl( 'js/main.js' ) ?>"></script>
</body>
</html>
