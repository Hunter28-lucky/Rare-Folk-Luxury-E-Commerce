<?php
/**
 * Template Part: Newsletter Section
 *
 * @package RareFolk
 */

$heading = get_theme_mod( 'rarefolk_newsletter_heading', 'Join the Inner Circle' );
$text = get_theme_mod( 'rarefolk_newsletter_text', 'Exclusive access to limited drops and cultural narratives.' );
?>

<section class="newsletter-section section-padding container-padding">
    <div class="newsletter-grid fade-up">
        <div>
            <h2 class="newsletter-heading"><?php echo esc_html( $heading ); ?></h2>
            <p class="newsletter-subtitle text-body-md"><?php echo esc_html( $text ); ?></p>
        </div>
        <div style="display: flex; align-items: flex-end;">
            <form class="newsletter-form" id="newsletter-form">
                <?php wp_nonce_field( 'rarefolk_nonce', 'newsletter_nonce' ); ?>
                <input type="email" name="email" placeholder="<?php esc_attr_e( 'YOUR EMAIL ADDRESS', 'rarefolk' ); ?>" required aria-label="<?php esc_attr_e( 'Email Address', 'rarefolk' ); ?>">
                <button type="submit"><?php esc_html_e( 'Subscribe', 'rarefolk' ); ?></button>
            </form>
        </div>
    </div>
</section>
