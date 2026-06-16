<?php
/**
 * Performance Optimizations
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Remove unnecessary WordPress head items
 */
function rarefolk_cleanup_head() {
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'after_setup_theme', 'rarefolk_cleanup_head' );

/**
 * Remove WordPress emoji scripts
 */
function rarefolk_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'rarefolk_disable_emojis' );

/**
 * Remove jQuery Migrate
 */
function rarefolk_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'rarefolk_remove_jquery_migrate' );

/**
 * Defer non-critical scripts
 */
function rarefolk_defer_scripts( $tag, $handle, $src ) {
    $defer_handles = array( 'rarefolk-main' );

    if ( in_array( $handle, $defer_handles ) ) {
        return '<script src="' . esc_url( $src ) . '" defer></script>' . "\n";
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'rarefolk_defer_scripts', 10, 3 );

/**
 * Add fetchpriority and loading attributes to images
 */
function rarefolk_optimize_images( $attr, $attachment, $size ) {
    // Remove default loading="lazy" for hero images (handled by fetchpriority)
    if ( is_front_page() && $size === 'rarefolk-hero' ) {
        $attr['fetchpriority'] = 'high';
        $attr['loading'] = 'eager';
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'rarefolk_optimize_images', 10, 3 );

/**
 * Add preconnect and DNS prefetch hints
 */
function rarefolk_preconnect_hints() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
}
add_action( 'wp_head', 'rarefolk_preconnect_hints', 0 );

/**
 * Add content-visibility to below-fold sections via inline CSS
 */
function rarefolk_critical_css() {
    echo '<style id="rarefolk-critical">';
    echo '.section-padding{content-visibility:auto;contain-intrinsic-size:auto 500px;}';
    echo '.site-footer{content-visibility:auto;contain-intrinsic-size:auto 400px;}';
    echo '</style>' . "\n";
}
add_action( 'wp_head', 'rarefolk_critical_css', 5 );

/**
 * Optimize WooCommerce scripts — only load on relevant pages
 */
function rarefolk_optimize_woocommerce() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }

    // Don't load WC scripts on non-WC pages
    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_style( 'woocommerce-general' );
        wp_dequeue_style( 'woocommerce-layout' );
        wp_dequeue_style( 'woocommerce-smallscreen' );
    }
}
add_action( 'wp_enqueue_scripts', 'rarefolk_optimize_woocommerce', 99 );

/**
 * Limit post revisions for performance
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
    define( 'WP_POST_REVISIONS', 5 );
}
