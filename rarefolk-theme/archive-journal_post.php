<?php
/**
 * Journal Archive Template
 *
 * @package RareFolk
 */

get_header();

$categories = get_terms( array(
    'taxonomy'   => 'journal_category',
    'hide_empty' => false,
) );
?>

<main style="padding-top: 120px; padding-bottom: 80px;">
    <header class="page-header container-padding" style="margin-bottom: 80px;">
        <h1 class="text-display-lg-mobile text-onyx"><?php esc_html_e( 'Journal', 'rarefolk' ); ?></h1>
        <p class="text-body-lg text-surface-variant"><?php esc_html_e( 'Explorations in culture, identity, and the narratives woven into the fabric of modern heritage.', 'rarefolk' ); ?></p>
    </header>

    <?php rarefolk_breadcrumbs(); ?>

    <!-- Category Filters -->
    <div class="container-padding" style="margin-bottom: 64px; overflow-x: auto;">
        <div style="display: flex; gap: 32px; border-bottom: 1px solid rgba(150,150,150,0.3); padding-bottom: 16px; min-width: max-content;">
            <button class="filter-tab active text-label-caps" data-filter="all"><?php esc_html_e( 'All Narratives', 'rarefolk' ); ?></button>
            <?php foreach ( $categories as $cat ) : ?>
                <button class="filter-tab text-label-caps" data-filter="<?php echo esc_attr( $cat->slug ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Articles Grid -->
    <section class="container-padding">
        <?php if ( have_posts() ) : ?>
            <div class="journal-grid">
                <?php
                $post_count = 0;
                while ( have_posts() ) : the_post();
                    $post_count++;
                    $terms = get_the_terms( get_the_ID(), 'journal_category' );
                    $cat_slug = $terms && ! is_wp_error( $terms ) ? $terms[0]->slug : '';
                    $cat_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';
                    $date = get_the_date( 'M d, Y' );

                    // Determine grid span based on position
                    if ( $post_count === 1 ) {
                        $col_class = 'style="grid-column: span 1;"';
                        $image_style = 'height: 512px;';
                    } elseif ( $post_count === 2 ) {
                        $col_class = 'style="grid-column: span 1;"';
                        $image_style = 'aspect-ratio: 3/4;';
                    } elseif ( $post_count === 3 ) {
                        $col_class = 'style="grid-column: span 1;"';
                        $image_style = 'aspect-ratio: 1;';
                    } else {
                        $col_class = 'style="grid-column: span 1;"';
                        $image_style = 'aspect-ratio: 4/3;';
                    }
                ?>
                    <article class="journal-card" <?php echo $col_class; ?> data-category="<?php echo esc_attr( $cat_slug ); ?>">
                        <a href="<?php the_permalink(); ?>" style="display: block;">
                            <div class="journal-image" style="<?php echo esc_attr( $image_style ); ?> overflow: hidden; margin-bottom: 24px;">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'rarefolk-journal-featured', array( 'style' => 'width:100%;height:100%;object-fit:cover;', 'loading' => 'lazy' ) ); ?>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div class="journal-meta">
                                    <span class="text-label-caps text-muted"><?php echo esc_html( $cat_name ); ?></span>
                                    <span class="text-label-caps text-muted"><?php echo esc_html( $date ); ?></span>
                                </div>
                                <h3 class="journal-title text-headline-lg text-onyx" style="margin-bottom: 12px;"><?php the_title(); ?></h3>
                                <p class="text-body-md text-surface-variant"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div style="text-align: center; margin-top: 96px;">
                <?php
                the_posts_pagination( array(
                    'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
                    'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
                    'mid_size'  => 1,
                ) );
                ?>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 96px 0;">
                <h2 class="text-headline-lg text-onyx" style="margin-bottom: 16px;"><?php esc_html_e( 'No articles yet.', 'rarefolk' ); ?></h2>
                <p class="text-body-lg text-muted"><?php esc_html_e( 'Check back soon for cultural narratives and editorial content.', 'rarefolk' ); ?></p>
            </div>
        <?php endif; ?>
    </section>

    <!-- Newsletter -->
    <?php get_template_part( 'template-parts/newsletter' ); ?>
</main>

<?php get_footer(); ?>
