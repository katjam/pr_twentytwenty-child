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
  $pdf2 = get_post_meta( get_the_ID(),'pr_property_pdf2', true);
  $pdf3 = get_post_meta( get_the_ID(),'pr_property_pdf3', true);
  $pdf4 = get_post_meta( get_the_ID(),'pr_property_pdf4', true);
  $status = get_post_meta( get_the_ID(),'pr_property_listing_status', true);
  $disposal_type_array = unserialize(get_post_meta( get_the_ID(),'pr_property_disposal_type', true));
  $disposal_type = is_array($disposal_type_array) ? implode(' / ', $disposal_type_array) : '';
?>

<article <?php post_class(); ?> id="post-<?= $id; ?>">
    <header class="entry-header header-footer-group">
      <div class="entry-header-inner section-inner medium">
        <h1 class="entry-title"><?= $page_heading ?></h1>

        <h3 class="detail disposal">
          <?= $disposal_type ?>
          <?php if($status && $status !== 'None'): ?>
            <span class="status"><?=$status?></span>
          <?php endif; ?>
        </h3>
        <div class="pdf-buttons">
          <?php if($pdf && $pdf['url'] != '' ): ?>
          <div class="pdf">
            <a href="<?php echo $pdf['url']; ?>" role="button" class="button">
              <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
            </a>
          </div>
          <?php endif; ?>
          <?php if($pdf2 && $pdf2['url'] != '' ): ?>
          <div class="pdf">
            <a href="<?php echo $pdf2['url']; ?>" role="button" class="button">
              <span class="fa fa-file-pdf-o"></span>Download PDF 2
            </a>
          </div>
          <?php endif; ?>
          <?php if($pdf3 && $pdf3['url'] != '' ): ?>
          <div class="pdf">
            <a href="<?php echo $pdf3['url']; ?>" role="button" class="button">
              <span class="fa fa-file-pdf-o"></span>Download PDF 3
            </a>
          </div>
          <?php endif; ?>
          <?php if($pdf4 && $pdf4['url'] != '' ): ?>
          <div class="pdf">
            <a href="<?php echo $pdf4['url']; ?>" role="button" class="button lastof4">
              <span class="fa fa-file-pdf-o"></span>Download PDF 4
            </a>
          </div>
          <?php endif; ?>
        </div>
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
