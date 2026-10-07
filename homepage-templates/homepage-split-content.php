<?php
$heading_aos = '';
$image_aos   = '';

if ($item['instance_id'] === 'setOne') {
    $heading_aos = 'fade-left';
    $image_aos   = 'fade-right';
} elseif ($item['instance_id'] === 'setTwo') {
    $heading_aos = 'fade-right';
    $image_aos   = 'fade-left';
}

$image_url = $item['img_url'] ?? '';
$image_id  = $image_url ? attachment_url_to_postid($image_url) : 0;

$image_alt = '';

if ($image_id) {
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
}

if (empty($image_alt)) {
    $image_alt = $item['alt_text'] ?? $item['title'] ?? '';
}
?>

<section class="homepage-split-content" id="<?= esc_attr($item['instance_id']); ?>">

    <div class="homepage-split-content-contents">

        <div
            class="heading-text"
            <?php if ($heading_aos) : ?>
                data-aos="<?= esc_attr($heading_aos); ?>"
                data-aos-duration="1500"
            <?php endif; ?>
        >

            <span class="title-kicker"><?= esc_html($item['kicker_text']); ?></span>

            <h2><?= esc_html($item['title']); ?></h2>

            <div class="title-image mobile-only">
                <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>">
            </div>

            <p><?= esc_html($item['description']); ?></p>

        </div>

        <div
            class="image_content"
            <?php if ($image_aos) : ?>
                data-aos="<?= esc_attr($image_aos); ?>"
                data-aos-duration="1500"
            <?php endif; ?>
        >
            <img src="<?= esc_url($image_url); ?>" alt="<?= esc_attr($image_alt); ?>" class="web-only">
        </div>

    </div>

</section>
