<?php
/**
 * WooCommerce Wrapper
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Remove default WooCommerce wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Custom WooCommerce wrapper start
 */
function rarefolk_woocommerce_wrapper_start() {
    echo '<main style="padding-top: 128px; padding-bottom: 80px;">';
}
add_action( 'woocommerce_before_main_content', 'rarefolk_woocommerce_wrapper_start', 10 );

/**
 * Custom WooCommerce wrapper end
 */
function rarefolk_woocommerce_wrapper_end() {
    echo '</main>';
}
add_action( 'woocommerce_after_main_content', 'rarefolk_woocommerce_wrapper_end', 10 );

/**
 * Remove default WooCommerce sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Remove default WooCommerce page title
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Remove default WooCommerce breadcrumbs (we have our own)
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Customize WooCommerce product count display
 */
function rarefolk_woocommerce_result_count( $html ) {
    return '<span class="text-label-caps text-muted">' . $html . '</span>';
}

/**
 * Remove WooCommerce default styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * WooCommerce cart page customization
 */
function rarefolk_woocommerce_cart_redirect() {
    // Keep consistent theming
}

/**
 * Declare WooCommerce support
 */
function rarefolk_declare_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'rarefolk_declare_woocommerce_support' );
