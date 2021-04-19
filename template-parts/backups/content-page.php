<div class="page-content">
  <div class="d-md-flex">
      <div><?php the_content(); ?></div>
      <div class="pl-md-2 pb-2">
        <?php the_post_thumbnail( 'main-page' ); ?>
      </div>
  </div>
  <?php $display_listings = get_post_meta($post->ID, 'pr_property_teasers', true); ?>
  <?php if ($display_listings === 'on'): ?>
    <div><h2><b>Philips Rogers Available Property:</b></h2><div>
    <?php $prop_query = new WP_Query(array(
      'post_type' => 'property_listing'));
      if ($prop_query->have_posts()) :
        while ($prop_query->have_posts()) : $prop_query->the_post();
          ?>
          <div class="d-md-flex pb-md-2">
              <?php $status = get_post_meta( get_the_ID(), 'pr_property_listing_status', true); ?>
                  <div class="pr-md-2">
                      <div class="pr-prop-teaser-image">
                      <?php the_post_thumbnail('medium'); ?>
                      <?php if ($status && $status !== 'None'): ?>
                      <span class="status"><?=$status?></span>
                      <?php endif; ?>
                      </div>
              </div>
              <div>
              <h3><?php the_title(); ?></h3>
              <p>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                See more property details
                </a>
              </p>
              <div style="margin-bottom: 50px;" >
              <?php $pdf_field = get_post_meta( get_the_ID(), 'pr_property_listing_pdf', true); ?>
              <?php if ($pdf_field && $pdf_field['url']) :?>
              <a href="<?php echo $pdf_field['url'] ?>" role="button" class="button">
                <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
              </a>
              <?php endif; ?>
              </div>
              </div>
            </div>

          <?php
        endwhile;
      endif;
      wp_reset_query();
    ?>
  <?php endif; ?>
  <?php $pr_img_text_sets = get_post_meta($post->ID, 'pr_img_text_sets', true);
        if ( $pr_img_text_sets ) : ?>
          <?php foreach ( $pr_img_text_sets as $field ) { ?>
          <div class="d-md-flex pb-md-2">
              <?php if($field['image'] != '') echo '<div class="pr-md-2"><img src="'. esc_attr( $field['image'] ) . '" style="max-width: 350px;" /></div>'; ?>
              <div>
                <?php if($field['heading'] != '') echo '<h3>'. esc_attr( $field['heading'] ) . '</h3>'; ?>
                <?php if($field['text'] != '') echo '<p>'. esc_attr( $field['text'] ) . '</p>'; ?>
                <?php if($field['pdf_src'] != '' && $field['pdf_src'] != 'No pdf'): ?>
                  <a href="<?php echo $field['pdf_src'] ?>" role="button" class="button"><span class="fa fa-file-pdf-o"></span>Download PDF Brochure</a>
                <?php endif;?>
              </div>
            </div>
          <?php } ?>
        <?php endif; ?>
      </div>
    </div>
</div>
