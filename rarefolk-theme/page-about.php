<?php
/**
 * Template Name: About
 *
 * @package RareFolk
 */

get_header();

// Customizer values
$hero_image  = get_theme_mod( 'rarefolk_about_hero_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAO2d0NW69KNb_xpxSjvJ1EH7dIKnexFhbMmn_iUkwhsQQc1WQZn5aqFz5TZ6rA-DWP4DovX693KBTLwQZgyGVoXmRVWmZVTmL5xH99WAymPBBV9yUi7CaEnarHR8HJNsxDWqxVwxua9pvAlHSXQS-s4qCH1T19SnlO5SPLW-KNsCgxsvCQSGOsOdBeUMqw1jHBz48qDcMFjWk2JLn6KWyn8TgHZxSra77qMwoldBKq5pU4dMMICnyDqa2yknERnbs662bMgaz48Ug' );
$hero_text   = get_theme_mod( 'rarefolk_about_hero_text', 'Rare Folk is a premium streetwear brand created for individuals who believe fashion is more than clothing.' );

$story_image   = get_theme_mod( 'rarefolk_story_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDZNiNEdmy3dz0C1ONNb84XI1CgdhjMsW8_rDSHsthTe50vCsgMDAmWdm7nRsJTI05SmXjRYaNlIHsWTQ_YCyhrtU6Nz-eybx6r_oYrbAJeDqLXdLVs91CQqpCJs6E2AxyBnHFeQwp8ztdkoK3KJ2roIAu0Y6m1Xgp5i31Q2LvFyhSmPJzUKY9xhlKuXEIBb1MMv9oiT4GVTwh8fWtnlZ4RtYPFRyJgTKI9aYsCvgr-gPlEv_pMiXwfOglFQxc46oG80jLxRjhrqvE' );
$story_label   = get_theme_mod( 'rarefolk_story_label', 'The Story' );
$story_heading = get_theme_mod( 'rarefolk_story_heading', 'Forged in the spaces between street culture and gallery walls.' );
$story_para1   = get_theme_mod( 'rarefolk_story_para1', 'We saw a landscape cluttered with loud logos and fast trends. Rare Folk was born from a desire for quiet confidence—pieces that speak through their silhouette, fabric, and subtle narrative details rather than a shouted brand name.' );
$story_para2   = get_theme_mod( 'rarefolk_story_para2', 'Every collection is a limited-run exploration of a specific theme, treated with the reverence of a gallery exhibition. We design for the discerning few who curate their wardrobe with intention.' );

$mission_image = get_theme_mod( 'rarefolk_mission_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDSDjjAolrvmhqENhkXG5Uh4je0b4gWcztN-Lvq7k6vIAnXJE03b5qsO5uv_8SrazqIOF6JBuLbV4_t6SE_koqWWfvFF-r_MkoasppyyWtCtGDOFWbftwqixcZGumZ3CFGwZ_M-pHj-XIhjTfjOtTO57b0K8YT0Q4jFtpMZ6f6-Vxl-UV3k5nlUA1pShYIhZVbcqcwGYiBYGMZH0zWWYSbvXTN55ePppj_vuIYL9jiZGNP9FO1S-RgTMn-EHAHfizFW4jeVNHCP8oM' );
$mission_text  = get_theme_mod( 'rarefolk_mission_text', 'To elevate everyday garments into objects of permanence and cultural significance.' );

$vision_image  = get_theme_mod( 'rarefolk_vision_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQQ6OfJiPqZmEaZWZZWIJC4XnCsdtoXj1iJYs9fOkDpx4j9_VB_D0FAzmp6RMqSmw-NExvgsgIs62ZRmW5cXvObJWZJxx7ewYFfpbDu6AyQzXZZtqrhMKhWxwb_NMQ847v6zGhT3bMh6u786bb9rJdPTjzXYAxHw0FsoMB1y1FemLogq4gltYH1qDuy9FvH3byEKWXR_Zhq4_M0ySlMwRmwinBBLpIH15rHbg4t4dMvmDb2aw0eRtVnYej1ITelT_i5fa9WuLOsRw' );
$vision_text   = get_theme_mod( 'rarefolk_vision_text', 'A wardrobe that serves as a silent prologue to the wearer\'s personal narrative.' );

$founder_image = get_theme_mod( 'rarefolk_founder_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA5FCTEmh53tpz84ATM9qJoJydDU8h4q8_qEglVKE0zlprVu72bWBp3vNqywhGvMwrbVyT28YluDZ8jMcTqK-PMOE77Otj5DoDF1G30bMZODE2TtTHiKzIHcgcTFR200cjjbvUOVc4t4Jh6aUhUtw3ySDbNKKyJosPv-swm4wobJhGCRK4mThBZ11Q6emNTGmgkiWhkzyQezV0WnGsX09MViK1f72EthlTSp9qYBi1bIaqzfKQgmVROI8UdDvdJGglsseTl6v9JT8c' );
$founder_label = get_theme_mod( 'rarefolk_founder_label', 'The Architect' );
$founder_quote = get_theme_mod( 'rarefolk_founder_quote', '"We are not merely dressing bodies; we are framing personas. Rare Folk is an invitation to inhabit a space of quiet distinction."' );
$founder_name  = get_theme_mod( 'rarefolk_founder_name', 'E. Aris' );
$founder_title_text = get_theme_mod( 'rarefolk_founder_title', 'Founder & Creative Director' );
?>

