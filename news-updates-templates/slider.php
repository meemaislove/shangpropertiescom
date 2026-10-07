<?php
/*
 * Migrated ACF fields.
 */
$settings = get_sub_field('settings');
$images   = get_sub_field('gallery');

/*
 * Prevent undefined array warnings.
 */
$settings = is_array($settings) ? $settings : [];
$images   = is_array($images) ? $images : [];

$desktop = !empty($settings['desktop']) && is_array($settings['desktop'])
    ? $settings['desktop']
    : [];

$mobile = !empty($settings['mobile_tablet']) && is_array($settings['mobile_tablet'])
    ? $settings['mobile_tablet']
    : [];

/*
 * Section settings.
 */
$custom_id      = !empty($settings['id']) ? $settings['id'] : '';
$custom_classes = !empty($settings['class']) ? $settings['class'] : '';
$background     = !empty($settings['background_color'])
    ? $settings['background_color']
    : '';

/*
 * Responsive padding classes.
 */
$padding_classes = array_filter([
    $mobile['top_padding'] ?? '',
    $mobile['bottom_padding'] ?? '',
    $desktop['top_padding'] ?? '',
    $desktop['bottom_padding'] ?? '',
]);

$section_classes = array_filter([
    'homepage-carousel',
    $custom_classes,
    implode(' ', $padding_classes),
    $background,
]);

$section_class_output = implode(' ', $section_classes);
$image_count          = count($images);
?>


<div  class="photo-carousel-component">

<section
    data-aos="fade-up"
    data-aos-duration="1500"
    <?php if (!empty($custom_id)) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="<?php echo esc_attr($section_class_output); ?>"
>
    <div class="homepage-carousel-contents">

        <?php if (!empty($images)) : ?>

            <div class="video-carousel js-reusable-photo-carousel-track <?php echo $image_count === 1 ? 'carousel--single' : ''; ?>">

                <?php foreach ($images as $image) : ?>

                    <?php
                    if (!is_array($image) || empty($image['url'])) {
                        continue;
                    }

                    $default_url = $image['url'];

                    $mobile_url = !empty($image['sizes']['medium'])
                        ? $image['sizes']['medium']
                        : $default_url;

                    $desktop_url = !empty($image['sizes']['large'])
                        ? $image['sizes']['large']
                        : $default_url;

                    $full_url = !empty($image['sizes']['2048x2048'])
                        ? $image['sizes']['2048x2048']
                        : $default_url;

                    $alt_text = !empty($image['alt'])
                        ? $image['alt']
                        : '';

                    $caption = !empty($image['caption'])
                        ? $image['caption']
                        : '';
                    ?>

                    <div class="carousel-cell">

                        <picture>
                            <source
                                media="(max-width: 767px)"
                                srcset="<?php echo esc_url($mobile_url); ?>"
                            >

                            <source
                                media="(min-width: 768px)"
                                srcset="<?php echo esc_url($desktop_url); ?>"
                            >

                            <img
                                class="carousel-thumbnail"
                                src="<?php echo esc_url($default_url); ?>"
                                alt="<?php echo esc_attr($alt_text); ?>"
                                data-full="<?php echo esc_url($full_url); ?>"
                            >
                        </picture>

                        <?php if (!empty($caption)) : ?>
                            <div class="caption text-center">
                                <?php echo wp_kses_post($caption); ?>
                            </div>
                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</section>



<?php if ($image_count > 1) : ?>

    <section class="carousel-navigation enterprise-counter">
        <div class="carousel-navigation-contents">

            <span class="carousel-status"></span>

            <div class="carousel-buttons"></div>

        </div>
    </section>

<?php endif; ?>


<!-- Photo Modal -->
<div class="modal enterprise-modal">

    <div class="modal-content">

        <span class="close-btn">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
                width="30"
                height="30"
                aria-hidden="true"
            >
                <path
                    fill="#fff"
                    d="M21 4.41L19.59 3 12 10.59 4.41 3 3 4.41 10.59 12 3 19.59 4.41 21 12 13.41 19.59 21 21 19.59 13.41 12 21 4.41z"
                />
            </svg>

        </span>

        <img
            class="photo-container"
            src=""
            alt=""
        >

    </div>

</div>


</div><!-- /.photo-carousel-component -->