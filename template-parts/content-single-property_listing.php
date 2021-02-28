<?php $id = get_the_ID(); ?>
<?php $pdf = get_post_meta( $id, 'pr_property_listing_pdf', true); ?>
<?php $status = get_post_meta( $id, 'pr_property_listing_status', true); ?>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="page-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </div>
    <div class="page-content">
        <?php if($pdf && $pdf['url'] != '' ): ?>
        <div style="padding-bottom: 1.2em;">
          <a href="<?php echo $pdf['url']; ?>" role="button" class="button">
            <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
          </a>
        </div>
        <?php endif; ?>
        <?php if($status && $status !== 'None'): ?>
          <h3 class="status"><?=$status?></h3>
        <?php endif; ?>
        <div>
            <?php the_content(); ?>
        </div>
        <?php if($pdf && $pdf['url'] != '' ): ?>
        <div style="padding-bottom: 2em;">
          <a href="<?php echo $pdf['url']; ?>" role="button" class="button">
            <span class="fa fa-file-pdf-o"></span>Download PDF Brochure
          </a>
        </div>
        <?php endif; ?>
      </div>
  </article>
<?php endwhile; ?>
