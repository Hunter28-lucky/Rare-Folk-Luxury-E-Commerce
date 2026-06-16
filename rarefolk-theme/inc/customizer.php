<?php
/**
 * WordPress Customizer — Full Content Editability
 *
 * Every section of every page is editable via Appearance → Customize.
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function rarefolk_customize_register( $wp_customize ) {

    // =========================================
    // PANEL: Global Settings
    // =========================================
    $wp_customize->add_panel( 'rarefolk_global', array(
        'title'    => __( 'Rare Folk — Global', 'rarefolk' ),
        'priority' => 10,
    ) );

    // --- Section: Brand Identity ---
    $wp_customize->add_section( 'rarefolk_brand', array(
        'title' => __( 'Brand Identity', 'rarefolk' ),
        'panel' => 'rarefolk_global',
    ) );

    $wp_customize->add_setting( 'rarefolk_brand_name', array( 'default' => 'Rare Folk', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_brand_name', array( 'label' => __( 'Brand Name', 'rarefolk' ), 'section' => 'rarefolk_brand', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_copyright', array( 'default' => '© 2024 Rare Folk. All Rights Reserved.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_copyright', array( 'label' => __( 'Copyright Text', 'rarefolk' ), 'section' => 'rarefolk_brand', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_developer', array( 'default' => 'Developed by Krish Goswami.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_developer', array( 'label' => __( 'Developer Credit', 'rarefolk' ), 'section' => 'rarefolk_brand', 'type' => 'text' ) );

    // --- Section: Social Media ---
    $wp_customize->add_section( 'rarefolk_social', array(
        'title' => __( 'Social Media', 'rarefolk' ),
        'panel' => 'rarefolk_global',
    ) );

    $wp_customize->add_setting( 'rarefolk_instagram', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'rarefolk_instagram', array( 'label' => __( 'Instagram URL', 'rarefolk' ), 'section' => 'rarefolk_social', 'type' => 'url' ) );

    $wp_customize->add_setting( 'rarefolk_pinterest', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'rarefolk_pinterest', array( 'label' => __( 'Pinterest URL', 'rarefolk' ), 'section' => 'rarefolk_social', 'type' => 'url' ) );

    // --- Section: Contact Info ---
    $wp_customize->add_section( 'rarefolk_contact_info', array(
        'title' => __( 'Contact Information', 'rarefolk' ),
        'panel' => 'rarefolk_global',
    ) );

    $wp_customize->add_setting( 'rarefolk_email', array( 'default' => 'kul@rarefolk.in', 'sanitize_callback' => 'sanitize_email' ) );
    $wp_customize->add_control( 'rarefolk_email', array( 'label' => __( 'Contact Email', 'rarefolk' ), 'section' => 'rarefolk_contact_info', 'type' => 'email' ) );

    $wp_customize->add_setting( 'rarefolk_website', array( 'default' => 'https://rarefolk.in', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'rarefolk_website', array( 'label' => __( 'Website URL', 'rarefolk' ), 'section' => 'rarefolk_contact_info', 'type' => 'url' ) );

    // =========================================
    // PANEL: Homepage
    // =========================================
    $wp_customize->add_panel( 'rarefolk_homepage', array(
        'title'    => __( 'Rare Folk — Homepage', 'rarefolk' ),
        'priority' => 20,
    ) );

    // --- Hero Section ---
    $wp_customize->add_section( 'rarefolk_hero', array(
        'title' => __( 'Hero Section', 'rarefolk' ),
        'panel' => 'rarefolk_homepage',
    ) );

    $wp_customize->add_setting( 'rarefolk_hero_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_hero_image', array(
        'label'   => __( 'Hero Background Image', 'rarefolk' ),
        'section' => 'rarefolk_hero',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_hero_title', array( 'default' => "Wear Culture.\nCreate Identity.", 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_hero_title', array( 'label' => __( 'Hero Headline', 'rarefolk' ), 'section' => 'rarefolk_hero', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_hero_cta_text', array( 'default' => 'Explore Collection', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_hero_cta_text', array( 'label' => __( 'CTA Button Text', 'rarefolk' ), 'section' => 'rarefolk_hero', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_hero_cta_url', array( 'default' => '#collections', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'rarefolk_hero_cta_url', array( 'label' => __( 'CTA Button URL', 'rarefolk' ), 'section' => 'rarefolk_hero', 'type' => 'url' ) );

    $wp_customize->add_setting( 'rarefolk_hero_alt', array( 'default' => 'Wear Culture. Create Identity.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'rarefolk_hero_alt', array( 'label' => __( 'Hero Image Alt Text', 'rarefolk' ), 'section' => 'rarefolk_hero', 'type' => 'text' ) );

    // --- Philosophy Section ---
    $wp_customize->add_section( 'rarefolk_philosophy', array(
        'title' => __( 'Philosophy Section', 'rarefolk' ),
        'panel' => 'rarefolk_homepage',
    ) );

    $wp_customize->add_setting( 'rarefolk_philosophy_heading', array( 'default' => 'Sharing Culture', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_philosophy_heading', array( 'label' => __( 'Heading', 'rarefolk' ), 'section' => 'rarefolk_philosophy', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_philosophy_text', array( 'default' => 'We believe in the power of stories woven into fabric. Every piece is a canvas, carrying the weight of heritage and the spark of modern interpretation. We don\'t just create garments; we curate cultural narratives for the discerning individual.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_philosophy_text', array( 'label' => __( 'Body Text', 'rarefolk' ), 'section' => 'rarefolk_philosophy', 'type' => 'textarea' ) );

    // --- Featured Collection ---
    $wp_customize->add_section( 'rarefolk_featured', array(
        'title' => __( 'Featured Collection', 'rarefolk' ),
        'panel' => 'rarefolk_homepage',
    ) );

    $wp_customize->add_setting( 'rarefolk_featured_heading', array( 'default' => 'Curated Edit', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_featured_heading', array( 'label' => __( 'Section Heading', 'rarefolk' ), 'section' => 'rarefolk_featured', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_featured_link_text', array( 'default' => 'View All', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_featured_link_text', array( 'label' => __( 'View All Link Text', 'rarefolk' ), 'section' => 'rarefolk_featured', 'type' => 'text' ) );

    // For non-WooCommerce: manual product cards
    for ( $i = 1; $i <= 2; $i++ ) {
        $wp_customize->add_setting( "rarefolk_product_{$i}_image", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "rarefolk_product_{$i}_image", array(
            'label'   => sprintf( __( 'Product %d Image', 'rarefolk' ), $i ),
            'section' => 'rarefolk_featured',
        ) ) );

        $wp_customize->add_setting( "rarefolk_product_{$i}_title", array( 'default' => $i === 1 ? 'Ancestral Lines Tee' : 'Void Structure Tee', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "rarefolk_product_{$i}_title", array( 'label' => sprintf( __( 'Product %d Title', 'rarefolk' ), $i ), 'section' => 'rarefolk_featured', 'type' => 'text' ) );

        $wp_customize->add_setting( "rarefolk_product_{$i}_subtitle", array( 'default' => $i === 1 ? 'Heavyweight Cotton / Oversized Fit' : 'Organic Pima / Boxy Cut', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "rarefolk_product_{$i}_subtitle", array( 'label' => sprintf( __( 'Product %d Subtitle', 'rarefolk' ), $i ), 'section' => 'rarefolk_featured', 'type' => 'text' ) );

        $wp_customize->add_setting( "rarefolk_product_{$i}_price", array( 'default' => $i === 1 ? '₹9,900' : '₹8,900', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "rarefolk_product_{$i}_price", array( 'label' => sprintf( __( 'Product %d Price', 'rarefolk' ), $i ), 'section' => 'rarefolk_featured', 'type' => 'text' ) );

        $wp_customize->add_setting( "rarefolk_product_{$i}_url", array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "rarefolk_product_{$i}_url", array( 'label' => sprintf( __( 'Product %d Link', 'rarefolk' ), $i ), 'section' => 'rarefolk_featured', 'type' => 'url' ) );
    }

    // --- Narrative Block ---
    $wp_customize->add_section( 'rarefolk_narrative', array(
        'title' => __( 'Narrative Block', 'rarefolk' ),
        'panel' => 'rarefolk_homepage',
    ) );

    $wp_customize->add_setting( 'rarefolk_narrative_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_narrative_image', array(
        'label'   => __( 'Narrative Image', 'rarefolk' ),
        'section' => 'rarefolk_narrative',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_narrative_heading', array( 'default' => 'The Symbolism', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_narrative_heading', array( 'label' => __( 'Heading', 'rarefolk' ), 'section' => 'rarefolk_narrative', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_narrative_text', array( 'default' => 'Our latest collection draws inspiration from ancient geometric motifs, reimagined through a brutalist lens. Each pattern is meticulously researched, honoring its origins while being stripped down to its rawest visual essence.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_narrative_text', array( 'label' => __( 'Body Text', 'rarefolk' ), 'section' => 'rarefolk_narrative', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_narrative_cta', array( 'default' => 'Read the Journal', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_narrative_cta', array( 'label' => __( 'CTA Button Text', 'rarefolk' ), 'section' => 'rarefolk_narrative', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_narrative_cta_url', array( 'default' => '/journal', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'rarefolk_narrative_cta_url', array( 'label' => __( 'CTA URL', 'rarefolk' ), 'section' => 'rarefolk_narrative', 'type' => 'url' ) );

    // --- Newsletter Section ---
    $wp_customize->add_section( 'rarefolk_newsletter', array(
        'title' => __( 'Newsletter Section', 'rarefolk' ),
        'panel' => 'rarefolk_homepage',
    ) );

    $wp_customize->add_setting( 'rarefolk_newsletter_heading', array( 'default' => 'Join the Inner Circle', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_newsletter_heading', array( 'label' => __( 'Heading', 'rarefolk' ), 'section' => 'rarefolk_newsletter', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_newsletter_text', array( 'default' => 'Exclusive access to limited drops and cultural narratives.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_newsletter_text', array( 'label' => __( 'Subtitle', 'rarefolk' ), 'section' => 'rarefolk_newsletter', 'type' => 'text' ) );

    // =========================================
    // PANEL: About Page
    // =========================================
    $wp_customize->add_panel( 'rarefolk_about', array(
        'title'    => __( 'Rare Folk — About', 'rarefolk' ),
        'priority' => 30,
    ) );

    // --- About Hero ---
    $wp_customize->add_section( 'rarefolk_about_hero', array(
        'title' => __( 'Hero Section', 'rarefolk' ),
        'panel' => 'rarefolk_about',
    ) );

    $wp_customize->add_setting( 'rarefolk_about_hero_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_about_hero_image', array(
        'label'   => __( 'Hero Image', 'rarefolk' ),
        'section' => 'rarefolk_about_hero',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_about_hero_text', array( 'default' => 'Rare Folk is a premium streetwear brand created for individuals who believe fashion is more than clothing.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_about_hero_text', array( 'label' => __( 'Hero Headline', 'rarefolk' ), 'section' => 'rarefolk_about_hero', 'type' => 'textarea' ) );

    // --- The Story ---
    $wp_customize->add_section( 'rarefolk_about_story', array(
        'title' => __( 'The Story', 'rarefolk' ),
        'panel' => 'rarefolk_about',
    ) );

    $wp_customize->add_setting( 'rarefolk_story_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_story_image', array(
        'label'   => __( 'Story Image', 'rarefolk' ),
        'section' => 'rarefolk_about_story',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_story_label', array( 'default' => 'The Story', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_story_label', array( 'label' => __( 'Section Label', 'rarefolk' ), 'section' => 'rarefolk_about_story', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_story_heading', array( 'default' => 'Forged in the spaces between street culture and gallery walls.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_story_heading', array( 'label' => __( 'Heading', 'rarefolk' ), 'section' => 'rarefolk_about_story', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_story_para1', array( 'default' => 'We saw a landscape cluttered with loud logos and fast trends. Rare Folk was born from a desire for quiet confidence—pieces that speak through their silhouette, fabric, and subtle narrative details rather than a shouted brand name.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_story_para1', array( 'label' => __( 'Paragraph 1', 'rarefolk' ), 'section' => 'rarefolk_about_story', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_story_para2', array( 'default' => 'Every collection is a limited-run exploration of a specific theme, treated with the reverence of a gallery exhibition. We design for the discerning few who curate their wardrobe with intention.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_story_para2', array( 'label' => __( 'Paragraph 2', 'rarefolk' ), 'section' => 'rarefolk_about_story', 'type' => 'textarea' ) );

    // --- Mission ---
    $wp_customize->add_section( 'rarefolk_about_mission', array(
        'title' => __( 'Mission & Vision', 'rarefolk' ),
        'panel' => 'rarefolk_about',
    ) );

    $wp_customize->add_setting( 'rarefolk_mission_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_mission_image', array(
        'label'   => __( 'Mission Image', 'rarefolk' ),
        'section' => 'rarefolk_about_mission',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_mission_text', array( 'default' => 'To elevate everyday garments into objects of permanence and cultural significance.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_mission_text', array( 'label' => __( 'Mission Text', 'rarefolk' ), 'section' => 'rarefolk_about_mission', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_vision_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_vision_image', array(
        'label'   => __( 'Vision Image', 'rarefolk' ),
        'section' => 'rarefolk_about_mission',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_vision_text', array( 'default' => 'A wardrobe that serves as a silent prologue to the wearer\'s personal narrative.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_vision_text', array( 'label' => __( 'Vision Text', 'rarefolk' ), 'section' => 'rarefolk_about_mission', 'type' => 'textarea' ) );

    // --- Core Values ---
    $wp_customize->add_section( 'rarefolk_about_values', array(
        'title' => __( 'Core Values', 'rarefolk' ),
        'panel' => 'rarefolk_about',
    ) );

    $default_values = array(
        array( 'Restraint.', 'True luxury whispers. We embrace negative space in our design, allowing the purity of the materials and the precision of the cut to stand unencumbered.' ),
        array( 'Narrative.', 'Every piece is a chapter. We weave stories into our collections through subtle embroideries, unexpected structural details, and deliberate conceptual pacing.' ),
        array( 'Permanence.', 'We reject the ephemeral. Our garments are constructed to outlast seasons, designed to age gracefully alongside the individual who inhabits them.' ),
    );

    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "rarefolk_value_{$i}_heading", array( 'default' => $default_values[$i-1][0], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "rarefolk_value_{$i}_heading", array( 'label' => sprintf( __( 'Value %d Heading', 'rarefolk' ), $i ), 'section' => 'rarefolk_about_values', 'type' => 'text' ) );

        $wp_customize->add_setting( "rarefolk_value_{$i}_text", array( 'default' => $default_values[$i-1][1], 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( "rarefolk_value_{$i}_text", array( 'label' => sprintf( __( 'Value %d Description', 'rarefolk' ), $i ), 'section' => 'rarefolk_about_values', 'type' => 'textarea' ) );
    }

    // --- Founder ---
    $wp_customize->add_section( 'rarefolk_about_founder', array(
        'title' => __( 'Founder Section', 'rarefolk' ),
        'panel' => 'rarefolk_about',
    ) );

    $wp_customize->add_setting( 'rarefolk_founder_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_founder_image', array(
        'label'   => __( 'Founder Photo', 'rarefolk' ),
        'section' => 'rarefolk_about_founder',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_founder_label', array( 'default' => 'The Architect', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_founder_label', array( 'label' => __( 'Section Label', 'rarefolk' ), 'section' => 'rarefolk_about_founder', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_founder_quote', array( 'default' => '"We are not merely dressing bodies; we are framing personas. Rare Folk is an invitation to inhabit a space of quiet distinction."', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_founder_quote', array( 'label' => __( 'Quote', 'rarefolk' ), 'section' => 'rarefolk_about_founder', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_founder_name', array( 'default' => 'E. Aris', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_founder_name', array( 'label' => __( 'Name', 'rarefolk' ), 'section' => 'rarefolk_about_founder', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_founder_title', array( 'default' => 'Founder & Creative Director', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_founder_title', array( 'label' => __( 'Title', 'rarefolk' ), 'section' => 'rarefolk_about_founder', 'type' => 'text' ) );

    // =========================================
    // PANEL: Shop Page
    // =========================================
    $wp_customize->add_panel( 'rarefolk_shop', array(
        'title'    => __( 'Rare Folk — Shop', 'rarefolk' ),
        'priority' => 40,
    ) );

    $wp_customize->add_section( 'rarefolk_shop_header', array(
        'title' => __( 'Page Header', 'rarefolk' ),
        'panel' => 'rarefolk_shop',
    ) );

    $wp_customize->add_setting( 'rarefolk_shop_heading', array( 'default' => 'The Boutique', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_shop_heading', array( 'label' => __( 'Page Heading', 'rarefolk' ), 'section' => 'rarefolk_shop_header', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_shop_description', array( 'default' => 'Curated artifacts and limited editions. A synthesis of heritage craftsmanship and modern anonymity.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_shop_description', array( 'label' => __( 'Description', 'rarefolk' ), 'section' => 'rarefolk_shop_header', 'type' => 'textarea' ) );

    // --- Shop Narrative ---
    $wp_customize->add_section( 'rarefolk_shop_narrative', array(
        'title' => __( 'Narrative Banner', 'rarefolk' ),
        'panel' => 'rarefolk_shop',
    ) );

    $wp_customize->add_setting( 'rarefolk_shop_narrative_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_shop_narrative_image', array(
        'label'   => __( 'Banner Image', 'rarefolk' ),
        'section' => 'rarefolk_shop_narrative',
    ) ) );

    $wp_customize->add_setting( 'rarefolk_shop_narrative_heading', array( 'default' => "Beyond the Seam.\nA Study in Intent.", 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_shop_narrative_heading', array( 'label' => __( 'Heading', 'rarefolk' ), 'section' => 'rarefolk_shop_narrative', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_shop_narrative_text', array( 'default' => 'Every piece in our collection is a dialogue between raw material and refined execution. We reject the ephemeral cycles of seasonal trends in favor of enduring artifacts that age alongside the wearer.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_shop_narrative_text', array( 'label' => __( 'Body Text', 'rarefolk' ), 'section' => 'rarefolk_shop_narrative', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_shop_narrative_cta', array( 'default' => 'Read the Narrative', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_shop_narrative_cta', array( 'label' => __( 'CTA Text', 'rarefolk' ), 'section' => 'rarefolk_shop_narrative', 'type' => 'text' ) );

    // =========================================
    // PANEL: Contact Page
    // =========================================
    $wp_customize->add_panel( 'rarefolk_contact', array(
        'title'    => __( 'Rare Folk — Contact', 'rarefolk' ),
        'priority' => 50,
    ) );

    $wp_customize->add_section( 'rarefolk_contact_page', array(
        'title' => __( 'Contact Page Content', 'rarefolk' ),
        'panel' => 'rarefolk_contact',
    ) );

    $wp_customize->add_setting( 'rarefolk_contact_heading', array( 'default' => "Inquiries &\nDialogues", 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_contact_heading', array( 'label' => __( 'Page Heading', 'rarefolk' ), 'section' => 'rarefolk_contact_page', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_contact_subtitle', array( 'default' => 'We invite conversations regarding bespoke commissions, archival acquisitions, or press inquiries. Our atelier reviews correspondence with the utmost discretion.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_contact_subtitle', array( 'label' => __( 'Subtitle', 'rarefolk' ), 'section' => 'rarefolk_contact_page', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_contact_btn_text', array( 'default' => 'Transmit', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_contact_btn_text', array( 'label' => __( 'Submit Button Text', 'rarefolk' ), 'section' => 'rarefolk_contact_page', 'type' => 'text' ) );

    // =========================================
    // PANEL: Legal Page
    // =========================================
    $wp_customize->add_panel( 'rarefolk_legal', array(
        'title'    => __( 'Rare Folk — Legal', 'rarefolk' ),
        'priority' => 60,
    ) );

    $wp_customize->add_section( 'rarefolk_legal_header', array(
        'title' => __( 'Page Header', 'rarefolk' ),
        'panel' => 'rarefolk_legal',
    ) );

    $wp_customize->add_setting( 'rarefolk_legal_heading', array( 'default' => 'Legal & Policies', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_legal_heading', array( 'label' => __( 'Page Heading', 'rarefolk' ), 'section' => 'rarefolk_legal_header', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_legal_subtitle', array( 'default' => 'Transparency and trust are foundational to the Rare Folk experience. Review our commitments to your privacy, satisfaction, and our shared terms of engagement.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_legal_subtitle', array( 'label' => __( 'Subtitle', 'rarefolk' ), 'section' => 'rarefolk_legal_header', 'type' => 'textarea' ) );

    // Legal content sections use WordPress editor pages for rich text
    $wp_customize->add_section( 'rarefolk_legal_privacy', array(
        'title' => __( 'Privacy Policy', 'rarefolk' ),
        'panel' => 'rarefolk_legal',
    ) );

    $wp_customize->add_setting( 'rarefolk_privacy_content', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'rarefolk_privacy_content', array( 'label' => __( 'Privacy Policy Content (HTML allowed)', 'rarefolk' ), 'section' => 'rarefolk_legal_privacy', 'type' => 'textarea' ) );

    $wp_customize->add_section( 'rarefolk_legal_shipping', array(
        'title' => __( 'Shipping & Returns', 'rarefolk' ),
        'panel' => 'rarefolk_legal',
    ) );

    $wp_customize->add_setting( 'rarefolk_shipping_content', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'rarefolk_shipping_content', array( 'label' => __( 'Shipping & Returns Content (HTML allowed)', 'rarefolk' ), 'section' => 'rarefolk_legal_shipping', 'type' => 'textarea' ) );

    $wp_customize->add_section( 'rarefolk_legal_terms', array(
        'title' => __( 'Terms & Conditions', 'rarefolk' ),
        'panel' => 'rarefolk_legal',
    ) );

    $wp_customize->add_setting( 'rarefolk_terms_content', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'rarefolk_terms_content', array( 'label' => __( 'Terms & Conditions Content (HTML allowed)', 'rarefolk' ), 'section' => 'rarefolk_legal_terms', 'type' => 'textarea' ) );

    // =========================================
    // PANEL: Product Page
    // =========================================
    $wp_customize->add_panel( 'rarefolk_product', array(
        'title'    => __( 'Rare Folk — Product Page', 'rarefolk' ),
        'priority' => 45,
    ) );

    $wp_customize->add_section( 'rarefolk_product_story', array(
        'title' => __( 'Design Story Section', 'rarefolk' ),
        'panel' => 'rarefolk_product',
    ) );

    $wp_customize->add_setting( 'rarefolk_product_story_label', array( 'default' => 'The Design Story', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_product_story_label', array( 'label' => __( 'Section Label', 'rarefolk' ), 'section' => 'rarefolk_product_story', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_product_pairings_heading', array( 'default' => 'Curated Pairings', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'rarefolk_product_pairings_heading', array( 'label' => __( 'Pairings Section Heading', 'rarefolk' ), 'section' => 'rarefolk_product_story', 'type' => 'text' ) );

    // =========================================
    // PANEL: SEO Settings
    // =========================================
    $wp_customize->add_section( 'rarefolk_seo', array(
        'title'    => __( 'Rare Folk — SEO', 'rarefolk' ),
        'priority' => 100,
    ) );

    $wp_customize->add_setting( 'rarefolk_seo_home_title', array( 'default' => 'Rare Folk | Wear Culture. Create Identity.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'rarefolk_seo_home_title', array( 'label' => __( 'Homepage Title Tag', 'rarefolk' ), 'section' => 'rarefolk_seo', 'type' => 'text' ) );

    $wp_customize->add_setting( 'rarefolk_seo_home_desc', array( 'default' => 'Rare Folk is a premium streetwear brand. Curated cultural narratives for the discerning individual. Wear Culture. Create Identity.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'rarefolk_seo_home_desc', array( 'label' => __( 'Homepage Meta Description', 'rarefolk' ), 'section' => 'rarefolk_seo', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'rarefolk_seo_og_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rarefolk_seo_og_image', array(
        'label'   => __( 'Default Social Share Image (1200×630)', 'rarefolk' ),
        'section' => 'rarefolk_seo',
    ) ) );
}
add_action( 'customize_register', 'rarefolk_customize_register' );
