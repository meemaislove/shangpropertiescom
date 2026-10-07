<?php
$heading_tag   = get_sub_field('heading_tag') ?: 'h3';
$heading_title = get_sub_field('heading_title');
$item_content  = get_sub_field('item_content');

$allowed_heading_tags = ['h2', 'h3', 'h4', 'h5', 'h6'];

if (!in_array($heading_tag, $allowed_heading_tags, true)) {
    $heading_tag = 'h3';
}
?>

<div class="accordion-item custom">
    <div class="item-title">
        <?php if ($heading_title) : ?>
            <<?php echo esc_html($heading_tag); ?>>
                <?php echo esc_html($heading_title); ?>
            </<?php echo esc_html($heading_tag); ?>>
        <?php endif; ?>

        <svg class="plus" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="9" width="2" height="20" rx="1" fill="#81001F"/>
            <rect y="8" width="20" height="2" rx="1" fill="#81001F"/>
        </svg>

        <svg class="minus" width="20" height="2" viewBox="0 0 20 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="20" height="2" rx="1" fill="#81001F"/>
        </svg>
    </div>

    <?php if ($item_content) : ?>
        <div class="item-content">
            <?php echo wp_kses_post($item_content); ?>
        </div>
    <?php endif; ?>
</div>