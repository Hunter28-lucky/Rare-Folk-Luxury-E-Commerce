<?php
/**
 * Search Results Template
 *
 * @package RareFolk
 */

get_header();
?>

<main style="padding-top: 128px; padding-bottom: 80px; min-height: 60vh;">
    <header class="page-header container-padding">
        <span class="text-label-caps text-muted" style="display: block; margin-bottom: 16px;"><?php esc_html_e( 'Search Results', 'rarefolk' ); ?></span>
        <h1 class="text-headline-xl text-onyx">
            <?php printf( esc_html__( 'Results for "%s"', 'rarefolk' ), get_search_query() ); ?>
        </h1>
    </header>

    <?php rarefolk_breadcrumbs(); ?>

    <section class="container-padding search-results-list">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="search-result-item">
                    <span class="text-label-caps text-muted" style="display: block; margin-bottom: 8px;">
                        <?php
                        $post_type = get_post_type();
                        if ( $post_type === 'journal_post' ) {
                            esc_html_e( 'Journal', 'rarefolk' );
                        } elseif ( $post_type === 'product' ) {
                            esc_html_e( 'Product', 'rarefolk' );
                        } elseif ( $post_type === 'page' ) {
                            esc_html_e( 'Page', 'rarefolk' );
                        } else {
                            esc_html_e( 'Post', 'rarefolk' );
                        }
                        ?>
                    </span>
                    <h2 style="margin-bottom: 8px;">
                        <a class="text-headline-lg text-onyx" href="<?php the_permalink(); ?>" style="transition: color 0.3s ease;">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <p class="text-body-md text-surface-variant"><?php echo esc_html( get_the_excerpt() ); ?></p>
                </article>
            <?php endwhile; ?>

            <div style="text-align: center; margin-top: 64px;">
                <?php the_posts_pagination( array(
                    'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
                    'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
                ) ); ?>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 96px 0;">
                <h2 class="text-headline-lg text-onyx" style="margin-bottom: 16px;">
                    <?php esc_html_e( 'No results found.', 'rarefolk' ); ?>
                </h2>
                <p class="text-body-lg text-muted" style="margin-bottom: 48px;">
                    <?php esc_html_e( 'Try adjusting your search to find what you\'re looking for.', 'rarefolk' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hero-cta" style="background-color: var(--color-onyx-black); color: var(--color-off-white);">
                    <?php esc_html_e( 'Return Home', 'rarefolk' ); ?>
                </a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
