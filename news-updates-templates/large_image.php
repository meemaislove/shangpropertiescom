<?php
/**
 * Layout: Large Image
 * File: news-updates-templates/large_image.php
 */

/*
 * Migrated ACF fields.
 */
$settings    = get_sub_field('settings');
$image       = get_sub_field('photo');
$placeholder = get_field('placeholder', 'option');

/*
 * Prevent undefined array warnings.
 */
$settings = is_array($settings) ? $settings : [];

$desktop = (
    !empty($settings['desktop']) &&
    is_array($settings['desktop'])
) ? $settings['desktop'] : [];

$mobile = (
    !empty($settings['mobile_tablet']) &&
    is_array($settings['mobile_tablet'])
) ? $settings['mobile_tablet'] : [];

/*
 * Section settings.
 */
$custom_id = !empty($settings['id'])
    ? $settings['id']
    : '';

$custom_classes = !empty($settings['class'])
    ? $settings['class']
    : '';

$background_class = !empty($settings['background_color'])
    ? $settings['background_color']
    : '';

/*
 * Prepare the selected image or placeholder.
 */
$display_image    = [];
$display_image_id = 0;
$is_placeholder   = false;

/*
 * Use the selected image first.
 */
if (is_array($image) && !empty($image['url'])) {
    $display_image = $image;

    if (!empty($image['ID'])) {
        $display_image_id = absint($image['ID']);
    } elseif (!empty($image['id'])) {
        $display_image_id = absint($image['id']);
    }
} elseif (is_numeric($image)) {
    $display_image_id = absint($image);
} elseif (is_string($image) && !empty($image)) {
    $display_image = [
        'url' => $image,
    ];

    /*
     * Attempt to retrieve the attachment ID from the image URL.
     */
    $display_image_id = attachment_url_to_postid($image);
}

/*
 * Use the placeholder when no image is selected.
 */
if (empty($display_image) && empty($display_image_id)) {
    $is_placeholder = true;

    if (is_array($placeholder) && !empty($placeholder['url'])) {
        $display_image = $placeholder;

        if (!empty($placeholder['ID'])) {
            $display_image_id = absint($placeholder['ID']);
        } elseif (!empty($placeholder['id'])) {
            $display_image_id = absint($placeholder['id']);
        }
    } elseif (is_numeric($placeholder)) {
        $display_image_id = absint($placeholder);
    } elseif (is_string($placeholder) && !empty($placeholder)) {
        $display_image = [
            'url' => $placeholder,
        ];

        /*
         * Attempt to retrieve the placeholder attachment ID.
         */
        $display_image_id = attachment_url_to_postid($placeholder);
    }
}

/*
 * Build the image data when ACF returns an attachment ID.
 */
if ($display_image_id && empty($display_image)) {
    $full_image = wp_get_attachment_image_src(
        $display_image_id,
        'full'
    );

    if ($full_image) {
        $display_image = [
            'ID'     => $display_image_id,
            'id'     => $display_image_id,
            'url'    => $full_image[0],
            'width'  => $full_image[1],
            'height' => $full_image[2],
        ];
    }
}

/*
 * Attempt to retrieve an attachment ID from the final URL.
 */
if (
    empty($display_image_id) &&
    !empty($display_image['url'])
) {
    $display_image_id = attachment_url_to_postid(
        $display_image['url']
    );
}

$has_image = (
    is_array($display_image) &&
    !empty($display_image['url'])
);

/*
 * Build the section classes.
 */
$class_values = [
    'curated-space-image',
    'section-padding',
    $custom_classes,
    $background_class,
    $mobile['top_padding'] ?? '',
    $mobile['bottom_padding'] ?? '',
    $desktop['top_padding'] ?? '',
    $desktop['bottom_padding'] ?? '',
];

$section_classes = [];

foreach ($class_values as $class_value) {
    if (empty($class_value)) {
        continue;
    }

    /*
     * Support custom classes separated by commas or spaces.
     */
    $class_items = preg_split(
        '/[\s,]+/',
        trim($class_value)
    );

    if (empty($class_items)) {
        continue;
    }

    foreach ($class_items as $class_item) {
        if ($class_item === '') {
            continue;
        }

        $section_classes[] = sanitize_html_class(
            $class_item
        );
    }
}

$section_classes = array_unique(
    array_filter($section_classes)
);

$section_class_output = implode(
    ' ',
    $section_classes
);

/*
 * Image information.
 */
$image_url     = '';
$mobile_url    = '';
$tablet_url    = '';
$desktop_url   = '';
$large_url     = '';
$modal_url     = '';
$image_alt     = '';
$image_caption = '';

