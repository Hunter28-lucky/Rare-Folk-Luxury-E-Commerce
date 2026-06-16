<?php
/**
 * Template Part: Mobile Menu Drawer
 *
 * @package RareFolk
 */

$brand_name = get_theme_mod( 'rarefolk_brand_name', 'Rare Folk' );
$instagram = get_theme_mod( 'rarefolk_instagram', '#' );
$pinterest = get_theme_mod( 'rarefolk_pinterest', '#' );
?>

<div id="mobile-menu" class="mobile-menu-overlay">
    <div class="mobile-menu-drawer" id="mobile-menu-content">
        <div>
            <div class="mobile-menu-header">
                <span class="brand-logo" style="font-size: 32px;"><?php echo esc_html( $brand_name ); ?></span>
                <button id="close-menu-btn" class="nav-icon-btn" aria-label="<?php esc_attr_e( 'Close Menu', 'rarefolk' ); ?>">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="mobile-menu-links">
                <?php
                if ( has_nav_menu( 'mobile' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'mobile',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new Rarefolk_Mobile_Nav_Walker(),
                        'depth'          => 1,
                    ) );
                } elseif ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'walker'         => new Rarefolk_Mobile_Nav_Walker(),
                        'depth'          => 1,
                    ) );
                } else {
                    ?>
                    <a class="mobile-menu-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">Collections</a>
                    <a class="mobile-menu-link" href="<?php echo esc_url( get_post_type_archive_link( 'journal_post' ) ); ?>">Narratives</a>
                    <a class="mobile-menu-link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Archives</a>
                    <a class="mobile-menu-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Boutique</a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="mobile-menu-footer">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                <span class="material-symbols-outlined" style="font-size: 20px;">mail</span>
                <?php esc_html_e( 'Contact Us', 'rarefolk' ); ?>
            </a>
            <div class="mobile-social-links">
                <?php if ( $instagram && $instagram !== '#' ) : ?>
                    <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer">Instagram</a>
                <?php else : ?>
                    <a href="#">Instagram</a>
                <?php endif; ?>
                <?php if ( $pinterest && $pinterest !== '#' ) : ?>
                    <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" rel="noopener noreferrer">Pinterest</a>
                <?php else : ?>
                    <a href="#">Pinterest</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
