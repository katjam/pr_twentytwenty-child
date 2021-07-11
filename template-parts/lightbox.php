<?php
/**
 * Displays the post gallery in a lightbox
 */

// The images src will have thumbnail size appended to them
// e.g.  -150x150 the elm processes to get full and thumb src
$image_ids = get_post_gallery(get_the_ID(), false)['ids'];
$image_urls = [];

foreach (explode(',',$image_ids) as $id) {
  $image_urls[] = [
    'thumbSrc' => wp_get_attachment_image_src($id, 'thumbnail')[0],
    'fullSrc' => wp_get_attachment_image_src($id, 'large')[0]
  ];
}

if ( (count($image_urls) > 0) && ! post_password_required() ) {

    $featured_media_inner_classes = '';

    // Make the featured media thinner on archive pages.
    if ( ! is_singular() ) {
        $featured_media_inner_classes .= ' medium';
    }
?>
    <figure class="featured-media">

        <div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">

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
