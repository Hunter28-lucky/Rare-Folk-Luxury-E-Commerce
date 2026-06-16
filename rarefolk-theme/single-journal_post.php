<?php
/**
 * Single Journal Article Template
 *
 * @package RareFolk
 */

get_header();
?>

<main style="padding-top: 120px; padding-bottom: 80px;">
    <?php rarefolk_breadcrumbs(); ?>

    <?php while ( have_posts() ) : the_post();
        $terms = get_the_terms( get_the_ID(), 'journal_category' );
        $cat_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';
        $date = get_the_date( 'M d, Y' );
    ?>

    <article class="container-padding" style="max-width: 960px; margin: 0 auto;">
        <!-- Article Header -->
        <header style="text-align: center; margin-bottom: 64px;">
            <?php if ( $cat_name ) : ?>
                <span class="text-label-caps text-gold" style="display: block; margin-bottom: 24px;"><?php echo esc_html( $cat_name ); ?></span>
            <?php endif; ?>
            <h1 class="text-display-lg-mobile text-onyx" style="margin-bottom: 16px; line-height: 1.2;">
                <?php the_title(); ?>
            </h1>
            <p class="text-body-md text-muted"><?php echo esc_html( $date ); ?> &middot; <?php echo esc_html( get_the_author() ); ?></p>
        </header>

        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div style="margin-bottom: 64px; overflow: hidden;">
                <?php the_post_thumbnail( 'rarefolk-hero', array(
                    'style' => 'width: 100%; height: auto; object-fit: cover;',
                    'loading' => 'eager',
                    'fetchpriority' => 'high',
                ) ); ?>
            </div>
        <?php endif; ?>

        <!-- Article Content -->
        <div class="text-body-lg" style="color: var(--color-on-surface-variant); line-height: 1.8;">
            <?php the_content(); ?>
        </div>

        <!-- Post Navigation -->
        <nav style="display: flex; justify-content: space-between; align-items: center; margin-top: 96px; padding-top: 32px; border-top: 1px solid rgba(150,150,150,0.2);">
            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <?php if ( $prev ) : ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="text-cta text-muted" style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                    <?php echo esc_html( get_the_title( $prev ) ); ?>
                </a>
            <?php else : ?>
                <span></span>
            <?php endif; ?>

            <?php if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="text-cta text-muted" style="display: flex; align-items: center; gap: 8px;">
                    <?php echo esc_html( get_the_title( $next ) ); ?>
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                </a>
            <?php endif; ?>
        </nav>
    </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
