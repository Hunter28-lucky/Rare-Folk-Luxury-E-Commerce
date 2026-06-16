<?php
/**
 * WooCommerce Single Product Template
 *
 * @package RareFolk
 */

get_header();

$story_label     = get_theme_mod( 'rarefolk_product_story_label', 'The Design Story' );
$pairings_heading = get_theme_mod( 'rarefolk_product_pairings_heading', 'Curated Pairings' );
?>

<main style="padding-top: 120px; padding-bottom: 80px;">
    <?php rarefolk_breadcrumbs(); ?>

    <?php while ( have_posts() ) : the_post();
        global $product;

        // Product images
        $main_image_id = $product->get_image_id();
        $gallery_ids   = $product->get_gallery_image_ids();
        $main_image    = $main_image_id ? wp_get_attachment_url( $main_image_id ) : '';
    ?>

    <section class="container-padding" style="padding-top: 32px; padding-bottom: 80px;">
        <div class="product-detail">
            <!-- Gallery -->
            <div class="product-gallery">
                <div class="main-image">
                    <?php if ( $main_image ) : ?>
                        <img src="<?php echo esc_url( $main_image ); ?>"
                             alt="<?php echo esc_attr( $product->get_name() ); ?>"
                             fetchpriority="high"
                             loading="eager">
                    <?php endif; ?>
                </div>
                <?php if ( ! empty( $gallery_ids ) ) : ?>
                    <div class="thumb-grid">
                        <?php foreach ( array_slice( $gallery_ids, 0, 4 ) as $img_id ) :
                            $img_url = wp_get_attachment_url( $img_id );
                        ?>
                            <div class="thumb">
                                <img src="<?php echo esc_url( $img_url ); ?>"
                                     alt="<?php echo esc_attr( $product->get_name() . ' detail' ); ?>"
                                     loading="lazy">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Product Info -->
            <aside class="product-sidebar">
                <div class="sticky-content">
                    <div>
                        <h1 class="product-title"><?php the_title(); ?></h1>
                        <p class="product-price-display"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
                    </div>

                    <!-- Size Selector (for variable products) -->
                    <?php if ( $product->is_type( 'variable' ) ) :
                        $attributes = $product->get_variation_attributes();
                        foreach ( $attributes as $attr_name => $options ) :
                    ?>
                        <div class="size-selector">
                            <div class="size-header">
                                <span class="text-label-caps text-onyx"><?php echo esc_html( wc_attribute_label( $attr_name ) ); ?></span>
                            </div>
                            <div class="size-grid">
                                <?php foreach ( $options as $option ) : ?>
                                    <button class="size-btn" data-attribute="<?php echo esc_attr( $attr_name ); ?>" data-value="<?php echo esc_attr( $option ); ?>">
                                        <?php echo esc_html( $option ); ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach;
                    endif; ?>

                    <!-- Add to Cart -->
                    <form class="cart" method="post" enctype="multipart/form-data">
                        <?php
                        if ( $product->is_type( 'simple' ) ) {
                            woocommerce_quantity_input( array(
                                'min_value'   => 1,
                                'max_value'   => $product->get_max_purchase_quantity(),
                                'input_value' => 1,
                            ), $product );
                        }
                        ?>
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="add-to-bag">
                            <?php esc_html_e( 'Add to Bag', 'rarefolk' ); ?>
                        </button>
                    </form>

                    <!-- Product Details Accordion -->
                    <div style="margin-top: 16px;">
                        <?php if ( $product->get_short_description() ) : ?>
                        <details class="accordion-item" open>
                            <summary>
                                <span class="text-cta text-onyx"><?php esc_html_e( 'Description', 'rarefolk' ); ?></span>
                                <span class="material-symbols-outlined icon" style="font-size: 20px;">expand_more</span>
                            </summary>
                            <div class="accordion-content text-body-md">
                                <?php echo wp_kses_post( $product->get_short_description() ); ?>
                            </div>
                        </details>
                        <?php endif; ?>

                        <?php
                        // Product attributes as accordion items
                        $product_attributes = $product->get_attributes();
                        $display_attrs = array();
                        foreach ( $product_attributes as $attr ) {
                            if ( is_a( $attr, 'WC_Product_Attribute' ) && $attr->get_visible() && ! $attr->get_variation() ) {
                                $display_attrs[] = $attr;
                            }
                        }

                        if ( ! empty( $display_attrs ) ) :
                        ?>
                        <details class="accordion-item">
                            <summary>
                                <span class="text-cta text-onyx"><?php esc_html_e( 'Details & Fabric', 'rarefolk' ); ?></span>
                                <span class="material-symbols-outlined icon" style="font-size: 20px;">expand_more</span>
                            </summary>
                            <div class="accordion-content text-body-md">
                                <ul>
                                    <?php foreach ( $display_attrs as $attr ) :
                                        $values = wc_get_product_terms( $product->get_id(), $attr->get_name(), array( 'fields' => 'names' ) );
                                        if ( empty( $values ) ) {
                                            $values = $attr->get_options();
                                        }
                                    ?>
                                        <li><strong><?php echo esc_html( wc_attribute_label( $attr->get_name() ) ); ?>:</strong> <?php echo esc_html( implode( ', ', $values ) ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </details>
                        <?php endif; ?>

                        <details class="accordion-item">
                            <summary>
                                <span class="text-cta text-onyx"><?php esc_html_e( 'Shipping & Returns', 'rarefolk' ); ?></span>
                                <span class="material-symbols-outlined icon" style="font-size: 20px;">expand_more</span>
                            </summary>
                            <div class="accordion-content text-body-md">
                                <p><?php esc_html_e( 'Complimentary expedited shipping on all orders. Returns accepted within 14 days, items must be in original condition.', 'rarefolk' ); ?></p>
                            </div>
                        </details>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <!-- Design Story Section -->
    <?php if ( $product->get_description() ) : ?>
    <section class="design-story">
        <div class="story-image">
            <?php
            $story_img = ! empty( $gallery_ids ) ? wp_get_attachment_url( end( $gallery_ids ) ) : $main_image;
            ?>
            <img src="<?php echo esc_url( $story_img ); ?>" alt="<?php echo esc_attr( $product->get_name() . ' design story' ); ?>" loading="lazy">
        </div>
        <div class="story-content">
            <div class="story-inner">
                <span class="text-label-caps text-muted" style="margin-bottom: 24px; display: block;"><?php echo esc_html( $story_label ); ?></span>
                <div class="text-body-lg text-surface-variant" style="line-height: 1.8;">
                    <?php echo wp_kses_post( $product->get_description() ); ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Curated Pairings (Related Products) -->
    <?php
    $related_ids = wc_get_related_products( $product->get_id(), 3 );
    if ( ! empty( $related_ids ) ) :
    ?>
    <section class="section-padding container-padding">
        <div class="collection-header fade-up">
            <h2 class="text-headline-xl" style="font-size: 32px;"><?php echo esc_html( $pairings_heading ); ?></h2>
        </div>
        <div class="product-grid three-col">
            <?php foreach ( $related_ids as $related_id ) :
                $related = wc_get_product( $related_id );
                $img_url = wp_get_attachment_url( $related->get_image_id() ) ?: '';
            ?>
                <article class="product-card fade-up">
                    <a href="<?php echo esc_url( get_permalink( $related_id ) ); ?>" style="display: block;">
                        <div class="product-image-wrapper">
                            <img src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( $related->get_name() ); ?>"
                                 loading="lazy">
                        </div>
                    </a>
                    <div class="product-info">
                        <h3 class="product-name"><?php echo esc_html( $related->get_name() ); ?></h3>
                        <span class="product-price"><?php echo wp_kses_post( $related->get_price_html() ); ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
