<?php
/**
 * Layout: Enterprise Split Content
 * File: inside-templates/enterprise_split_content.php
 */

$custom_id           = get_sub_field('custom_id');
$custom_classes      = get_sub_field('custom_classes');
$kicker_text         = get_sub_field('kicker_text');
$heading_tag         = get_sub_field('heading_tag');
$heading_title       = get_sub_field('heading_title');
$heading_description = get_sub_field('heading_description');
$right_content       = get_sub_field('right_content');

$right_content = shang_remove_p_tags($right_content);

/**
 * Convert comma-separated custom classes into valid sibling classes.
 *
 * Example:
 * "section-dark, has-padding"
 *
 * Output:
 * "section-dark has-padding"
 */
$custom_classes_array = [];

if ( ! empty($custom_classes) ) {
    $custom_classes_array = array_map('trim', explode(',', $custom_classes));
    $custom_classes_array = array_filter($custom_classes_array);
    $custom_classes_array = array_map('sanitize_html_class', $custom_classes_array);
}

$custom_classes_output = implode(' ', $custom_classes_array);

/**
 * Heading tag fallback + safety.
 */
if ( empty($heading_tag) ) {
    $heading_tag = 'h2';
}

$allowed_heading_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

if ( ! in_array($heading_tag, $allowed_heading_tags, true) ) {
    $heading_tag = 'h2';
}
?>

<section
    <?php if ( ! empty($custom_id) ) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="about-split-content <?php echo esc_attr($custom_classes_output); ?>"
>
    <div class="about-split-content-contents">

        <div class="heading-content">

            <?php if ( ! empty($kicker_text) ) : ?>
                <span class="title-kicker"><?php echo esc_html($kicker_text); ?></span>
            <?php endif; ?>

            <?php if ( ! empty($heading_title) ) : ?>
                <<?php echo esc_html($heading_tag); ?>>
                    <?php echo esc_html($heading_title); ?>
                </<?php echo esc_html($heading_tag); ?>>
            <?php endif; ?>

            <?php if ( ! empty($heading_description) ) : ?>
                <p><?php echo wp_kses_post($heading_description); ?></p>
            <?php endif; ?>

        </div>

        <?php if ( ! empty($right_content) ) : ?>
            <div class="custom-content">
                <?php echo wp_kses_post($right_content); ?>
            </div>
        <?php endif; ?>

    </div>
</section>