<?php
/**
 * Layout: Curated Space Image
 * File: inside-templates/curated_space_image.php
 */

$custom_id      = get_sub_field('custom_id');
$custom_classes = get_sub_field('custom_classes');
$image          = get_sub_field('image_url');

/*
 * Prepare custom section classes.
 * Supports classes separated by commas or spaces.
 */
$custom_classes_array = [];

if (!empty($custom_classes)) {
    $custom_classes_array = preg_split(
        '/[\s,]+/',
        trim($custom_classes)
    );

    $custom_classes_array = array_filter(
        $custom_classes_array
    );

    $custom_classes_array = array_map(
        'sanitize_html_class',
        $custom_classes_array
    );
}

$custom_classes_output = implode(
    ' ',
    array_unique($custom_classes_array)
);

/*
 * Prepare image information.
 *
 * Supports an ACF image field returning:
 * - Image array
 * - Attachment ID
 * - Image URL
 */
$image_id  = 0;
$image_url = '';
$image_alt = '';

if (is_array($image)) {
    /*
     * ACF image array.
     */
    if (!empty($image['ID'])) {
        $image_id = absint($image['ID']);
    } elseif (!empty($image['id'])) {
        $image_id = absint($image['id']);
    }

    if (!empty($image['url'])) {
        $image_url = $image['url'];
    }

    /*
     * Temporary fallback in case no attachment ID is found.
     */
    if (!empty($image['alt'])) {
        $image_alt = $image['alt'];
    }
} elseif (is_numeric($image)) {
    /*
     * ACF attachment ID.
     */
    $image_id = absint($image);
} elseif (is_string($image) && !empty($image)) {
    /*
     * ACF URL field or image field returning a URL.
     */
    $image_url = $image;
}

/*
 * Retrieve the attachment ID from the URL when needed.
 */
if (!$image_id && !empty($image_url)) {
    $image_id = attachment_url_to_postid($image_url);
}

/*
 * Retrieve the full image URL from the attachment ID.
 */
if ($image_id && empty($image_url)) {
    $full_image = wp_get_attachment_image_src(
        $image_id,
        'full'
    );

    if ($full_image) {
        $image_url = $full_image[0];
    }
}

/*
 * Retrieve the current Media Library alt text directly.
 */
if ($image_id) {
    $media_alt = get_post_meta(
        $image_id,
        '_wp_attachment_image_alt',
        true
    );

    if ($media_alt !== '') {
        $image_alt = $media_alt;
    }
}

$has_image = !empty($image_url);
?>

<?php if ($has_image) : ?>

    <section
        data-aos="fade-up"
        data-aos-duration="1500"
        <?php if (!empty($custom_id)) : ?>
            id="<?php echo esc_attr($custom_id); ?>"
        <?php endif; ?>
        class="curated-space-image<?php echo !empty($custom_classes_output) ? ' ' . esc_attr($custom_classes_output) : ''; ?>"
    >
        <div class="curated-space-image-contents">

            <div
                class="image-content"
                data-full="<?php echo esc_url($image_url); ?>"
                data-alt="<?php echo esc_attr($image_alt); ?>"
            >

                <div class="image-overlay">

                    <img
                        src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/magnify-vector.png"
                        alt=""
                        class="magnify-icon"
                        aria-hidden="true"
                    >

                </div>

                <div class="image-block">

                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                    >

                </div>

            </div>

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
