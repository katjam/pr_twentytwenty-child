<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 */

?>
            <footer id="site-footer" role="contentinfo" class="header-footer-group">

                <div class="section-inner">

                <div class="footer-credits">
                    <div class="info">
                        <p>
                            Philips Rogers is a limited company registered in England and Wales. Registered number: 10750484.
                        </p>
                        <p>
                            Registered office: Trudgeon Halling, The Platt, Wadebridge, PL27 7AE (service address only)
                        </p>
                        <p class="footer-copyright">&copy;
<?php
echo date_i18n(
    /* translators: Copyright date format, see https://www.php.net/manual/datetime.format.php */
    _x( 'Y', 'copyright date format', 'twentytwenty' )
);
?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                        </p><!-- .footer-copyright -->
                    </div>
                </div><!-- .footer-credits -->
                <div class="rics-logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/REGULATED-BY-RICS-LOGO_WHITE.png" />
                </div>
            </div><!-- .section-inner -->

        </footer><!-- #site-footer -->

        <?php wp_footer(); ?>

    </body>
</html>
