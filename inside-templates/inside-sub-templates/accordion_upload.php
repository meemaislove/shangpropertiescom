<?php
$heading_tag   = get_sub_field('heading_tag') ?: 'h3';
$heading_title = get_sub_field('heading_title');

$allowed_heading_tags = ['h2', 'h3', 'h4', 'h5', 'h6'];

if (!in_array($heading_tag, $allowed_heading_tags, true)) {
    $heading_tag = 'h3';
}
?>

<div class="accordion-item upload">
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

    <?php if (have_rows('document_uploads')) : ?>
        <div class="item-content uploads">
            <?php while (have_rows('document_uploads')) : the_row(); ?>
                <?php
                $title = get_sub_field('title');
                $link  = get_sub_field('link');

                if (is_array($link)) {
                    $link_url = $link['url'] ?? '';
                } else {
                    $link_url = $link;
                }
                ?>

                <div class="upload-item">
                    <?php if ($title) : ?>
                        <span><?php echo esc_html($title); ?></span>
                    <?php endif; ?>

                    <?php if ($link_url) : ?>
                        <div class="download-links">
                            <a href="<?php echo esc_url($link_url); ?>" target="_blank" class="view-link">
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/05/view-icon.png')); ?>" alt="View">
                            </a>

                            <a href="<?php echo esc_url($link_url); ?>" download class="download-link">
                                <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/05/download-icon.png')); ?>" alt="Download">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>