<?php
/**
 * Front Page Template (Homepage)
 *
 * @package RareFolk
 */

get_header();

// --- Customizer values ---
$hero_image   = get_theme_mod( 'rarefolk_hero_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA8LqLyIVs-VY9Y07lHfotbe7PlkvDf-1Pu2bYvfPAr2bgcZ57064ZqTlCW-GSXmeiPD2bed1ss06kkGaifXNEUdXCgunKBqeSkKT0MPWlWQ3_nyRJ5PsVcP2gNyzMkAAhsKzxakQvcL1ySiM-I_ofA8yboZKsgOI0JqoRCjY9M7HRFs5ll4NG4gIGxtiiqJfZ0LadzWxiyD_BWPZg27Y8S-ZdDBdMYX5RWffRh_tN87RHtVnlw2vgVJcXbzrn1CDeNnoTUu_3kQ3k' );
$hero_title   = get_theme_mod( 'rarefolk_hero_title', "Wear Culture.\nCreate Identity." );
$hero_cta     = get_theme_mod( 'rarefolk_hero_cta_text', 'Explore Collection' );
$hero_cta_url = get_theme_mod( 'rarefolk_hero_cta_url', '#collections' );
$hero_alt     = get_theme_mod( 'rarefolk_hero_alt', 'Wear Culture. Create Identity.' );

$phil_heading = get_theme_mod( 'rarefolk_philosophy_heading', 'Sharing Culture' );
$phil_text    = get_theme_mod( 'rarefolk_philosophy_text', 'We believe in the power of stories woven into fabric. Every piece is a canvas, carrying the weight of heritage and the spark of modern interpretation. We don\'t just create garments; we curate cultural narratives for the discerning individual.' );

$feat_heading  = get_theme_mod( 'rarefolk_featured_heading', 'Curated Edit' );
$feat_link     = get_theme_mod( 'rarefolk_featured_link_text', 'View All' );

$narr_image    = get_theme_mod( 'rarefolk_narrative_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDtOw5cc-1k2RGPJVlZuCZDWtgE29YcHfjleKCAEB6ebUXIPzHgJD7bm3iOkaxV5nAZ4lVmySU_sz5BWtVSy6AuhiNWhUWBZyYidl2sgHJ57y1jUp2ShURPF58l5fXf0GYNsgYRK-6qi8AjSJxejkpb0x0EI82NZhpJFvnx5h3UiUekb1JlXYKhue6Etl-X4rRQc554Y4qgi-y8QIf_japm8hncro8DKuy3zlPztDOhSbzfzqov_7_HgK_mJF0efjc0nC5DtCdVcGE' );
$narr_heading  = get_theme_mod( 'rarefolk_narrative_heading', 'The Symbolism' );
$narr_text     = get_theme_mod( 'rarefolk_narrative_text', 'Our latest collection draws inspiration from ancient geometric motifs, reimagined through a brutalist lens. Each pattern is meticulously researched, honoring its origins while being stripped down to its rawest visual essence.' );
$narr_cta      = get_theme_mod( 'rarefolk_narrative_cta', 'Read the Journal' );
$narr_cta_url  = get_theme_mod( 'rarefolk_narrative_cta_url', get_post_type_archive_link( 'journal_post' ) );
?>

<!-- Hero Section -->
<header class="hero">
    <div class="hero-bg">
        <img src="<?php echo esc_url( $hero_image ); ?>"
             alt="<?php echo esc_attr( $hero_alt ); ?>"
             class="parallax"
             style="--scroll-offset: calc(var(--scroll-y, 0) * 0.4px);"
             fetchpriority="high"
             loading="eager">
        <div class="overlay"></div>
    </div>
    <div class="hero-content fade-up">
        <h1 class="hero-title"><?php echo nl2br( esc_html( $hero_title ) ); ?></h1>
        <a class="hero-cta" href="<?php echo esc_url( $hero_cta_url ); ?>"><?php echo esc_html( $hero_cta ); ?></a>
    </div>
</header>

<!-- Philosophy Section -->
<section class="philosophy-section section-padding container-padding">
    <div class="philosophy-content fade-up">
        <h2 class="philosophy-heading"><?php echo esc_html( $phil_heading ); ?></h2>
        <p class="philosophy-text"><?php echo esc_html( $phil_text ); ?></p>
    </div>
</section>

