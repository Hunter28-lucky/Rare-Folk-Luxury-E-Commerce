<?php
/**
 * 404 Error Page
 *
 * @package RareFolk
 */

get_header();
?>

<main class="error-404">
    <div class="container-padding" style="text-align: center;">
        <span class="text-label-caps text-muted" style="display: block; margin-bottom: 32px;">404 — Lost in the Archive</span>
        <h1 class="text-display-lg-mobile text-onyx" style="margin-bottom: 24px;">Page Not Found</h1>
        <p class="text-body-lg text-surface-variant" style="max-width: 560px; margin: 0 auto 48px;">
            <?php esc_html_e( 'The artifact you seek has either been archived or never existed. Perhaps it was too rare to remain.', 'rarefolk' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hero-cta" style="background-color: var(--color-onyx-black); color: var(--color-off-white);">
            <?php esc_html_e( 'Return to Origin', 'rarefolk' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
