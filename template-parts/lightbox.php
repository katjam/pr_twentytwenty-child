<?php
/**
 * Displays the featured image
 */

if ( has_post_thumbnail() && ! post_password_required() ) {

    $featured_media_inner_classes = '';

    // Make the featured media thinner on archive pages.
    if ( ! is_singular() ) {
        $featured_media_inner_classes .= ' medium';
    }
?>
    <figure class="featured-media">

        <div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
    <!-- The images src will have thumbnail size appended to them -->
    <!-- e.g.  -150x150 the elm processes to get full and thumb src -->
    <?php $image_urls = get_post_gallery_images(get_the_ID())?>
    <div id="lightbox"></div>
    <script>
      var app = Elm.LightBox.init({
      node: document.getElementById('lightbox'),
      flags: <?= json_encode($image_urls) ?>
    });
    </script>
        </div><!-- .featured-media-inner -->

    </figure><!-- .featured-media -->

<?php
}
