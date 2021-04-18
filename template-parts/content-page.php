<?php get_template_part( 'template-parts/entry-header' ); ?>
<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="entry-content page-content">
  <div class="post-inner">
    <?php the_content(); ?>
  </div>

  <?php $display_listings = get_post_meta($post->ID, 'pr_property_teasers', true); ?>
  <?php if ($display_listings === 'on'): ?>
    <h2 class="alignwide">Available Property:</h2>
    <?php $prop_query = new WP_Query(array('post_type' => 'property_listing'));
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
$property_teaser = isset($details['teaser']) ? $details['teaser'] : '';
$pdf = get_post_meta( get_the_ID(),'pr_property_pdf', true);
$status = get_post_meta( get_the_ID(),'pr_property_listing_status', true);
$disposal_type = get_post_meta( get_the_ID(),'pr_property_disposal_type', true);
?>
          <div class="row">
            <div class="column">
            <?php the_post_thumbnail('medium'); ?>
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
            <p class="detail disposal"><?= nl2br($disposal_type) ?></p>
            <?php endif; ?>
            <?php if ($property_size) :?>
            <p class="detail size">
              <span class="fa fa-arrows-alt"></span> <?= $property_size ?>
            </p>
            <?php endif; ?>
            <?php if ($property_price) :?>
            <p class="detail price">
              <span class="fa fa-gbp"></span> <?= $property_price ?>
            </p>
            <?php endif; ?>
            <?php if ($property_highlights) :?>
            <p class="detail highlights">
              <span class="fa fa-star"></span> <?= $property_highlights ?>
            </p>
            <?php endif; ?>
            <?php if ($property_teaser) :?>
            <p class="detail teaser">
              <span class="fa fa-check"></span> <?= $property_teaser ?>
            </p>
            <?php endif; ?>
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
