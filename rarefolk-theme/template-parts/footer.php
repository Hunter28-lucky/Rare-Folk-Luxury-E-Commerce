<?php
/**
 * Template Part: Footer
 *
 * @package RareFolk
 */

$brand_name = get_theme_mod( 'rarefolk_brand_name', 'Rare Folk' );
$copyright = get_theme_mod( 'rarefolk_copyright', '© 2024 Rare Folk. All Rights Reserved.' );
$developer = get_theme_mod( 'rarefolk_developer', 'Developed by Krish Goswami.' );
?>

<footer class="site-footer">
    <div class="container-padding">
        <div class="footer-grid">
            <div class="footer-brand">
                <div>
                    <span class="brand-name"><?php echo esc_html( $brand_name ); ?></span>
                    <p class="copyright text-body-md"><?php echo esc_html( $copyright ); ?></p>
                </div>
                <p class="developer text-body-md"><?php echo esc_html( $developer ); ?></p>
            </div>

            <div class="footer-links">
                <?php
                if ( has_nav_menu( 'footer-col-1' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer-col-1',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new Rarefolk_Footer_Nav_Walker(),
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <a class="footer-link text-body-md" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Sustainability</a>
                    <a class="footer-link text-body-md" href="<?php echo esc_url( home_url( '/legal/' ) ); ?>">Shipping &amp; Returns</a>
                    <?php
                }
                ?>
            </div>

            <div class="footer-links">
                <?php
                if ( has_nav_menu( 'footer-col-2' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer-col-2',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new Rarefolk_Footer_Nav_Walker(),
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <a class="footer-link text-body-md" href="<?php echo esc_url( home_url( '/legal/' ) ); ?>">Legal</a>
                    <a class="footer-link text-body-md" href="<?php echo esc_url( home_url( '/legal/#terms' ) ); ?>">Terms of Service</a>
                    <?php
                }
                ?>
            </div>

            <div class="footer-links">
                <?php
                if ( has_nav_menu( 'footer-col-3' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer-col-3',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new Rarefolk_Footer_Nav_Walker(),
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <a class="footer-link text-body-md" href="<?php echo esc_url( get_post_type_archive_link( 'journal_post' ) ); ?>">Journal</a>
                    <a class="footer-link text-body-md" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</footer>
