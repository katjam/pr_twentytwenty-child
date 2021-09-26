<?php
  $id = get_the_ID();
  // detail keys: teaser, highlights, price, size, address, type
  $details = get_post_meta( get_the_ID(),'pr_property_details', true);
  $property_type = isset($details['type']) ? $details['type'] : '';
  $page_heading = $property_type ? $property_type : get_the_title();
  $property_address = isset($details['address']) ? $details['address'] : '';
  $property_size = isset($details['size']) ? $details['size'] : '';
  $property_price = isset($details['price']) ? $details['price'] : '';
  $property_highlights = isset($details['highlights']) ? $details['highlights'] : '';
  $property_highlights2 = isset($details['highlights2']) ? $details['highlights2'] : '';
  $pdf = get_post_meta( get_the_ID(),'pr_property_pdf', true);
  $status = get_post_meta( get_the_ID(),'pr_property_listing_status', true);
  $disposal_type_array = unserialize(get_post_meta( get_the_ID(),'pr_property_disposal_type', true));
  $disposal_type = implode(' / ', $disposal_type_array);
?>

<article <?php post_class(); ?> id="post-<?= $id; ?>">
    <header class="entry-header header-footer-group">
      <div class="entry-header-inner section-inner medium">
        <h1 class="entry-title"><?= $page_heading ?></h1>
        <?php if($status && $status !== 'None'): ?>
          <h3 class="status"><?=$status?></h3>
        <?php endif; ?>
        <h3 class="detail disposal"><?= $disposal_type ?></h3>
        <?php if($pdf && $pdf['url'] != '' ): ?>
        <div class="pdf">
          <a href="<?php echo $pdf['url']; ?>" role="button" class="button">
            <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
          </a>
        </div>
        <?php endif; ?>
        <div class="detail summary">
          <h2><?= $property_address ?></h2>
          <h3><?= $property_size ?></h3>
          <h3><?= $property_price ?></h3>
          <h3><?= $property_highlights ?></h3>
          <h3><?= $property_highlights2 ?></h3>
        </div>
      </div>
    </header>
    <?php get_template_part( 'template-parts/lightbox', null, ['isteaser' => "false"] ) ?>
    <div class="post-inner alignwide">
      <div class="entry-content">
        <div class="alignwide">
            <?php the_content(); ?>
        </div>
        <?php if($pdf && $pdf['url'] != '' ): ?>
        <div class="pdf">
          <a href="<?php echo $pdf['url']; ?>" role="button" class="button">
            <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
          </a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </article>
