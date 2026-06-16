<?php
/**
 * Template Part: Product Card
 * 
 * Used in product grids across the site.
 * Expects $args['product'] to be a WC_Product object.
 *
 * @package RareFolk
 */

$product = isset( $args['product'] ) ? $args['product'] : null;
if ( ! $product ) return;

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
                <button data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
                    <?php esc_html_e( 'Quick Add', 'rarefolk' ); ?>
                </button>
            </div>
        </div>
    </a>
    <div class="product-info">
        <h3 class="product-name"><?php echo esc_html( $product->get_name() ); ?></h3>
        <?php
        $color = $product->get_attribute( 'color' );
        if ( $color ) :
        ?>
            <span class="product-variant"><?php echo esc_html( $color ); ?></span>
        <?php endif; ?>
        <span class="product-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
    </div>
</article>
