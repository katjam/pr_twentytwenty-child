<?php
/**
 * Header file for PR Twenty Twenty child theme.
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
<?php
wp_body_open();
?>
        <header id="site-header" class="header-footer-group" role="banner">
            <div class="header-inner section-inner">
                <div class="header-titles-wrapper">
<?php
// Check whether the header search is activated in the customizer.
$enable_header_search = get_theme_mod( 'enable_header_search', true );
if ( true === $enable_header_search ) {
?>
                    <button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                        <span class="toggle-inner">
                            <span class="toggle-icon">
                                <?php twentytwenty_the_theme_svg( 'search' ); ?>
                            </span>
                            <span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
                        </span>
                    </button><!-- .search-toggle -->
<?php } ?>

                    <div class="header-titles">
                        <div class="site-logo faux-heading">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-current="page">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logov2.svg" style="height: 92px; width: 300px;" class="custom-logo" alt="Philips Rogers logo" />
                            </a>
                            <span class="screen-reader-text">
                                Philips Rogers
                            </span>
                        </div>
<?php
    // Site description.
    twentytwenty_site_description();
?>
                    </div><!-- .header-titles -->


                </div><!-- .header-titles-wrapper -->
                <div class="contact">
                    <div class="email-phone">
                        <div class="email">
                            <span>
                                <a href="mailto:info@philipsrogers.co.uk" class="mailto">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <a href="mailto:info@philipsrogers.co.uk">
                                    info@philipsrogers.co.uk
                                </a>
                            </span>
                        </div>
                        <div class="phone">
                            <span>
                                <a href="tel:01208 812 812">
                                    <i class="fa fa-phone fa-flip-horizontal"></i>
                                </a>
                                <a href="tel:01208 812 812">
                                    01208 812 812
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="social">
                        <div>
                            <a class="linkedin" href="https://uk.linkedin.com/company/philips-rogers-ltd" title="View Philips Rogers\'s Linkedin Profile" target="_blank">
                                <i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- .header-inner -->
            <button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                <span class="toggle-inner">
                    <span class="toggle-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="7" viewBox="0 0 26 7">
<path fill="#ffffff" fill-rule="evenodd" d="M332.5,45 C330.567003,45 329,43.4329966 329,41.5 C329,39.5670034 330.567003,38 332.5,38 C334.432997,38 336,39.5670034 336,41.5 C336,43.4329966 334.432997,45 332.5,45 Z M342,45 C340.067003,45 338.5,43.4329966 338.5,41.5 C338.5,39.5670034 340.067003,38 342,38 C343.932997,38 345.5,39.5670034 345.5,41.5 C345.5,43.4329966 343.932997,45 342,45 Z M351.5,45 C349.567003,45 348,43.4329966 348,41.5 C348,39.5670034 349.567003,38 351.5,38 C353.432997,38 355,39.5670034 355,41.5 C355,43.4329966 353.432997,45 351.5,45 Z" transform="translate(-329 -38)"/>
</svg>
                    </span>
                    <span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
                </span>
            </button><!-- .nav-toggle -->

            <div class="header-navigation-wrapper">
<?php
    if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
?>

                <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>" role="navigation">

                    <ul class="primary-menu reset-list-style">

<?php
        if ( has_nav_menu( 'primary' ) ) {

            wp_nav_menu(
                array(
                    'container'  => '',
                    'items_wrap' => '%3$s',
                    'theme_location' => 'primary',
                )
            );

        } elseif ( ! has_nav_menu( 'expanded' ) ) {

            wp_list_pages(
                array(
                    'match_menu_classes' => true,
                    'show_sub_menu_icons' => true,
                    'title_li' => false,
                    'walker'   => new TwentyTwenty_Walker_Page(),
                )
            );

        }
?>

                    </ul>

                </nav><!-- .primary-menu-wrapper -->

<?php
    }

    if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
?>

                        <div class="header-toggles hide-no-js">

<?php
        if ( has_nav_menu( 'expanded' ) ) {
?>

                            <div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

                                <button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                                    <span class="toggle-inner">
                                        <span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
                                        <span class="toggle-icon">
                                            <?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
                                        </span>
                                    </span>
                                </button><!-- .nav-toggle -->

                            </div><!-- .nav-toggle-wrapper -->

<?php
        }

        if ( true === $enable_header_search ) {
?>

                            <div class="toggle-wrapper search-toggle-wrapper">

                                <button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
                                    <span class="toggle-inner">
                                        <?php twentytwenty_the_theme_svg( 'search' ); ?>
                                        <span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
                                    </span>
                                </button><!-- .search-toggle -->

                            </div>

<?php
        }
?>

                        </div><!-- .header-toggles -->
<?php
    }
?>

                </div><!-- .header-navigation-wrapper -->


<?php
    // Output the search modal (if it is activated in the customizer).
    if ( true === $enable_header_search ) {
        get_template_part( 'template-parts/modal-search' );
    }
?>

        </header><!-- #site-header -->

<?php
    // Output the menu modal.
    get_template_part( 'template-parts/modal-menu' );