if ($has_image) {
    $image_url = $display_image['url'];

    /*
     * Retrieve the generated image sizes using the attachment ID.
     */
    if ($display_image_id) {
        $mobile_image = wp_get_attachment_image_src(
            $display_image_id,
            'medium'
        );

        $tablet_image = wp_get_attachment_image_src(
            $display_image_id,
            'large'
        );

        $desktop_image = wp_get_attachment_image_src(
            $display_image_id,
            '1536x1536'
        );

        $large_image = wp_get_attachment_image_src(
            $display_image_id,
            '2048x2048'
        );

        $full_image = wp_get_attachment_image_src(
            $display_image_id,
            'full'
        );

        $mobile_url = $mobile_image
            ? $mobile_image[0]
            : $image_url;

        $tablet_url = $tablet_image
            ? $tablet_image[0]
            : $image_url;

        $desktop_url = $desktop_image
            ? $desktop_image[0]
            : ($full_image ? $full_image[0] : $image_url);

        $large_url = $large_image
            ? $large_image[0]
            : ($full_image ? $full_image[0] : $image_url);

        /*
         * Retrieve the latest Media Library alt text directly
         * from the attachment metadata.
         */
        $image_alt = get_post_meta(
            $display_image_id,
            '_wp_attachment_image_alt',
            true
        );

        /*
         * Use the attachment title if the alt text is empty.
         */
        if ($image_alt === '') {
            $image_alt = get_the_title(
                $display_image_id
            );
        }
    } else {
        /*
         * Fallback when the image does not have an attachment ID.
         */
        $mobile_url = !empty($display_image['sizes']['medium'])
            ? $display_image['sizes']['medium']
            : $image_url;

        $tablet_url = !empty($display_image['sizes']['large'])
            ? $display_image['sizes']['large']
            : $image_url;

        $desktop_url = !empty($display_image['sizes']['1536x1536'])
            ? $display_image['sizes']['1536x1536']
            : $image_url;

        $large_url = !empty($display_image['sizes']['2048x2048'])
            ? $display_image['sizes']['2048x2048']
            : $image_url;

        $image_alt = !empty($display_image['alt'])
            ? $display_image['alt']
            : '';
    }

    /*
     * Use the largest available image in the modal.
     */
    $modal_url = $large_url;

    /*
     * Only display the selected image's caption.
     * Do not display the placeholder caption.
     */
    if (!$is_placeholder && $display_image_id) {
        $image_caption = wp_get_attachment_caption(
            $display_image_id
        );
    } elseif (
        !$is_placeholder &&
        is_array($image) &&
        !empty($image['caption'])
    ) {
        $image_caption = $image['caption'];
    }
}
?>

<?php if ($has_image) : ?>

    <section
        data-aos="fade-up"
        data-aos-duration="1500"
        <?php if (!empty($custom_id)) : ?>
            id="<?php echo esc_attr($custom_id); ?>"
        <?php endif; ?>
        class="<?php echo esc_attr($section_class_output); ?>"
    >
        <div class="curated-space-image-contents">

            <div
                class="image-content"
                data-full="<?php echo esc_url($modal_url); ?>"
                data-alt="<?php echo esc_attr($image_alt); ?>"
            >
                <div class="image-overlay">

                    <img
                        src="https://shangproperties.com/wp-content/uploads/2026/06/magnify-vector.png"
                        alt=""
                        class="magnify-icon"
                        aria-hidden="true"
                    >

                </div>

                <div class="image-block">

                    <picture>

                        <source
                            media="(max-width: 767px)"
                            srcset="<?php echo esc_url($mobile_url); ?>"
                        >

                        <source
                            media="(min-width: 768px) and (max-width: 1280px)"
                            srcset="<?php echo esc_url($tablet_url); ?>"
                        >

                        <source
                            media="(min-width: 1281px) and (max-width: 1440px)"
                            srcset="<?php echo esc_url($desktop_url); ?>"
                        >

                        <source
                            media="(min-width: 1441px)"
                            srcset="<?php echo esc_url($large_url); ?>"
                        >

                        <img
                            src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr($image_alt); ?>"
                        >

                    </picture>

                </div>
            </div>

            <?php if (!empty($image_caption)) : ?>

                <div class="curated-space-image__caption">
                    <?php echo wp_kses_post($image_caption); ?>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <div class="modal curated-space-image-modal">

        <div class="modal-content">

            <span
                class="close-btn"
                role="button"
                tabindex="0"
                aria-label="Close image"
            >

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
                class="photo-within"
                src=""
                alt=""
            >

        </div>

    </div>

<?php endif; ?>
