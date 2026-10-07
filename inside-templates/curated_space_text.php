<?php
/**
 * Layout: Curated Space Text
 * File: inside-templates/curated_space_text.php
 */

$custom_id      = get_sub_field('custom_id');
$custom_classes = get_sub_field('custom_classes');
$content        = get_sub_field('content');

/**
 * Convert comma-separated custom classes into valid sibling classes.
 */
$custom_classes_array = [];

if ( ! empty($custom_classes) ) {
    $custom_classes_array = array_map('trim', explode(',', $custom_classes));
    $custom_classes_array = array_filter($custom_classes_array);
    $custom_classes_array = array_map('sanitize_html_class', $custom_classes_array);
}

$custom_classes_output = implode(' ', $custom_classes_array);
?>

<section

    data-aos="fade-up" data-aos-duration="1500"

    <?php if ( ! empty($custom_id) ) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="curated-space-text <?php echo esc_attr($custom_classes_output); ?>"
>
    <div class="curated-space-text-contents">

        <?php if ( ! empty($content) ) : ?>
            <?php echo wp_kses_post($content); ?>
        <?php endif; ?>

    </div>
</section>
