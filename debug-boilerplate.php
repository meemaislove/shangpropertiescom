<?php
/**
 * Layout: DEBUG BOILERPLATE
 * File: inside-templates/about_banner.php
 */

// Basic fields
$custom_id      = get_sub_field('custom_id');
$custom_classes = get_sub_field('custom_classes');
$image_source   = get_sub_field('image_source');
$heading_tag    = get_sub_field('heading_tag');
$heading_title  = get_sub_field('heading_title');

// Fallback heading tag
if ( empty($heading_tag) ) {
    $heading_tag = 'h1';
}

// Safety: only allow valid heading tags
$allowed_heading_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

if ( ! in_array($heading_tag, $allowed_heading_tags, true) ) {
    $heading_tag = 'h1';
}
?>

<?php

$custom_classes_array = [];

if ( ! empty($custom_classes) ) {
    $custom_classes_array = array_map('trim', explode(',', $custom_classes));
    $custom_classes_array = array_filter($custom_classes_array);
    $custom_classes_array = array_map('sanitize_html_class', $custom_classes_array);
}

$custom_classes_output = implode(' ', $custom_classes_array);
?>


<section
    <?php if ( ! empty($custom_id) ) : ?>
        id="<?php echo esc_attr($custom_id); ?>"
    <?php endif; ?>
    class="about-banner <?php echo esc_attr($custom_classes_output); ?>"
>

    <div class="about-banner__debug" style="padding: 24px; border: 2px dashed #999; background: #f7f7f7;">

        <p><strong>Layout file loaded:</strong> about_banner.php</p>

        <p><strong>Custom ID:</strong> <?php echo esc_html($custom_id); ?></p>

        <p><strong>Custom Classes:</strong> <?php echo esc_html($custom_classes); ?></p>

        <p><strong>Image Source:</strong> <?php echo esc_html($image_source); ?></p>

        <p><strong>Heading Tag:</strong> <?php echo esc_html($heading_tag); ?></p>

        <p><strong>Heading Title:</strong> <?php echo esc_html($heading_title); ?></p>

        <?php if ( ! empty($heading_title) ) : ?>
            <<?php echo esc_html($heading_tag); ?>>
                <?php echo esc_html($heading_title); ?>
            </<?php echo esc_html($heading_tag); ?>>
        <?php endif; ?>

        <?php if ( have_rows('breadcrumbs') ) : ?>
            <div class="about-banner__breadcrumbs">
                <strong>Breadcrumbs:</strong>

                <ul>
                    <?php while ( have_rows('breadcrumbs') ) : the_row(); ?>
                        <?php
                        $page_title = get_sub_field('page_title');
                        $page_link  = get_sub_field('page_link');
                        ?>

                        <li>
                            <?php if ( ! empty($page_link) ) : ?>
                                <a href="<?php echo esc_url($page_link); ?>">
                                    <?php echo esc_html($page_title); ?>
                                </a>
                            <?php else : ?>
                                <?php echo esc_html($page_title); ?>
                            <?php endif; ?>
                        </li>

                    <?php endwhile; ?>
                </ul>
            </div>
        <?php else : ?>
            <p><strong>Breadcrumbs:</strong> No breadcrumb rows found.</p>
        <?php endif; ?>

    </div>

</section>