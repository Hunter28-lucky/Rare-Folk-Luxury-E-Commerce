<?php
/**
 * Template Name: Legal
 *
 * @package RareFolk
 */

get_header();

$heading  = get_theme_mod( 'rarefolk_legal_heading', 'Legal & Policies' );
$subtitle = get_theme_mod( 'rarefolk_legal_subtitle', 'Transparency and trust are foundational to the Rare Folk experience. Review our commitments to your privacy, satisfaction, and our shared terms of engagement.' );

// Legal content — falls back to hardcoded defaults from the static site
$privacy_content = get_theme_mod( 'rarefolk_privacy_content', '<p class="text-body-md text-surface-variant" style="margin-bottom: 24px;">At Rare Folk, we recognize that your privacy is a paramount luxury. This Privacy Policy details the rigorous standards we apply to the collection, use, and safeguarding of your personal information when you engage with our boutique digital experiences.</p><div style="display: flex; flex-direction: column; gap: 32px; margin-top: 48px;"><div><h3 class="text-cta text-onyx" style="margin-bottom: 16px;">Information Architecture</h3><p class="text-body-md text-surface-variant">We collect only the essential data required to elevate your experience. This includes information provided during the creation of your Archive account, transaction details for boutique purchases, and contextual data gathered through your interaction with our Narratives to curate personalized editorial content.</p></div><div><h3 class="text-cta text-onyx" style="margin-bottom: 16px;">Data Stewardship</h3><p class="text-body-md text-surface-variant">Your data is never sold. It is utilized exclusively to fulfill orders, provide specialized customer service, and refine the aesthetic and functional quality of the Rare Folk platform. We employ industry-leading encryption protocols to ensure your information remains confidential and secure within our ecosystem.</p></div></div>' );

$shipping_content = get_theme_mod( 'rarefolk_shipping_content', '<p class="text-body-md text-surface-variant" style="margin-bottom: 24px;">The final stage of the Rare Folk journey is the physical delivery of our curated artifacts. We approach logistics with the same meticulous attention to detail as our design process.</p><div style="display: grid; grid-template-columns: 1fr; gap: 48px; margin-top: 48px;"><div class="glass-panel"><span class="material-symbols-outlined" style="font-size: 36px; margin-bottom: 16px; display: block;">local_shipping</span><h3 class="text-cta text-onyx" style="margin-bottom: 16px;">Global Transit</h3><p class="text-body-md text-surface-variant">We partner exclusively with premium logistics providers. All pieces are securely housed in our bespoke, climate-controlled packaging. Complimentary expedited shipping is provided for all archive acquisitions globally.</p></div><div class="glass-panel"><span class="material-symbols-outlined" style="font-size: 36px; margin-bottom: 16px; display: block;">assignment_return</span><h3 class="text-cta text-onyx" style="margin-bottom: 16px;">The Return Protocol</h3><p class="text-body-md text-surface-variant">Should an artifact not align with your expectations, we facilitate a seamless return process within 14 days of receipt. Items must be in their original, pristine condition with all authentication seals intact.</p></div></div>' );

$terms_content = get_theme_mod( 'rarefolk_terms_content', '<p class="text-body-md text-surface-variant" style="margin-bottom: 24px;">By accessing and utilizing the Rare Folk platform, you agree to comply with and be bound by the following terms, which govern our relationship with you in relation to this digital boutique.</p><div style="display: flex; flex-direction: column; gap: 32px; margin-top: 48px;"><div><h3 class="text-cta text-onyx" style="margin-bottom: 16px;">Intellectual Property</h3><p class="text-body-md text-surface-variant">All content present on this platform—including but not limited to photography, typographic layouts, narrative text, and branding—is the exclusive property of Rare Folk. Unauthorized reproduction, distribution, or exhibition is strictly prohibited.</p></div><div><h3 class="text-cta text-onyx" style="margin-bottom: 16px;">Acquisition Policies</h3><p class="text-body-md text-surface-variant">The display of items in our Boutique does not constitute a legally binding offer. An order is only confirmed upon our issuance of a formal digital receipt and authentication certificate. We reserve the right to limit quantities of exclusive releases.</p></div></div>' );
?>

<header class="page-header container-padding" style="border-bottom: 1px solid rgba(150,150,150,0.2);">
    <h1 class="text-display-lg-mobile text-onyx" style="text-transform: uppercase; letter-spacing: -0.05em;">
        <?php echo esc_html( $heading ); ?>
    </h1>
    <p class="text-body-lg text-surface-variant"><?php echo esc_html( $subtitle ); ?></p>
</header>

<?php rarefolk_breadcrumbs(); ?>

<main class="container-padding" style="padding-top: 96px; padding-bottom: 96px; flex-grow: 1;">
    <div class="legal-layout">
        <aside class="legal-sidebar">
            <div class="sticky-nav">
                <a class="text-label-caps text-onyx" href="#privacy"><?php esc_html_e( 'Privacy Policy', 'rarefolk' ); ?></a>
                <a class="text-label-caps text-muted" href="#shipping"><?php esc_html_e( 'Shipping & Returns', 'rarefolk' ); ?></a>
                <a class="text-label-caps text-muted" href="#terms"><?php esc_html_e( 'Terms & Conditions', 'rarefolk' ); ?></a>
            </div>
        </aside>

        <article class="legal-content" style="display: flex; flex-direction: column; gap: 96px;">
            <section class="legal-section" id="privacy">
                <h2 class="text-headline-xl"><?php esc_html_e( 'Privacy Policy', 'rarefolk' ); ?></h2>
                <?php echo wp_kses_post( $privacy_content ); ?>
            </section>

            <section class="legal-section" id="shipping">
                <h2 class="text-headline-xl"><?php esc_html_e( 'Shipping & Returns', 'rarefolk' ); ?></h2>
                <?php echo wp_kses_post( $shipping_content ); ?>
            </section>

            <section class="legal-section" id="terms">
                <h2 class="text-headline-xl"><?php esc_html_e( 'Terms & Conditions', 'rarefolk' ); ?></h2>
                <?php echo wp_kses_post( $terms_content ); ?>
            </section>
        </article>
    </div>
</main>

<?php get_footer(); ?>
