<?php
/**
 * Template Part: Navigation Header
 *
 * @package RareFolk
 */

$brand_name = get_theme_mod( 'rarefolk_brand_name', 'Rare Folk' );
$cart_url = class_exists( 'WooCommerce' ) ? wc_get_cart_url() : '#';
$account_url = class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'myaccount' ) : '#';
?>

<nav class="site-nav" id="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'rarefolk' ); ?>">
    <div style="display: flex; align-items: center;">
        <a class="brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php echo esc_html( $brand_name ); ?>
        </a>
    </div>

    <div class="nav-links">
        <?php
        if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'walker'         => new Rarefolk_Nav_Walker(),
                'depth'          => 1,
            ) );
        } else {
            // Fallback nav
            ?>
            <a class="nav-link nav-link-hover<?php echo is_front_page() ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">Collections</a>
            <a class="nav-link nav-link-hover<?php echo is_post_type_archive( 'journal_post' ) || is_singular( 'journal_post' ) ? ' active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'journal_post' ) ); ?>">Narratives</a>
            <a class="nav-link nav-link-hover<?php echo is_page( 'about' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Archives</a>
            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                <a class="nav-link nav-link-hover<?php echo is_shop() || is_product() ? ' active' : ''; ?>" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">Boutique</a>
            <?php else : ?>
                <a class="nav-link nav-link-hover<?php echo is_page( 'shop' ) ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Boutique</a>
            <?php endif; ?>
            <?php
        }
        ?>
    </div>

    <div class="nav-icons">
        <button class="nav-icon-btn" aria-label="<?php esc_attr_e( 'Search', 'rarefolk' ); ?>" id="search-toggle">
            <span class="material-symbols-outlined">search</span>
        </button>
        <a class="nav-icon-btn desktop-only" href="<?php echo esc_url( $account_url ); ?>" aria-label="<?php esc_attr_e( 'Account', 'rarefolk' ); ?>">
            <span class="material-symbols-outlined">person</span>
        </a>
        <a class="nav-icon-btn" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php esc_attr_e( 'Shopping Bag', 'rarefolk' ); ?>">
            <span class="material-symbols-outlined">shopping_bag</span>
            <?php if ( class_exists( 'WooCommerce' ) && WC()->cart->get_cart_contents_count() > 0 ) : ?>
                <span class="cart-count" style="position: absolute; top: -4px; right: -4px; background: var(--color-onyx-black); color: var(--color-off-white); font-size: 10px; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                    <?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
                </span>
            <?php endif; ?>
        </a>
        <button class="nav-icon-btn mobile-menu-btn" id="mobile-menu-btn" aria-label="<?php esc_attr_e( 'Open Menu', 'rarefolk' ); ?>">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</nav>

<!-- Search Overlay -->
<div id="search-overlay" style="display: none; position: fixed; inset: 0; z-index: 60; background: rgba(245, 242, 237, 0.98); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
    <div style="max-width: 800px; margin: 0 auto; padding: 120px var(--margin-mobile); text-align: center;">
        <button id="search-close" class="nav-icon-btn" style="position: absolute; top: 24px; right: 24px;" aria-label="<?php esc_attr_e( 'Close Search', 'rarefolk' ); ?>">
            <span class="material-symbols-outlined">close</span>
        </button>
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search the archives...', 'rarefolk' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" class="minimal-input" style="font-size: 32px; text-align: center; border-bottom: 2px solid var(--color-onyx-black);" autofocus>
        </form>
    </div>
</div>