<!-- Featured Collection -->
<section class="section-padding container-padding bg-surface" id="collections">
    <div class="collection-header fade-up">
        <h2 class="text-headline-xl" style="font-size: 32px;">
            <?php echo esc_html( $feat_heading ); ?>
        </h2>
        <?php
        $shop_url = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop/' );
        ?>
        <a class="view-all" href="<?php echo esc_url( $shop_url ); ?>"><?php echo esc_html( $feat_link ); ?></a>
    </div>

    <div class="product-grid">
        <?php
        if ( class_exists( 'WooCommerce' ) ) {
            // Pull featured/recent products from WooCommerce
            $products = wc_get_products( array(
                'limit'    => 2,
                'status'   => 'publish',
                'featured' => true,
                'orderby'  => 'date',
                'order'    => 'DESC',
            ) );

            if ( empty( $products ) ) {
                $products = wc_get_products( array(
                    'limit'   => 2,
                    'status'  => 'publish',
                    'orderby' => 'date',
                    'order'   => 'DESC',
                ) );
            }

            foreach ( $products as $index => $product ) {
                $image_url = wp_get_attachment_url( $product->get_image_id() ) ?: '';
                ?>
                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="product-card fade-up" style="transition-delay: <?php echo $index * 100; ?>ms;">
                    <div class="product-image-wrapper">
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php echo esc_attr( $product->get_name() ); ?>"
                             loading="lazy">
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-direction: column; gap: 8px;">
                        <div>
                            <h3 class="text-headline-lg" style="font-size: 18px;"><?php echo esc_html( $product->get_name() ); ?></h3>
                            <p class="text-body-md text-muted" style="margin-top: 4px;"><?php echo esc_html( $product->get_short_description() ); ?></p>
                        </div>
                        <span class="text-cta text-onyx"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
                    </div>
                </a>
                <?php
            }
        } else {
            // Fallback: Customizer-managed product cards
            for ( $i = 1; $i <= 2; $i++ ) {
                $p_image    = get_theme_mod( "rarefolk_product_{$i}_image", '' );
                $p_title    = get_theme_mod( "rarefolk_product_{$i}_title", $i === 1 ? 'Ancestral Lines Tee' : 'Void Structure Tee' );
                $p_subtitle = get_theme_mod( "rarefolk_product_{$i}_subtitle", $i === 1 ? 'Heavyweight Cotton / Oversized Fit' : 'Organic Pima / Boxy Cut' );
                $p_price    = get_theme_mod( "rarefolk_product_{$i}_price", $i === 1 ? '₹9,900' : '₹8,900' );
                $p_url      = get_theme_mod( "rarefolk_product_{$i}_url", '#' );
                ?>
                <a href="<?php echo esc_url( $p_url ); ?>" class="product-card fade-up" style="transition-delay: <?php echo ($i - 1) * 100; ?>ms;">
                    <div class="product-image-wrapper">
                        <?php if ( $p_image ) : ?>
                            <img src="<?php echo esc_url( $p_image ); ?>"
                                 alt="<?php echo esc_attr( $p_title ); ?>"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-direction: column; gap: 8px;">
                        <div>
                            <h3 class="text-headline-lg" style="font-size: 18px;"><?php echo esc_html( $p_title ); ?></h3>
                            <p class="text-body-md text-muted" style="margin-top: 4px;"><?php echo esc_html( $p_subtitle ); ?></p>
                        </div>
                        <span class="text-cta text-onyx"><?php echo esc_html( $p_price ); ?></span>
                    </div>
                </a>
                <?php
            }
        }
        ?>
    </div>
</section>

<!-- Narrative Block -->
<section class="narrative-block section-padding container-padding">
    <div class="narrative-grid">
        <div style="order: 2;" class="fade-up">
            <h2 class="narrative-heading"><?php echo esc_html( $narr_heading ); ?></h2>
            <p class="narrative-text"><?php echo esc_html( $narr_text ); ?></p>
            <a class="narrative-cta" href="<?php echo esc_url( $narr_cta_url ); ?>"><?php echo esc_html( $narr_cta ); ?></a>
        </div>
        <div style="order: 1;" class="fade-up">
            <div class="narrative-image">
                <img src="<?php echo esc_url( $narr_image ); ?>"
                     alt="<?php echo esc_attr( $narr_heading ); ?>"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<?php get_template_part( 'template-parts/newsletter' ); ?>

<?php get_footer(); ?>
