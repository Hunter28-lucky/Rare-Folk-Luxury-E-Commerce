<?php
/**
 * Template Name: Contact
 *
 * @package RareFolk
 */

get_header();

$heading   = get_theme_mod( 'rarefolk_contact_heading', "Inquiries &\nDialogues" );
$subtitle  = get_theme_mod( 'rarefolk_contact_subtitle', 'We invite conversations regarding bespoke commissions, archival acquisitions, or press inquiries. Our atelier reviews correspondence with the utmost discretion.' );
$email     = get_theme_mod( 'rarefolk_email', 'kul@rarefolk.in' );
$website   = get_theme_mod( 'rarefolk_website', 'https://rarefolk.in' );
$instagram = get_theme_mod( 'rarefolk_instagram', '#' );
$btn_text  = get_theme_mod( 'rarefolk_contact_btn_text', 'Transmit' );
?>

<main style="padding-top: 128px; padding-bottom: 80px; min-height: 100vh; display: flex; flex-direction: column; justify-content: center;">
    <?php rarefolk_breadcrumbs(); ?>

    <div class="container-padding contact-grid">
        <div style="grid-column: span 1; margin-bottom: 64px;">
            <h1 class="text-display-lg-mobile text-onyx" style="margin-bottom: 32px; line-height: 1.1;">
                <?php echo nl2br( esc_html( $heading ) ); ?>
            </h1>
            <p class="text-body-lg text-surface-variant" style="margin-bottom: 48px; max-width: 448px;">
                <?php echo esc_html( $subtitle ); ?>
            </p>

            <div style="display: flex; flex-direction: column; gap: 32px;">
                <div>
                    <h3 class="text-label-caps text-muted" style="margin-bottom: 8px;"><?php esc_html_e( 'Direct Correspondence', 'rarefolk' ); ?></h3>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-body-lg text-onyx" style="transition: color 0.3s ease; position: relative; display: inline-block;">
                        <?php echo esc_html( $email ); ?>
                    </a>
                </div>
                <div>
                    <h3 class="text-label-caps text-muted" style="margin-bottom: 8px;"><?php esc_html_e( 'Digital Presence', 'rarefolk' ); ?></h3>
                    <div style="display: flex; gap: 24px;">
                        <?php if ( $website ) : ?>
                            <a href="<?php echo esc_url( $website ); ?>" class="text-body-lg text-onyx" target="_blank" rel="noopener noreferrer">
                                <?php echo esc_html( wp_parse_url( $website, PHP_URL_HOST ) ?: $website ); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ( $instagram && $instagram !== '#' ) : ?>
                            <a href="<?php echo esc_url( $instagram ); ?>" class="text-body-lg text-onyx" target="_blank" rel="noopener noreferrer">Instagram</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="grid-column: span 1;">
            <div class="contact-form-wrapper">
                <div class="corner-accent"></div>
                <form id="contact-form" style="display: flex; flex-direction: column; gap: 40px;">
                    <?php wp_nonce_field( 'rarefolk_nonce', 'contact_nonce' ); ?>

                    <div>
                        <label class="text-label-caps text-onyx" for="contact-name" style="display: block; margin-bottom: 4px;"><?php esc_html_e( 'Full Name', 'rarefolk' ); ?></label>
                        <input class="minimal-input" id="contact-name" name="name" placeholder="Jane Doe" required type="text">
                    </div>

                    <div>
                        <label class="text-label-caps text-onyx" for="contact-email" style="display: block; margin-bottom: 4px;"><?php esc_html_e( 'Email Address', 'rarefolk' ); ?></label>
                        <input class="minimal-input" id="contact-email" name="email" placeholder="jane@example.com" required type="email">
                    </div>

                    <div style="position: relative;">
                        <label class="text-label-caps text-onyx" for="contact-subject" style="display: block; margin-bottom: 4px;"><?php esc_html_e( 'Subject Matter', 'rarefolk' ); ?></label>
                        <select class="minimal-input" id="contact-subject" name="subject" style="appearance: none; cursor: pointer;">
                            <option disabled selected value=""><?php esc_html_e( 'Select an area of interest...', 'rarefolk' ); ?></option>
                            <option value="bespoke"><?php esc_html_e( 'Bespoke Commission', 'rarefolk' ); ?></option>
                            <option value="archival"><?php esc_html_e( 'Archival Inquiry', 'rarefolk' ); ?></option>
                            <option value="press"><?php esc_html_e( 'Press & Media', 'rarefolk' ); ?></option>
                            <option value="other"><?php esc_html_e( 'General Dialogue', 'rarefolk' ); ?></option>
                        </select>
                        <div style="position: absolute; right: 0; top: 50%; margin-top: 8px; pointer-events: none; color: var(--color-muted-gray);">
                            <span class="material-symbols-outlined" style="font-size: 14px;">expand_more</span>
                        </div>
                    </div>

                    <div>
                        <label class="text-label-caps text-onyx" for="contact-message" style="display: block; margin-bottom: 4px;"><?php esc_html_e( 'Your Message', 'rarefolk' ); ?></label>
                        <textarea class="minimal-input" id="contact-message" name="message" placeholder="<?php esc_attr_e( 'Detail your inquiry...', 'rarefolk' ); ?>" required rows="4" style="resize: none;"></textarea>
                    </div>

                    <div style="padding-top: 16px;">
                        <button class="submit-btn" type="submit">
                            <span><?php echo esc_html( $btn_text ); ?></span>
                            <span class="material-symbols-outlined" style="font-size: 14px;">arrow_forward</span>
                        </button>
                    </div>

                    <div id="contact-response" style="display: none;" class="text-body-md"></div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
