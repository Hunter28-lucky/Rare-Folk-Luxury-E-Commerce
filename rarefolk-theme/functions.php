<?php
/**
 * Rare Folk Theme Functions
 *
 * @package RareFolk
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RAREFOLK_VERSION', '1.0.0' );
define( 'RAREFOLK_DIR', get_template_directory() );
define( 'RAREFOLK_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function rarefolk_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );

    // Custom image sizes
    add_image_size( 'rarefolk-hero', 1920, 1080, true );
    add_image_size( 'rarefolk-product-card', 800, 1067, true ); // 3:4 ratio
    add_image_size( 'rarefolk-product-main', 1200, 1600, true );
    add_image_size( 'rarefolk-product-thumb', 600, 600, true );
    add_image_size( 'rarefolk-journal-featured', 1400, 1050, true ); // 4:3
    add_image_size( 'rarefolk-journal-portrait', 800, 1067, true ); // 3:4
    add_image_size( 'rarefolk-journal-square', 800, 800, true );
    add_image_size( 'rarefolk-narrative', 1000, 1000, true );
    add_image_size( 'rarefolk-about', 1200, 1600, true );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary'       => esc_html__( 'Primary Navigation', 'rarefolk' ),
        'mobile'        => esc_html__( 'Mobile Navigation', 'rarefolk' ),
        'footer-col-1'  => esc_html__( 'Footer Column 1', 'rarefolk' ),
        'footer-col-2'  => esc_html__( 'Footer Column 2', 'rarefolk' ),
        'footer-col-3'  => esc_html__( 'Footer Column 3', 'rarefolk' ),
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ) );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // WooCommerce support
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 800,
        'single_image_width'    => 1200,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 4,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Wide and full alignment in Gutenberg
    add_theme_support( 'align-wide' );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Editor styles
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'rarefolk_setup' );

/**
 * Enqueue Scripts & Styles
 */
function rarefolk_scripts() {
    // Main stylesheet
    wp_enqueue_style( 'rarefolk-style', get_stylesheet_uri(), array(), RAREFOLK_VERSION );

    // Google Fonts
    wp_enqueue_style(
        'rarefolk-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@300;400;600&display=swap',
        array(),
        null
    );

    // Material Symbols
    wp_enqueue_style(
        'rarefolk-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        array(),
        null
    );

    // WooCommerce overrides
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_style(
            'rarefolk-woocommerce',
            RAREFOLK_URI . '/assets/css/woocommerce.css',
            array( 'rarefolk-style' ),
            RAREFOLK_VERSION
        );
    }

    // Main JS
    wp_enqueue_script(
        'rarefolk-main',
        RAREFOLK_URI . '/assets/js/main.js',
        array(),
        RAREFOLK_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script( 'rarefolk-main', 'rarefolk_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'rarefolk_nonce' ),
    ) );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'rarefolk_scripts' );

/**
 * Preconnect to external resources
 */
function rarefolk_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'rarefolk_resource_hints', 10, 2 );

/**
 * Register Widget Areas
 */
function rarefolk_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area', 'rarefolk' ),
        'id'            => 'footer-widgets',
        'description'   => esc_html__( 'Add widgets to the footer area.', 'rarefolk' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-label-caps text-onyx">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'rarefolk_widgets_init' );

/**
 * Include modules
 */
require_once RAREFOLK_DIR . '/inc/custom-post-types.php';
require_once RAREFOLK_DIR . '/inc/customizer.php';
require_once RAREFOLK_DIR . '/inc/seo.php';
require_once RAREFOLK_DIR . '/inc/performance.php';
require_once RAREFOLK_DIR . '/inc/class-theme-updater.php';

/**
 * Custom excerpt length
 */
function rarefolk_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'rarefolk_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function rarefolk_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'rarefolk_excerpt_more' );

/**
 * Get theme mod with default fallback helper
 */
function rarefolk_get( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}

/**
 * Breadcrumb function for SEO
 */
function rarefolk_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    $separator = '<span class="text-muted" style="margin: 0 8px;">/</span>';

    echo '<nav class="breadcrumbs container-padding" style="padding-top: 16px; padding-bottom: 16px;" aria-label="Breadcrumb">';
    echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList" style="display: flex; align-items: center; flex-wrap: wrap; gap: 0;" class="text-label-caps">';

    // Home
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a itemprop="item" href="' . esc_url( home_url( '/' ) ) . '"><span itemprop="name">Home</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</li>';
    echo $separator;

    $position = 2;

    if ( is_page() ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif ( is_singular( 'journal_post' ) ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url( get_post_type_archive_link( 'journal_post' ) ) . '"><span itemprop="name">Journal</span></a>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
        echo $separator;
        $position++;
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif ( is_post_type_archive( 'journal_post' ) ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">Journal</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif ( function_exists( 'is_shop' ) && is_shop() ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">Boutique</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif ( is_singular( 'product' ) ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '"><span itemprop="name">Boutique</span></a>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
        echo $separator;
        $position++;
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif ( is_search() ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">Search Results</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif ( is_404() ) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" class="text-onyx">Page Not Found</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Custom Walker for Nav Menu to add active class
 */
class Rarefolk_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );

        $class_str = $is_active ? ' active' : '';

        $output .= '<a class="nav-link nav-link-hover' . $class_str . '" href="' . esc_url( $item->url ) . '">';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // No wrapping <li>
    }

    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
}

/**
 * Mobile Nav Walker
 */
class Rarefolk_Mobile_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );

        $class_str = 'mobile-menu-link';
        if ( $is_active ) {
            $class_str .= ' active';
        }

        $output .= '<a class="' . $class_str . '" href="' . esc_url( $item->url ) . '">';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {}
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
}

/**
 * Footer links Walker
 */
class Rarefolk_Footer_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= '<a class="footer-link text-body-md" href="' . esc_url( $item->url ) . '">';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {}
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
}

/**
 * Handle contact form AJAX submission
 */
function rarefolk_contact_form_handler() {
    check_ajax_referer( 'rarefolk_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    $to = get_option( 'admin_email' );
    $email_subject = 'Rare Folk Inquiry: ' . $subject;
    $email_body = "Name: {$name}\nEmail: {$email}\nSubject: {$subject}\n\nMessage:\n{$message}";
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    $sent = wp_mail( $to, $email_subject, $email_body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => 'Your message has been sent successfully.' ) );
    } else {
        wp_send_json_error( array( 'message' => 'There was an error sending your message. Please try again.' ) );
    }
}
add_action( 'wp_ajax_rarefolk_contact', 'rarefolk_contact_form_handler' );
add_action( 'wp_ajax_nopriv_rarefolk_contact', 'rarefolk_contact_form_handler' );

/**
 * Handle newsletter AJAX subscription
 */
function rarefolk_newsletter_handler() {
    check_ajax_referer( 'rarefolk_nonce', 'nonce' );

    $email = sanitize_email( $_POST['email'] ?? '' );

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
    }

    // Store subscriber in options (can be replaced with Mailchimp API)
    $subscribers = get_option( 'rarefolk_subscribers', array() );
    if ( ! in_array( $email, $subscribers ) ) {
        $subscribers[] = $email;
        update_option( 'rarefolk_subscribers', $subscribers );
    }

    wp_send_json_success( array( 'message' => 'Welcome to the Inner Circle.' ) );
}
add_action( 'wp_ajax_rarefolk_newsletter', 'rarefolk_newsletter_handler' );
add_action( 'wp_ajax_nopriv_rarefolk_newsletter', 'rarefolk_newsletter_handler' );