<!-- Hero Section -->
<header class="about-hero">
    <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Our Story Hero', 'rarefolk' ); ?>" fetchpriority="high" loading="eager">
    <div class="hero-content relative" style="z-index: 10; max-width: 960px; text-align: center; mix-blend-mode: difference; margin-top: 48px;">
        <h1 class="text-display-lg-mobile animate-fade-in-up" style="color: var(--color-off-white); margin-bottom: 32px; line-height: 1.2;">
            <?php echo esc_html( $hero_text ); ?>
        </h1>
    </div>
    <div class="gradient-overlay"></div>
</header>

<?php rarefolk_breadcrumbs(); ?>

<!-- The Story Section -->
<section class="section-padding container-padding bg-off-white">
    <div class="about-story-grid">
        <div style="grid-column: span 1; order: 2;" class="md-story-image">
            <img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr( $story_label ); ?>" style="width: 100%; aspect-ratio: 3/4; object-fit: cover;" loading="lazy">
        </div>
        <div style="grid-column: span 1; order: 1; display: flex; flex-direction: column; justify-content: center; padding-bottom: 48px;">
            <span class="text-label-caps text-muted" style="margin-bottom: 24px; display: block;"><?php echo esc_html( $story_label ); ?></span>
            <h3 class="text-headline-lg text-onyx" style="margin-bottom: 32px;"><?php echo esc_html( $story_heading ); ?></h3>
            <p class="text-body-lg text-surface-variant" style="margin-bottom: 24px;"><?php echo esc_html( $story_para1 ); ?></p>
            <p class="text-body-lg text-surface-variant"><?php echo esc_html( $story_para2 ); ?></p>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="bg-surface-lowest">
    <!-- Mission -->
    <div class="mission-vision-grid">
        <div style="position: relative; width: 100%; height: 40vh; overflow: hidden;">
            <img src="<?php echo esc_url( $mission_image ); ?>" alt="<?php esc_attr_e( 'Mission', 'rarefolk' ); ?>" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;" loading="lazy">
        </div>
        <div style="display: flex; flex-direction: column; justify-content: center; padding: 80px var(--margin-mobile); background: var(--color-off-white);">
            <span class="text-label-caps text-muted" style="margin-bottom: 32px; display: block;"><?php esc_html_e( 'Mission', 'rarefolk' ); ?></span>
            <p class="text-headline-xl text-onyx" style="font-size: 32px; line-height: 1.2; max-width: 576px;">
                <?php echo esc_html( $mission_text ); ?>
            </p>
        </div>
    </div>

    <!-- Vision -->
    <div class="mission-vision-grid">
        <div style="display: flex; flex-direction: column; justify-content: center; padding: 80px var(--margin-mobile); background: var(--color-surface-container-highest); order: 2;">
            <span class="text-label-caps text-muted" style="margin-bottom: 32px; display: block;"><?php esc_html_e( 'Vision', 'rarefolk' ); ?></span>
            <p class="text-headline-xl text-onyx" style="font-size: 32px; line-height: 1.2; max-width: 576px;">
                <?php echo esc_html( $vision_text ); ?>
            </p>
        </div>
        <div style="position: relative; width: 100%; height: 40vh; overflow: hidden; order: 1;">
            <img src="<?php echo esc_url( $vision_image ); ?>" alt="<?php esc_attr_e( 'Vision', 'rarefolk' ); ?>" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;" loading="lazy">
        </div>
    </div>
</section>

<!-- Brand Values -->
<section class="section-padding container-padding bg-off-white">
    <div style="max-width: 1440px; margin: 0 auto;">
        <h2 class="text-label-caps text-muted" style="text-align: center; margin-bottom: 64px;"><?php esc_html_e( 'Core Values', 'rarefolk' ); ?></h2>
        <div class="values-grid">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $v_heading = get_theme_mod( "rarefolk_value_{$i}_heading", '' );
                $v_text    = get_theme_mod( "rarefolk_value_{$i}_text", '' );
            ?>
                <div class="value-item">
                    <h3 class="text-headline-lg text-onyx" style="margin-bottom: 24px;"><?php echo esc_html( $v_heading ); ?></h3>
                    <p class="text-body-md text-surface-variant"><?php echo esc_html( $v_text ); ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Founder Story -->
<section class="section-padding container-padding bg-surface-lowest">
    <div class="founder-grid">
        <div style="grid-column: span 1; margin-bottom: 48px;" class="founder-image">
            <img src="<?php echo esc_url( $founder_image ); ?>" alt="<?php echo esc_attr( $founder_name ); ?>" loading="lazy">
        </div>
        <div style="grid-column: span 1;">
            <span class="text-label-caps text-muted" style="margin-bottom: 32px; display: block;"><?php echo esc_html( $founder_label ); ?></span>
            <blockquote class="text-headline-xl text-onyx" style="font-style: italic; margin-bottom: 32px; line-height: 1.2;">
                <?php echo esc_html( $founder_quote ); ?>
            </blockquote>
            <p class="text-cta text-surface-variant" style="margin-bottom: 8px;"><?php echo esc_html( $founder_name ); ?></p>
            <p class="text-body-md text-muted"><?php echo esc_html( $founder_title_text ); ?></p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
