<?php
/**
 * Layout: Curated Space Video
 * File: inside-templates/curated_space_video.php
 */

$custom_id      = get_sub_field('custom_id');
$custom_classes = get_sub_field('custom_classes');
$image          = get_sub_field('image_url');
$video_url      = get_sub_field('video_url');
$external_url   = get_sub_field('external_url');
$livetour_url   = get_sub_field('livetour_url');
$heading_tag    = get_sub_field('heading_tag');
$heading_text   = get_sub_field('heading_text');

/*
 * Validate the selected heading tag.
 */
$allowed_heading_tags = [
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
];

if (
    empty($heading_tag) ||
    !in_array($heading_tag, $allowed_heading_tags, true)
) {
    $heading_tag = 'h2';
}

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
 * Prepare the thumbnail image.
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
     * Temporary fallback if an attachment ID cannot be found.
     */
    if (!empty($image['alt'])) {
        $image_alt = $image['alt'];
    }
} elseif (is_numeric($image)) {
    /*
     * ACF image field returning an attachment ID.
     */
    $image_id = absint($image);
} elseif (is_string($image) && !empty($image)) {
    /*
     * ACF image field or URL field returning an image URL.
     */
    $image_url = $image;
}

/*
 * Retrieve the attachment ID from the image URL when needed.
 */
if (!$image_id && !empty($image_url)) {
    $image_id = attachment_url_to_postid($image_url);
}

/*
 * Retrieve the full image URL when ACF returns an attachment ID.
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
 * Retrieve the latest alt text directly from the Media Library.
 */
if ($image_id) {
    $media_alt = get_post_meta(
        $image_id,
        '_wp_attachment_image_alt',
        true
    );

    $image_alt = is_string($media_alt)
        ? $media_alt
        : '';
}

$has_thumbnail = !empty($image_url);

/*
 * Live tour watermark.
 * The tour is an external iframe with no alt text, so the label is picked
 * from the tour's own name (see shang_get_virtual_tour_watermark_class() in functions.php).
 */
$livetour_watermark_class = '';

if (!empty($livetour_url) && function_exists('shang_get_virtual_tour_watermark_class')) {
    $detected_class = shang_get_virtual_tour_watermark_class($livetour_url);

    if (!empty($detected_class)) {
        $livetour_watermark_class = 'wm-wrap live-tour-watermark ' . $detected_class;
    }
}
?>

<section
    data-aos="fade-up"
    data-aos-duration="1500"
    <?php if (!empty($custom_id)) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="curated-space-image curated-space-video<?php echo !empty($custom_classes_output) ? ' ' . esc_attr($custom_classes_output) : ''; ?>"
>
    <div class="curated-space-image-contents curated-space-video-contents">

        <?php if (!empty($heading_text)) : ?>

            <div class="heading-text">

                <<?php echo esc_html($heading_tag); ?>>
                    <?php echo esc_html($heading_text); ?>
                </<?php echo esc_html($heading_tag); ?>>

            </div>

        <?php endif; ?>

        <?php if (!empty($livetour_url)) : ?>

            <div class="image-content video-content live-tour-content">

                <div class="video-wrapper live-tour-wrapper<?php echo !empty($livetour_watermark_class) ? ' ' . esc_attr($livetour_watermark_class) : ''; ?>">

                    <iframe
                        class="video-within live-tour-iframe"
                        src="<?php echo esc_url($livetour_url); ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                        allowfullscreen
                    ></iframe>

                </div>

            </div>

        <?php elseif ($has_thumbnail) : ?>

            <?php if (!empty($external_url)) : ?>

                <a
                    class="image-content video-content"
                    href="<?php echo esc_url($external_url); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >

            <?php else : ?>

                <div
                    class="image-content video-content"
                    data-video="<?php echo esc_url($video_url); ?>"
                >

            <?php endif; ?>

                <div class="image-overlay video-overlay">

                    <svg
                        width="81"
                        height="82"
                        viewBox="0 0 81 82"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                    >
                        <path
                            d="M55.8078 38.9239C57.159 39.7029 57.159 41.6528 55.8078 42.4318L34.8368 54.5234C33.487 55.3017 31.8008 54.3275 31.8008 52.7694V28.5863C31.8008 27.0282 33.487 26.054 34.8368 26.8323L55.8078 38.9239Z"
                            fill="#81001F"
                        />

                        <path
                            d="M79.9818 40.4945V41.5068H82.0065V40.4945H79.9818ZM1.01883 41.5068V40.4945H-1.00586V41.5068H1.01883ZM40.5003 80.9883C18.6953 80.9883 1.01883 63.3118 1.01883 41.5068H-1.00586C-1.00586 64.4301 17.5771 83.013 40.5003 83.013V80.9883ZM79.9818 41.5068C79.9818 63.3118 62.3053 80.9883 40.5003 80.9883V83.013C63.4236 83.013 82.0065 64.4301 82.0065 41.5068H79.9818ZM40.5003 1.01297C62.3053 1.01297 79.9818 18.6894 79.9818 40.4945H82.0065C82.0065 17.5712 63.4236 -1.01172 40.5003 -1.01172V1.01297ZM40.5003 -1.01172C17.5771 -1.01172 -1.00586 17.5712 -1.00586 40.4945H1.01883C1.01883 18.6894 18.6953 1.01297 40.5003 1.01297V-1.01172Z"
                            fill="#81001F"
                        />
                    </svg>

                </div>

                <div class="image-block video-thumbnail">

                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                    >

                </div>

            <?php if (!empty($external_url)) : ?>

                </a>

            <?php else : ?>

                </div>

            <?php endif; ?>

        <?php endif; ?>

    </div>
</section>

<?php if (
    empty($livetour_url) &&
    empty($external_url) &&
    !empty($video_url)
) : ?>

    <div class="modal curated-space-image-modal curated-space-video-modal">

        <div class="modal-content video-modal-content">

            <span
                class="close-btn"
                role="button"
                tabindex="0"
                aria-label="Close video"
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

            <div class="video-wrapper">

                <iframe
                    class="video-within"
                    src=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>

            </div>

        </div>

    </div>

<?php endif; ?>
