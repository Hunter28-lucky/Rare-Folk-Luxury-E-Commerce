<?php
/**
 * Template Name: Shop
 * Also handles WooCommerce shop page when WooCommerce is active
 *
 * @package RareFolk
 */

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

    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
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
            <div class="product-grid three-col">
                <?php
                $products = wc_get_products( array(
                    'limit'   => -1,
                    'status'  => 'publish',
                    'orderby' => 'date',
                    'order'   => 'DESC',
                ) );

                foreach ( $products as $product ) :
                    $image_url = wp_get_attachment_url( $product->get_image_id() ) ?: '';
                    $product_cats = get_the_terms( $product->get_id(), 'product_cat' );
                    $cat_slugs = '';
                    if ( $product_cats && ! is_wp_error( $product_cats ) ) {
                        $cat_slugs = implode( ' ', wp_list_pluck( $product_cats, 'slug' ) );
                    }
                ?>
                    <article class="product-card" data-categories="<?php echo esc_attr( $cat_slugs ); ?>">
                        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" style="display: block;">
                            <div class="product-image-wrapper">
                                <img src="<?php echo esc_url( $image_url ); ?>"
                                     alt="<?php echo esc_attr( $product->get_name() ); ?>"
                                     loading="lazy">
                                <button class="favorite-btn" aria-label="<?php esc_attr_e( 'Add to Wishlist', 'rarefolk' ); ?>">
                                    <span class="material-symbols-outlined">favorite</span>
                                </button>
                                <div class="quick-add">
                                    <button data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"><?php esc_html_e( 'Quick Add', 'rarefolk' ); ?></button>
                                </div>
                            </div>
                        </a>
                        <div class="product-info">
                            <h3 class="product-name"><?php echo esc_html( $product->get_name() ); ?></h3>
                            <?php
                            $attrs = $product->get_attribute( 'color' );
                            if ( $attrs ) :
                            ?>
                                <span class="product-variant"><?php echo esc_html( $attrs ); ?></span>
                            <?php endif; ?>
                            <span class="product-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

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

<?php get_footer(); ?>
