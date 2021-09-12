<?php get_template_part( 'template-parts/entry-header' ); ?>
<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="entry-content page-content">
  <div class="post-inner alignwide">
    <?php the_content(); ?>
  </div>

  <?php $display_current = get_post_meta($post->ID, 'pr_current_listing', true); ?>
  <?php $display_completed = get_post_meta($post->ID, 'pr_completed_listing', true); ?>
  <?php if ($display_current || $display_completed): ?>
  <?php if ($display_current === 'on') { ?>
    <h2 class="alignwide">Available Property:</h2>
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
    <h2 class="alignwide">Completed Projects:</h2>
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
$property_teaser = isset($details['teaser']) ? $details['teaser'] : '';
$pdf = get_post_meta( get_the_ID(),'pr_property_pdf', true);
$status = get_post_meta( get_the_ID(),'pr_property_listing_status', true);
$disposal_type_array = unserialize(get_post_meta( get_the_ID(),'pr_property_disposal_type', true));
if (is_array($disposal_type_array)) {
  $disposal_type = implode(' / ', $disposal_type_array);
} else {
  $disposal_type = "";
}
?>
          <div class="row">
            <div class="column main-image">
            <?php get_template_part( 'template-parts/lightbox', null, ['isteaser' => "true"] ) ?>
            <?php if ($status && $status !== 'None'): ?>
              <span class="status"><?=$status?></span>
            <?php endif; ?>
            </div>
            <div class="column">
              <h3 class="type"><?= $property_type ?? the_title() ?></h3>
              <?php if ($property_address) :?>
              <p class="detail address"><?= nl2br($property_address) ?></p>
              <?php endif; ?>
            </div>
          </div>
          <div>
            <?php if ($disposal_type) :?>
            <div class="detail disposal"><?= nl2br($disposal_type) ?></div>
            <?php endif; ?>
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
            <div class="row">
              <div class="column">
                <a href="<?php the_permalink(); ?>" class="button">
                See more property details <span class="fa fa-arrow-right"></span>
                </a>
              </div>
              <?php if ($pdf && $pdf['url']) :?>
              <div class="column">
                <a href="<?php echo $pdf['url'] ?>" class="button">
                  Download PDF Brochure <span class="fa fa-file-pdf-o"></span>
                  </a>
              </div>
            <?php endif; ?>
            </div>
          </div>
        </div>


          <?php
        endwhile;
      endif;
      wp_reset_query();
    endif; ?> <!--- Propery teasers ---!>
</div>
