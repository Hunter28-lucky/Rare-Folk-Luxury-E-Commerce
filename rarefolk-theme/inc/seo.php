<?php
/**
 * Built-in SEO — Schema.org, Open Graph, Meta Tags
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Custom document title
 */
function rarefolk_document_title_parts( $title ) {
    if ( is_front_page() ) {
        $custom = get_theme_mod( 'rarefolk_seo_home_title', '' );
        if ( $custom ) {
            $title['title'] = $custom;
            unset( $title['tagline'] );
        }
    }
    return $title;
}
add_filter( 'document_title_parts', 'rarefolk_document_title_parts' );

/**
 * Output SEO meta tags in <head>
 */
function rarefolk_seo_meta_tags() {
    // Skip if Yoast or RankMath is active
    if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) ) {
        return;
    }

    $description = '';
    $og_type = 'website';
    $og_title = wp_get_document_title();
    $og_url = esc_url( home_url( $_SERVER['REQUEST_URI'] ) );
    $og_image = get_theme_mod( 'rarefolk_seo_og_image', '' );

    if ( is_front_page() ) {
        $description = get_theme_mod( 'rarefolk_seo_home_desc', 'Rare Folk is a premium streetwear brand. Curated cultural narratives for the discerning individual.' );
    } elseif ( is_page() ) {
        $description = get_the_excerpt() ?: wp_trim_words( get_the_content(), 25, '...' );
    } elseif ( is_singular( 'journal_post' ) ) {
        $og_type = 'article';
        $description = get_the_excerpt() ?: wp_trim_words( get_the_content(), 25, '...' );
        if ( has_post_thumbnail() ) {
            $og_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        }
    } elseif ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
        $og_type = 'product';
        $product = wc_get_product( get_the_ID() );
        if ( $product ) {
            $description = wp_strip_all_tags( $product->get_short_description() ?: $product->get_description() );
            $description = wp_trim_words( $description, 25, '...' );
        }
        if ( has_post_thumbnail() ) {
            $og_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        }
    } elseif ( is_post_type_archive( 'journal_post' ) ) {
        $description = 'Explorations in culture, identity, and the narratives woven into the fabric of modern heritage.';
    } elseif ( is_search() ) {
        $description = 'Search results for: ' . get_search_query();
    } elseif ( is_404() ) {
        $description = 'Page not found.';
    }

    $description = esc_attr( wp_strip_all_tags( $description ) );

    // Meta description
    if ( $description ) {
        echo '<meta name="description" content="' . $description . '">' . "\n";
    }

    // Canonical URL
    echo '<link rel="canonical" href="' . $og_url . '">' . "\n";

    // Open Graph
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
    echo '<meta property="og:url" content="' . $og_url . '">' . "\n";
    if ( $description ) {
        echo '<meta property="og:description" content="' . $description . '">' . "\n";
    }
    if ( $og_image ) {
        echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
    }
    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
    echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '">' . "\n";

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $og_title ) . '">' . "\n";
    if ( $description ) {
        echo '<meta name="twitter:description" content="' . $description . '">' . "\n";
    }
    if ( $og_image ) {
        echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
    }

    // Robots
    if ( is_search() || is_404() ) {
        echo '<meta name="robots" content="noindex, follow">' . "\n";
    }
}
add_action( 'wp_head', 'rarefolk_seo_meta_tags', 1 );

/**
 * Output JSON-LD Structured Data
 */
function rarefolk_schema_markup() {
    $schema = array();

    // Organization schema (every page)
    $org_schema = array(
        '@type'  => 'Organization',
        '@id'    => home_url( '/#organization' ),
        'name'   => get_theme_mod( 'rarefolk_brand_name', 'Rare Folk' ),
        'url'    => home_url( '/' ),
        'logo'   => get_theme_mod( 'rarefolk_seo_og_image', '' ),
        'sameAs' => array_filter( array(
            get_theme_mod( 'rarefolk_instagram', '' ),
            get_theme_mod( 'rarefolk_pinterest', '' ),
        ) ),
        'contactPoint' => array(
            '@type'       => 'ContactPoint',
            'email'       => get_theme_mod( 'rarefolk_email', 'kul@rarefolk.in' ),
            'contactType' => 'customer service',
        ),
    );

    // WebSite schema
    $website_schema = array(
        '@type'           => 'WebSite',
        '@id'             => home_url( '/#website' ),
        'url'             => home_url( '/' ),
        'name'            => get_bloginfo( 'name' ),
        'publisher'       => array( '@id' => home_url( '/#organization' ) ),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => home_url( '/?s={search_term_string}' ),
            'query-input' => 'required name=search_term_string',
        ),
    );

    $schema[] = $org_schema;
    $schema[] = $website_schema;

    // Product schema (WooCommerce single product)
    if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
        $product = wc_get_product( get_the_ID() );
        if ( $product ) {
            $product_schema = array(
                '@type'       => 'Product',
                'name'        => $product->get_name(),
                'description' => wp_strip_all_tags( $product->get_short_description() ?: $product->get_description() ),
                'sku'         => $product->get_sku(),
                'brand'       => array(
                    '@type' => 'Brand',
                    'name'  => get_theme_mod( 'rarefolk_brand_name', 'Rare Folk' ),
                ),
                'offers'      => array(
                    '@type'         => 'Offer',
                    'url'           => get_permalink(),
                    'priceCurrency' => get_woocommerce_currency(),
                    'price'         => $product->get_price(),
                    'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                    'seller'        => array( '@id' => home_url( '/#organization' ) ),
                ),
            );

            if ( has_post_thumbnail() ) {
                $product_schema['image'] = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            }

            $schema[] = $product_schema;
        }
    }

    // Article schema (journal posts)
    if ( is_singular( 'journal_post' ) ) {
        $article_schema = array(
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'description'   => get_the_excerpt(),
            'datePublished' => get_the_date( 'c' ),
            'dateModified'  => get_the_modified_date( 'c' ),
            'author'        => array(
                '@type' => 'Person',
                'name'  => get_the_author(),
            ),
            'publisher'     => array( '@id' => home_url( '/#organization' ) ),
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id'   => get_permalink(),
            ),
        );

        if ( has_post_thumbnail() ) {
            $article_schema['image'] = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        }

        $schema[] = $article_schema;
    }

    // BreadcrumbList schema
    if ( ! is_front_page() ) {
        $breadcrumb_items = array();
        $position = 1;

        $breadcrumb_items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'Home',
            'item'     => home_url( '/' ),
        );

        if ( is_singular( 'journal_post' ) ) {
            $breadcrumb_items[] = array(
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => 'Journal',
                'item'     => get_post_type_archive_link( 'journal_post' ),
            );
        }

        if ( is_singular( 'product' ) && function_exists( 'wc_get_page_id' ) ) {
            $breadcrumb_items[] = array(
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => 'Boutique',
                'item'     => get_permalink( wc_get_page_id( 'shop' ) ),
            );
        }

        $breadcrumb_items[] = array(
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => is_404() ? 'Not Found' : wp_get_document_title(),
        );

        $schema[] = array(
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $breadcrumb_items,
        );
    }

    // Output
    $output = array(
        '@context' => 'https://schema.org',
        '@graph'   => $schema,
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $output, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'rarefolk_schema_markup', 2 );
