<?php
/*
 * ACF fields
 */
$settings             = get_sub_field('settings');
$type                 = get_sub_field('type');
$enlarge_first_letter = get_sub_field('enlarge_first_letter');

/*
 * Retrieve the raw WYSIWYG value.
 *
 * Passing false, false prevents ACF from formatting the content
 * before WordPress's the_content filters are applied.
 */
$text = get_sub_field('text', false, false);

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
 * Section settings
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
 * Validate the selected text type.
 */
$allowed_types = [
    'plain',
    'quote',
];

if (!in_array($type, $allowed_types, true)) {
    $type = 'plain';
}

/*
 * Enlarge First Letter only applies to plain content.
 */
$use_drop_cap = (
    $type === 'plain' &&
    $enlarge_first_letter === 'yes'
);

/*
 * Build the section classes.
 */
$class_values = [
    'c-text-content',
    'section-padding',
    'c-text-content--' . $type,
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
     * Support classes separated by commas or spaces.
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

        $section_classes[] = sanitize_html_class($class_item);
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
 * Do not output an empty section.
 */
$has_text = trim(
    wp_strip_all_tags((string) $text)
) !== '';
?>

<?php if ($has_text) : ?>

    <section
        data-aos="fade-up"
        <?php if (!empty($custom_id)) : ?>
            id="<?php echo esc_attr($custom_id); ?>"
        <?php endif; ?>
        class="<?php echo esc_attr($section_class_output); ?>"
    >
        <div class="article-text">

            <?php if ($type === 'plain') : ?>

                <?php
                $content_classes = [
                    'article-text__content',
                    'article-text__content--plain',
                ];

                if ($use_drop_cap) {
                    $content_classes[] = 'article-text__content--drop-cap';
                }
                ?>

                <div class="<?php echo esc_attr(implode(' ', $content_classes)); ?>">

                    <?php
                    /*
                     * Process the ACF content like WordPress the_content().
                     *
                     * This applies:
                     * - Paragraph formatting
                     * - Shortcodes
                     * - Embeds
                     * - WordPress content filters
                     */
                    echo apply_filters(
                        'the_content',
                        $text
                    );
                    ?>

                </div>

            <?php elseif ($type === 'quote') : ?>

                <div class="article-text__content article-text__content--quote">

                    <svg
                        class="article-text__quote-icon"
                        width="26"
                        height="28"
                        viewBox="0 0 26 28"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                    >
                        <path
                            d="M8.44 0.599997C2.68 3.59999 0.88 7.8 0.88 15.72V27.6H8.8V15.12H4.72V14.88C4.72 9.6 5.44 6.6 10.24 3.59999L8.44 0.599997ZM23.68 0.599997C17.92 3.59999 16.12 7.8 16.12 15.72V27.6H24.04V15.12H19.96V14.88C19.96 9.6 20.68 6.6 25.48 3.59999L23.68 0.599997Z"
                            fill="#81001F"
                        />
                    </svg>

                    <div class="article-text__quote-content">

                        <?php
                        /*
                         * Quote content also receives the normal content
                         * formatting, but its presentation is controlled
                         * by the quote-specific classes.
                         */
                        echo apply_filters(
                            'the_content',
                            $text
                        );
                        ?>

                    </div>

                </div>

            <?php endif; ?>

        </div>
    </section>

<?php endif; ?>
