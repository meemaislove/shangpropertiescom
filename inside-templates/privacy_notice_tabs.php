<?php
/**
 * Layout: Privacy Notice Tabs
 * File: inside-templates/privacy_notice_tabs.php
 */

$custom_id      = get_sub_field('custom_id');
$custom_classes = get_sub_field('custom_classes');
$nav_tabs       = get_sub_field('nav_tabs');

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

$section_uid = 'privacy-tabs-' . uniqid();
?>


<section
    <?php if ( ! empty($custom_id ) ) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="privacy-notice-tabs <?php echo esc_attr($custom_classes_output); ?>"
>
    <div class="privacy-notice-tabs-contents">

        <?php if ( ! empty($nav_tabs) ) : ?>

                <div class="privacy-tabs-nav">

                    <?php foreach ( $nav_tabs as $index => $tab ) : ?>

                        <button
                            type="button"
                            class="privacy-tab-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-tab="<?php echo esc_attr($section_uid . '-' . $index); ?>"
                        >
                            <h2><?php echo esc_html($tab['tab_title']); ?></h2>
                        </button>

                    <?php endforeach; ?>

                </div>

                <div class="privacy-tabs-content">

                    <?php foreach ( $nav_tabs as $index => $tab ) : ?>

                        <div
                            class="privacy-tab-panel <?php echo $index === 0 ? 'active' : ''; ?>"
                            id="<?php echo esc_attr($section_uid . '-' . $index); ?>"
                        >
                            <?php echo wp_kses_post($tab['tab_content']); ?>
                        </div>

                    <?php endforeach; ?>

                </div>

        <?php endif; ?>

    </div>
</section>
