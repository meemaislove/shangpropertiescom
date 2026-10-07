<?php

/**
 * Layout: About Split Content
 * File: inside-templates/about_split_content.php
 */

$custom_id           = get_sub_field('custom_id');
$custom_classes      = get_sub_field('custom_classes');
$kicker_text         = get_sub_field('kicker_text');
$heading_tag         = get_sub_field('heading_tag');
$heading_title       = get_sub_field('heading_title');
$heading_description = get_sub_field('heading_description');
$right_content       = get_sub_field('right_content');
$split_carousel      = get_sub_field('split_carousel');

if ( ! empty($right_content) && function_exists('shang_remove_p_tags') ) {
    $right_content = shang_remove_p_tags($right_content);
}

$custom_classes_array = [];

if ( ! empty($custom_classes) ) {
    $custom_classes_array = array_map('trim', explode(',', $custom_classes));
    $custom_classes_array = array_filter($custom_classes_array);
    $custom_classes_array = array_map('sanitize_html_class', $custom_classes_array);
}

$custom_classes_output = implode(' ', $custom_classes_array);

/**
 * Split fade animation logic.
 *
 * Add either class in ACF custom_classes:
 *
 * split-fade-normal
 * heading-content = fade-right
 * custom-content  = fade-left
 *
 * split-fade-reverse
 * heading-content = fade-left
 * custom-content  = fade-right
 */
$heading_aos = '';
$custom_aos  = '';

if ( in_array('split-fade-normal', $custom_classes_array, true) ) {
    $heading_aos = 'fade-right';
    $custom_aos  = 'fade-left';
}

if ( in_array('split-fade-reverse', $custom_classes_array, true) ) {
    $heading_aos = 'fade-left';
    $custom_aos  = 'fade-right';
}

$heading_aos_attrs = '';
$custom_aos_attrs  = '';

if ( ! empty($heading_aos) ) {
    $heading_aos_attrs = ' data-aos="' . esc_attr($heading_aos) . '" data-aos-duration="1500"';
}

if ( ! empty($custom_aos) ) {
    $custom_aos_attrs = ' data-aos="' . esc_attr($custom_aos) . '" data-aos-duration="1500"';
}

$allowed_heading_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

if ( empty($heading_tag) || ! in_array($heading_tag, $allowed_heading_tags, true) ) {
    $heading_tag = 'h2';
}

?>

<section
    <?php if ( ! empty($custom_id) ) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="about-split-content <?php echo esc_attr($custom_classes_output); ?>"
>
    <div data-aos="fade-up" data-aos-duration="1500" class="about-split-content-contents">

        <div<?php echo $heading_aos_attrs; ?> class="heading-content">

            <?php if ( ! empty($kicker_text) ) : ?>
                <span class="title-kicker"><?php echo esc_html($kicker_text); ?></span>
            <?php endif; ?>

            <?php if ( ! empty($heading_title) ) : ?>
                <<?php echo tag_escape($heading_tag); ?>>
                    <?php echo esc_html($heading_title); ?>
                </<?php echo tag_escape($heading_tag); ?>>
            <?php endif; ?>

            <?php if ( ! empty($heading_description) ) : ?>
                <p><?php echo wp_kses_post($heading_description); ?></p>
            <?php endif; ?>

        </div>

        <?php if ( ! empty($right_content) ) : ?>
            <div<?php echo $custom_aos_attrs; ?> class="custom-content">
                <?php echo wp_kses_post($right_content); ?>
            </div>
        <?php endif; ?>

    </div>

    <?php if ( ! empty($split_carousel) && is_array($split_carousel) ) : ?>
        <div data-aos="fade-up" data-aos-duration="1500" class="about-split-content-carousel js-about-split-content-carousel">

            <div class="about-split-photo-carousel">

                <?php foreach ( $split_carousel as $image ) : ?>

                    <?php
                    $thumb_url = '';
                    $full_url  = '';
                    $alt_text  = '';

                    if ( is_array($image) ) {
                        $thumb_url = $image['sizes']['full'] ?? $image['url'] ?? '';
                        $full_url  = $image['url'] ?? $thumb_url;
                        $alt_text  = $image['alt'] ?? '';
                    } elseif ( is_numeric($image) ) {
                        $thumb_url = wp_get_attachment_image_url($image, 'full');
                        $full_url  = wp_get_attachment_image_url($image, 'full');
                        $alt_text  = get_post_meta($image, '_wp_attachment_image_alt', true);
                    } elseif ( is_string($image) ) {
                        $thumb_url = $image;
                        $full_url  = $image;
                    }
                    ?>

                    <?php if ( ! empty($thumb_url) ) : ?>
                        <div class="about-split-photo-carousel-cell">
                            <img
                                class="about-split-photo-carousel-image"
                                src="<?php echo esc_url($thumb_url); ?>"
                                alt="<?php echo esc_attr($alt_text); ?>"
                                data-full="<?php echo esc_url($full_url); ?>"
                            >
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

            <div class="about-split-photo-carousel-navigation">
                <div class="about-split-photo-carousel-navigation-contents">

                    <div class="about-split-photo-carousel-buttons">

                        <button type="button" class="about-split-photo-carousel-button about-split-photo-carousel-prev" aria-label="Previous slide">
                            <svg width="41" height="11" viewBox="0 0 41 11">
                                <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/>
                            </svg>
                        </button>

                        <span class="about-split-photo-carousel-status"></span>

                        <button type="button" class="about-split-photo-carousel-button about-split-photo-carousel-next" aria-label="Next slide">
                            <svg width="41" height="11" viewBox="0 0 41 11">
                                <g transform="translate(41, 11) rotate(180)">
                                    <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"/>
                                </g>
                            </svg>
                        </button>

                    </div>

                </div>
            </div>

        </div>
    <?php endif; ?>

</section>
