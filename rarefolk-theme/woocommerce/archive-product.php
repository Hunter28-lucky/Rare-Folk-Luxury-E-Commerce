<?php
/**
 * WooCommerce Archive Product Template
 *
 * @package RareFolk
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header();

$heading     = get_theme_mod( 'rarefolk_shop_heading', 'The Boutique' );
$description = get_theme_mod( 'rarefolk_shop_description', 'Curated artifacts and limited editions. A synthesis of heritage craftsmanship and modern anonymity.' );

$narr_image   = get_theme_mod( 'rarefolk_shop_narrative_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDSuIb9O58jSTT_HpkXLgnVTowPc8mNbsWh1uiJ3lNa2hnSGHsGf79j_aMQFFokfyNYZgJ72ioVGVYgPHSf8Gd_YXt7gbx2Mww-gQPFWwT_aOtjSwWfetq06B6PCh5oNF2oaf8xyvesHIfeoktVQ92l78RzxdijWGwQuHBVl_Qno7PQcc2Xk5NpKHvOcZdYzzelmXvlkpco4qmBYDmWZlQ-zVruR1uSHMYYrch8tIBfBnM-WQXarPorIzKG1CoGzzOKvdXnFmk3E64' );
$narr_heading = get_theme_mod( 'rarefolk_shop_narrative_heading', "Beyond the Seam.\nA Study in Intent." );
$narr_text    = get_theme_mod( 'rarefolk_shop_narrative_text', 'Every piece in our collection is a dialogue between raw material and refined execution. We reject the ephemeral cycles of seasonal trends in favor of enduring artifacts that age alongside the wearer.' );
$narr_cta     = get_theme_mod( 'rarefolk_shop_narrative_cta', 'Read the Narrative' );
?>

<main style="padding-top: 128px; padding-bottom: 160px;">
    <header class="page-header container-padding" style="padding-top: 48px; padding-bottom: 80px;">
        <h1 class="text-display-lg-mobile text-onyx"><?php echo esc_html( $heading ); ?></h1>
        <p class="text-body-lg text-muted"><?php echo esc_html( $description ); ?></p>
    </header>

    <?php rarefolk_breadcrumbs(); ?>

    <!-- Filter Bar -->
    <section class="container-padding" style="margin-bottom: 64px;">
        <div class="filter-bar">
            <div class="filter-tabs">
                <button class="filter-tab active"><?php esc_html_e( 'All Objects', 'rarefolk' ); ?></button>
                <?php
                $product_cats = get_terms( array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                ) );
                if ( $product_cats && ! is_wp_error( $product_cats ) ) {
                    foreach ( $product_cats as $cat ) {
                        echo '<button class="filter-tab" data-category="' . esc_attr( $cat->slug ) . '">' . esc_html( $cat->name ) . '</button>';
                    }
                }
                ?>
            </div>
            <div style="display: flex; align-items: center; gap: 32px;">
                <div style="position: relative;">
                    <button class="text-label-caps text-onyx" style="display: flex; align-items: center; gap: 8px;">
                        <?php esc_html_e( 'Sort By', 'rarefolk' ); ?>
                        <span class="material-symbols-outlined" style="font-size: 16px;">keyboard_arrow_down</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="container-padding">
        <?php if ( woocommerce_product_loop() ) : ?>
            <div class="product-grid three-col">
                <?php
                while ( have_posts() ) :
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                endwhile;
                ?>
            </div>
            <?php
            /**
             * Hook: woocommerce_after_shop_loop.
             */
            do_action( 'woocommerce_after_shop_loop' );
            ?>
        <?php else : ?>
            <?php
            /**
             * Hook: woocommerce_no_products_found.
             */
            do_action( 'woocommerce_no_products_found' );
            ?>
        <?php endif; ?>
    </section>

    <!-- Narrative Banner -->
    <section class="shop-narrative" style="margin-top: 160px;">
        <div class="image-side">
            <img src="<?php echo esc_url( $narr_image ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $narr_heading ) ); ?>" loading="lazy">
        </div>
        <div class="text-side">
            <h2 class="text-headline-xl text-onyx" style="margin-bottom: 32px; line-height: 1.2;">
                <?php echo nl2br( esc_html( $narr_heading ) ); ?>
            </h2>
            <p class="text-body-lg text-surface-variant" style="max-width: 560px; margin-bottom: 48px;">
                <?php echo esc_html( $narr_text ); ?>
            </p>
            <a class="text-cta text-onyx" href="<?php echo esc_url( home_url( '/about/' ) ); ?>" style="border-bottom: 1px solid var(--color-onyx-black); padding-bottom: 8px; display: inline-flex; width: max-content;">
                <?php echo esc_html( $narr_cta ); ?>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
