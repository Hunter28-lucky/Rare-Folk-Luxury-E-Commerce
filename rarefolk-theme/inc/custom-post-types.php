<?php
/**
 * Custom Post Types — Journal
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Journal Post Type
 */
function rarefolk_register_journal_cpt() {
    $labels = array(
        'name'                  => _x( 'Journal', 'Post Type General Name', 'rarefolk' ),
        'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'rarefolk' ),
        'menu_name'             => __( 'Journal', 'rarefolk' ),
        'name_admin_bar'        => __( 'Journal Article', 'rarefolk' ),
        'archives'              => __( 'Journal Archives', 'rarefolk' ),
        'attributes'            => __( 'Article Attributes', 'rarefolk' ),
        'all_items'             => __( 'All Articles', 'rarefolk' ),
        'add_new_item'          => __( 'Add New Article', 'rarefolk' ),
        'add_new'               => __( 'Add New', 'rarefolk' ),
        'new_item'              => __( 'New Article', 'rarefolk' ),
        'edit_item'             => __( 'Edit Article', 'rarefolk' ),
        'update_item'           => __( 'Update Article', 'rarefolk' ),
        'view_item'             => __( 'View Article', 'rarefolk' ),
        'view_items'            => __( 'View Articles', 'rarefolk' ),
        'search_items'          => __( 'Search Articles', 'rarefolk' ),
        'not_found'             => __( 'No articles found', 'rarefolk' ),
        'not_found_in_trash'    => __( 'No articles found in Trash', 'rarefolk' ),
        'featured_image'        => __( 'Article Image', 'rarefolk' ),
        'set_featured_image'    => __( 'Set article image', 'rarefolk' ),
        'remove_featured_image' => __( 'Remove article image', 'rarefolk' ),
        'use_featured_image'    => __( 'Use as article image', 'rarefolk' ),
    );

    $args = array(
        'label'               => __( 'Journal', 'rarefolk' ),
        'description'         => __( 'Cultural narratives and editorial content', 'rarefolk' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions' ),
        'taxonomies'          => array( 'journal_category' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'journal',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array( 'slug' => 'journal', 'with_front' => false ),
    );

    register_post_type( 'journal_post', $args );
}
add_action( 'init', 'rarefolk_register_journal_cpt' );

/**
 * Register Journal Category Taxonomy
 */
function rarefolk_register_journal_taxonomy() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'rarefolk' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'rarefolk' ),
        'search_items'      => __( 'Search Categories', 'rarefolk' ),
        'all_items'         => __( 'All Categories', 'rarefolk' ),
        'parent_item'       => __( 'Parent Category', 'rarefolk' ),
        'parent_item_colon' => __( 'Parent Category:', 'rarefolk' ),
        'edit_item'         => __( 'Edit Category', 'rarefolk' ),
        'update_item'       => __( 'Update Category', 'rarefolk' ),
        'add_new_item'      => __( 'Add New Category', 'rarefolk' ),
        'new_item_name'     => __( 'New Category Name', 'rarefolk' ),
        'menu_name'         => __( 'Categories', 'rarefolk' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'journal-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'journal_category', array( 'journal_post' ), $args );
}
add_action( 'init', 'rarefolk_register_journal_taxonomy' );

/**
 * Add default journal categories on theme activation
 */
function rarefolk_create_default_journal_categories() {
    $categories = array( 'Culture', 'Fashion', 'Stories', 'Identity' );

    foreach ( $categories as $cat ) {
        if ( ! term_exists( $cat, 'journal_category' ) ) {
            wp_insert_term( $cat, 'journal_category' );
        }
    }
}
add_action( 'after_switch_theme', 'rarefolk_create_default_journal_categories' );

/**
 * Flush rewrite rules on theme activation
 */
function rarefolk_rewrite_flush() {
    rarefolk_register_journal_cpt();
    rarefolk_register_journal_taxonomy();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rarefolk_rewrite_flush' );
