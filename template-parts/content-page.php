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
        <div class="wp-block-group alignwide has-background" style="background-color: #d3d3d3">
        <?php $status = get_post_meta( get_the_ID(), 'pr_property_listing_status', true); ?>
          <div>
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
            <?php $pdf_field = get_post_meta( get_the_ID(), 'pr_property_pdf', true); ?>
            <?php if ($pdf_field && $pdf_field['url']) :?>
              <a href="<?php echo $pdf_field['url'] ?>" role="button" class="button">
                <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
              </a>
            <?php endif; ?>
          </div>
        </div>


          <?php
        endwhile;
      endif;
      wp_reset_query();
    endif; ?> <!--- Propery teasers ---!>
</div>
