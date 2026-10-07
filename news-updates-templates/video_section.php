<?php
/**
 * Layout: Video Section
 * File: news-updates-templates/video_section.php
 */

/*
 * Migrated ACF fields.
 */
$settings          = get_sub_field('settings');
$image             = get_sub_field('placeholder_image');
$youtube_video     = get_sub_field('youtube_video', false, false);
$video_description = get_sub_field('video_description');
$placeholder       = get_field('placeholder', 'option');

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
 * Use the global placeholder when no thumbnail is selected.
 */
$display_image = (
    is_array($image) &&
    !empty($image['url'])
) ? $image : $placeholder;

$has_image = (
    is_array($display_image) &&
    !empty($display_image['url'])
);

/*
 * Extract the video URL.
 *
 * The migrated YouTube field may contain:
 * 1. A complete iframe
 * 2. A direct YouTube URL
 * 3. An embed URL
 */
$video_url = '';

if (!empty($youtube_video)) {
    $youtube_video = trim($youtube_video);

    /*
     * Extract src from an iframe.
     */
    if (
        preg_match(
            '/<iframe[^>]+src=["\']([^"\']+)["\']/i',
            $youtube_video,
            $iframe_match
        )
    ) {
        $video_url = html_entity_decode($iframe_match[1]);
    } elseif (filter_var($youtube_video, FILTER_VALIDATE_URL)) {
        $video_url = $youtube_video;
    }
}

/*
 * Convert standard YouTube watch and short links into embed URLs.
 */
if (!empty($video_url)) {
    $parsed_video_url = wp_parse_url($video_url);

    if (!empty($parsed_video_url['host'])) {
        $video_host = strtolower($parsed_video_url['host']);

        /*
         * Standard YouTube URL:
         * youtube.com/watch?v=VIDEO_ID
         */
        if (
            strpos($video_host, 'youtube.com') !== false &&
            !empty($parsed_video_url['query'])
        ) {
            parse_str(
                $parsed_video_url['query'],
                $video_query
            );

            if (!empty($video_query['v'])) {
                $video_url =
                    'https://www.youtube.com/embed/' .
                    rawurlencode($video_query['v']);
            }
        }

        /*
         * Short YouTube URL:
         * youtu.be/VIDEO_ID
         */
        if (
            strpos($video_host, 'youtu.be') !== false &&
            !empty($parsed_video_url['path'])
        ) {
            $video_id = trim(
                $parsed_video_url['path'],
                '/'
            );

            if (!empty($video_id)) {
                $video_url =
                    'https://www.youtube.com/embed/' .
                    rawurlencode($video_id);
            }
        }
    }
}

/*
 * Build section classes.
 */
$class_values = [
    'curated-space-image',
    'curated-space-video',
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
 * Thumbnail image information.
 */
$image_url   = '';
$mobile_url  = '';
$desktop_url = '';
$image_alt   = '';

if ($has_image) {
    $image_url = $display_image['url'];

    $mobile_url = !empty($display_image['sizes']['medium'])
        ? $display_image['sizes']['medium']
        : $image_url;

    $desktop_url = !empty($display_image['sizes']['large'])
        ? $display_image['sizes']['large']
        : $image_url;

    $image_alt = !empty($display_image['alt'])
        ? $display_image['alt']
        : '';
}

/*
 * Unique identifier in case the article has multiple video sections.
 */
$video_instance_id = wp_unique_id(
    'curated-video-'
);
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
        <div class="curated-space-image-contents curated-space-video-contents">

            <?php if (!empty($video_url)) : ?>

                <div
                    class="image-content video-content"
                    data-video="<?php echo esc_url($video_url); ?>"
                    data-video-instance="<?php echo esc_attr($video_instance_id); ?>"
                    role="button"
                    tabindex="0"
                    aria-label="Play video"
                >

                <div class="image-overlay video-overlay">

                    <svg
                        width="80"
                        height="81"
                        viewBox="0 0 80 81"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                    >
                        <path
                            d="M0 40C0 17.9086 17.9086 0 40 0C62.0914 0 80 17.9086 80 40V41C80 63.0914 62.0914 81 40 81C17.9086 81 0 63.0914 0 41V40Z"
                            fill="#202020"
                            fill-opacity="0.2"
                        />

                        <path
                            d="M55.1212 38.4509C56.4559 39.2204 56.4559 41.1466 55.1212 41.9161L34.4059 53.8602C33.0726 54.629 31.4069 53.6667 31.4069 52.1276L31.4069 28.2394C31.4069 26.7003 33.0726 25.738 34.4059 26.5068L55.1212 38.4509Z"
                            fill="white"
                        />

                        <path
                            d="M79 40V41H81V40H79ZM1 41V40H-1V41H1ZM40 80C18.4609 80 1 62.5391 1 41H-1C-1 63.6437 17.3563 82 40 82V80ZM79 41C79 62.5391 61.5391 80 40 80V82C62.6437 82 81 63.6437 81 41H79ZM40 1C61.5391 1 79 18.4609 79 40H81C81 17.3563 62.6437 -1 40 -1V1ZM40 -1C17.3563 -1 -1 17.3563 -1 40H1C1 18.4609 18.4609 1 40 1V-1Z"
                            fill="white"
                        />
                    </svg>

                </div>

                    <div class="image-block video-thumbnail">

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
                                src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt); ?>"
                            >

                        </picture>

                    </div>

                </div>

            <?php else : ?>

                <div class="image-content video-content video-content--no-video">

                    <div class="image-block video-thumbnail">

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
                                src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt); ?>"
                            >

                        </picture>

                    </div>

                </div>

            <?php endif; ?>

            <?php if (!empty($video_description)) : ?>

                <div class="curated-space-video__description">
                    <?php echo wp_kses_post($video_description); ?>
                </div>

            <?php endif; ?>

        </div>
    </section>

<?php endif; ?>


<?php if ($has_image && !empty($video_url)) : ?>

    <div
        class="modal curated-space-image-modal curated-space-video-modal"
        data-video-modal="<?php echo esc_attr($video_instance_id); ?>"
    >
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
                    title="<?php echo esc_attr(get_the_title()); ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                    allowfullscreen
                ></iframe>

            </div>

        </div>
    </div>

<?php endif; ?>
