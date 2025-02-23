  <?php $display_current = get_post_meta($post->ID, 'pr_current_listing', true); ?>
  <?php $display_completed = get_post_meta($post->ID, 'pr_completed_listing', true); ?>

<?php
if (!$display_current && !$display_completed) {
  // Only show title on non-listing pages
  get_template_part( 'template-parts/entry-header' );
}
?>
<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="entry-content page-content">
  <div class="post-inner alignwide">
    <?php the_content(); ?>
  </div>

  <?php if ($display_current || $display_completed): ?>
  <?php if ($display_current === 'on') { ?>
  <?php $prop_query = new WP_Query(
    array(
      'post_type' => 'property_listing',
      'meta_query' => array(
        array(
          'key' => 'pr_property_display_as',
          'value' => 'Current'
        )
      )
    )
  );
  }
  if ($display_completed === 'on') { ?>
  <?php $prop_query = new WP_Query(
    array(
      'post_type' => 'property_listing',
      'meta_query' => array(
        array(
          'key' => 'pr_property_display_as',
          'value' => 'Completed'
        )
      )
    )
  );
  }
  if ($prop_query->have_posts()) :
    while ($prop_query->have_posts()) : $prop_query->the_post();
?>
    <div class="wp-block-group alignwide property-card">
<?php
// detail keys: teaser, highlights, price, size, address, type
$details = get_post_meta( get_the_ID(),'pr_property_details', true);
$property_type = isset($details['type']) ? $details['type'] : '';
$property_address = isset($details['address']) ? $details['address'] : '';
$property_size = isset($details['size']) ? $details['size'] : '';
$property_price = isset($details['price']) ? $details['price'] : '';
$property_highlights = isset($details['highlights']) ? $details['highlights'] : '';
$property_highlights2 = isset($details['highlights2']) ? $details['highlights2'] : '';
$image_data = get_post_gallery(get_the_ID(), false);
$has_images = $image_data && ! post_password_required() && count(explode(',',$image_data['ids'])) > 0;
$has_image_class = $has_images ? "" : "empty";
$property_teaser = isset($details['teaser']) ? $details['teaser'] : '';
$pdf = get_post_meta( get_the_ID(),'pr_property_pdf', true);
$pdf2 = get_post_meta( get_the_ID(),'pr_property_pdf2', true);
$pdf3 = get_post_meta( get_the_ID(),'pr_property_pdf3', true);
$pdf4 = get_post_meta( get_the_ID(),'pr_property_pdf4', true);
$pdf_button_text = get_post_meta( get_the_ID(),'pr_property_pdf_button', true) ? get_post_meta( get_the_ID(),'pr_property_pdf_button', true): "Download  PDF Brochure";
 $pdf2_button_text = get_post_meta( get_the_ID(),'pr_property_pdf2_button', true) ? get_post_meta( get_the_ID(),'pr_property_pdf2_button', true) : "Download PDF";
$pdf3_button_text = get_post_meta( get_the_ID(),'pr_property_pdf3_button', true) ? get_post_meta( get_the_ID(),'pr_property_pdf3_button', true) : "Download PDF";
 $pdf4_button_text = get_post_meta( get_the_ID(),'pr_property_pdf4_button', true) ? get_post_meta( get_the_ID(),'pr_property_pdf4_button', true) : "Download PDF";
