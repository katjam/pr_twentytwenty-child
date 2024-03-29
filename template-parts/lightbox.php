<?php
/**
 * Displays the post gallery in a lightbox
 */

$image_data = get_post_gallery(get_the_ID(), false);
$is_teaser = isset($args['isteaser']) ? $args['isteaser'] : "false";

if ( $image_data && ! post_password_required() ) {
$image_ids = $image_data['ids'];
$image_urls = [];

foreach (explode(',',$image_ids) as $id) {
  $image_urls[] = [
    'thumbSrc' => wp_get_attachment_image_src($id, 'thumbnail')[0],
    'fullSrc' => wp_get_attachment_image_src($id, 'large')[0],
    'altText' => get_post_meta( $id, '_wp_attachment_image_alt', true )
  ];
}

?>
    <figure class="<?php echo $is_teaser === 'true' ? '' : 'featured-media' ?>">
      <div class="<?php echo $is_teaser === 'true' ? '' : 'section-inner' ?>">
        <div id="lightbox"></div>
        <script>
          var app = Elm.LightBox.init({
          node: document.getElementById('lightbox'),
          flags: {
            isTeaser: <?= json_encode($is_teaser) ?>,
            imageList: <?= json_encode($image_urls) ?>
          }
        });
        </script>
      </div>
    </figure><!-- .featured-media -->

<?php
}
