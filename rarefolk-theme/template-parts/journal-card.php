<?php
/**
 * Template Part: Journal Card
 *
 * Expects standard WordPress loop context (the_post() called).
 *
 * @package RareFolk
 */

$terms = get_the_terms( get_the_ID(), 'journal_category' );
$cat_name = $terms && ! is_wp_error( $terms ) ? $terms[0]->name : '';
$cat_slug = $terms && ! is_wp_error( $terms ) ? $terms[0]->slug : '';
$date = get_the_date( 'M d, Y' );
$image_style = isset( $args['image_style'] ) ? $args['image_style'] : 'aspect-ratio: 4/3;';
?>

<article class="journal-card" data-category="<?php echo esc_attr( $cat_slug ); ?>">
    <a href="<?php the_permalink(); ?>" style="display: block;">
        <div class="journal-image" style="<?php echo esc_attr( $image_style ); ?> overflow: hidden; margin-bottom: 24px;">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'rarefolk-journal-featured', array(
                    'style' => 'width:100%;height:100%;object-fit:cover;',
                    'loading' => 'lazy',
                ) ); ?>
            <?php endif; ?>
        </div>
        <div>
            <div class="journal-meta">
                <span class="text-label-caps text-muted"><?php echo esc_html( $cat_name ); ?></span>
                <span class="text-label-caps text-muted"><?php echo esc_html( $date ); ?></span>
            </div>
            <h3 class="journal-title text-headline-lg text-onyx" style="margin-bottom: 12px;">
                <?php the_title(); ?>
            </h3>
            <p class="text-body-md text-surface-variant"><?php echo esc_html( get_the_excerpt() ); ?></p>
        </div>
    </a>
</article>