$status = get_post_meta( get_the_ID(),'pr_property_listing_status', true);
$disposal_type_array = unserialize(get_post_meta( get_the_ID(),'pr_property_disposal_type', true));
if (is_array($disposal_type_array)) {
  $disposal_type = implode(' / ', $disposal_type_array);
} else {
  $disposal_type = "";
}
?>
          <div class="teaser-container full-width">
          <div class="main-image <?php echo $has_image_class?>">
            <?php if (!$has_images): ?>
              <div class="empty-text">Images coming soon</div>
            <?php endif; ?>
            <?php get_template_part( 'template-parts/lightbox', null, ['isteaser' => "true"] ) ?>
            <?php if ($status && $status !== 'None'): ?>
              <span class="status"><?=$status?></span>
            <?php endif; ?>
            </div>
            <div class="details">
              <div class="address">
                <h3 class="type"><?= $property_type ?? the_title() ?></h3>
                <?php if ($property_address) :?>
                <p class="detail address"><?= nl2br($property_address) ?></p>
                <?php endif; ?>
                <?php if ($disposal_type) :?>
                <div class="detail disposal"><?= nl2br($disposal_type) ?></div>
                <?php endif; ?>

                  <a href="<?php the_permalink(); ?>" class="button">
                    See more property details <span class="fa fa-arrow-right"></span>
                  </a>
              </div>
              <div class="info">
                <ul>
                <?php if ($property_size) :?>
                  <li class="detail size"><?= $property_size ?></li>
                <?php endif; ?>
                <?php if ($property_price) :?>
                  <li class="detail price"><?= $property_price ?></li>
                <?php endif; ?>
                <?php if ($property_highlights) :?>
                  <li class="detail highlights"><?= $property_highlights ?></li>
                <?php endif; ?>
                <?php if ($property_highlights2) :?>
                  <li class="detail highlights"><?= $property_highlights2 ?></li>
                <?php endif; ?>
                <?php if ($property_teaser) :?>
                  <li class="detail teaser"><?= $property_teaser ?></li>
                <?php endif; ?>
                </ul>
                <div class="pdf-buttons">
                  <?php if ($pdf && $pdf['url']) :?>
                  <a href="<?php echo $pdf['url'] ?>" class="button">
                    <?=$pdf_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                  <?php if ($pdf2 && $pdf2['url']) :?>
                  <a href="<?php echo $pdf2['url'] ?>" class="button">
                    <?=$pdf2_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                  <?php if ($pdf3 && $pdf3['url']) :?>
                  <a href="<?php echo $pdf3['url'] ?>" class="button">
                    <?=$pdf3_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                  <?php if ($pdf4 && $pdf4['url']) :?>
                  <a href="<?php echo $pdf4['url'] ?>" class="button">
                    <?=$pdf4_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
</div>
    </div>
            </div>
          </div>

          <div class="teaser-container compressed">
            <div class="image-title">
              <div class="main-image <?php echo $has_image_class?>">
              <?php if (!$has_images): ?>
                <div class="empty-text">Images coming soon</div>
              <?php endif; ?>
              <?php get_template_part( 'template-parts/lightbox', null, ['isteaser' => "true"] ) ?>
              <?php if ($status && $status !== 'None'): ?>
                <span class="status"><?=$status?></span>
              <?php endif; ?>
              </div>
              <div class="title-type-address">
                <h3 class="type"><?= $property_type ?? the_title() ?></h3>
                <?php if ($property_address) :?>
                  <p class="detail address"><?= trim(preg_replace("~\s*\R\s*~",", ", $property_address)) ?></p>
                <?php endif; ?>
                <?php if ($disposal_type) :?>
                  <div class="detail disposal"><?= nl2br($disposal_type) ?></div>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="button">
                  See more property details <span class="fa fa-arrow-right"></span>
                </a>
              </div>
            </div>
            <div class="info">
                <ul>
                <?php if ($property_size) :?>
                  <li class="detail size"><?= $property_size ?></li>
                <?php endif; ?>
                <?php if ($property_price) :?>
                  <li class="detail price"><?= $property_price ?></li>
                <?php endif; ?>
                <?php if ($property_highlights) :?>
                  <li class="detail highlights"><?= $property_highlights ?></li>
                <?php endif; ?>
                <?php if ($property_highlights2) :?>
                  <li class="detail highlights"><?= $property_highlights2 ?></li>
                <?php endif; ?>
                <?php if ($property_teaser) :?>
                  <li class="detail teaser"><?= $property_teaser ?></li>
                <?php endif; ?>
                </ul>
                <div class="pdf-buttons">
                  <?php if ($pdf && $pdf['url']) :?>
                  <a href="<?php echo $pdf['url'] ?>" class="button">
                    <?=$pdf_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                  <?php if ($pdf2 && $pdf2['url']) :?>
                  <a href="<?php echo $pdf2['url'] ?>" class="button">
                    <?=$pdf2_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                  <?php if ($pdf3 && $pdf3['url']) :?>
                  <a href="<?php echo $pdf3['url'] ?>" class="button">
                    <?=$pdf3_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                  <?php if ($pdf4 && $pdf4['url']) :?>
                  <a href="<?php echo $pdf4['url'] ?>" class="button">
                    <?=$pdf4_button_text ?> <span class="fa fa-file-pdf-o"></span>
                  </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php
      endwhile;
    endif;
    wp_reset_query();
  endif; ?> <!--- Propery teasers ---!>
</div>
