<?php

// ACF fields

$carousel_images   = get_sub_field('carousel_images'); // gallery images

$custom_id         = get_sub_field('custom_id');       // optional ID

$custom_classes    = get_sub_field('custom_classes');  // optional additional classes

$heading_tag       = get_sub_field('heading_tag');     // h1-h6

$heading_text      = get_sub_field('heading_text');    // main heading

$subheading_text   = get_sub_field('subheading_text'); // optional kicker/subtitle



// Process custom classes

$classes_array = [];

if (!empty($custom_classes)) {

    $classes_array = array_map('trim', explode(',', $custom_classes));

    $classes_array = array_filter($classes_array);

    $classes_array = array_map('sanitize_html_class', $classes_array);

}

$classes_output = implode(' ', $classes_array);



// Validate heading tag

$allowed_heading_tags = ['h1','h2','h3','h4','h5','h6'];

if (empty($heading_tag) || !in_array($heading_tag, $allowed_heading_tags, true)) {

    $heading_tag = 'h2';

}

?>



<section

    data-aos="fade-up" data-aos-duration="1500"

    <?php if (!empty($custom_id)) : ?> id="<?php echo esc_attr($custom_id); ?>" <?php endif; ?>

    class="homepage-carousel <?php echo esc_attr($classes_output); ?>"

>

    <div class="homepage-carousel-contents">



        <div class="heading-text">

            <?php if (!empty($subheading_text)) : ?>

                <span class="title-kicker"><?php echo esc_html($subheading_text); ?></span>

            <?php endif; ?>

            <?php if (!empty($heading_text)) : ?>

                <<?php echo esc_html($heading_tag); ?>>

                    <?php echo esc_html($heading_text); ?>

                </<?php echo esc_html($heading_tag); ?>>

            <?php endif; ?>

        </div>



        <div class="video-carousel">

            <?php if ($carousel_images) : ?>

                <?php foreach ($carousel_images as $image) :

                    $thumb_url = isset($image['sizes']['full']) ? esc_url($image['sizes']['full']) : esc_url($image['url']);                    $full_url  = esc_url($image['url']);

                    $alt_text  = !empty($image['alt']) ? esc_attr($image['alt']) : '';

                ?>

                    <div class="carousel-cell">

                        <img class="carousel-thumbnail" src="<?php echo $thumb_url; ?>" alt="<?php echo $alt_text; ?>" data-full="<?php echo $full_url; ?>" />

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>



    </div>

</section>



<section class="carousel-navigation enterprise-counter">

    <div class="carousel-navigation-contents">

        <span class="carousel-status"></span>

        <div class="carousel-buttons"></div>

    </div>

</section>



<!-- Photo Modal -->

<div id="photo-modal" class="modal enterprise-modal">

    <div class="modal-content">

        <span class="close-btn">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">

                <path fill="#fff" d="M21 4.41L19.59 3 12 10.59 4.41 3 3 4.41 10.59 12 3 19.59 4.41 21 12 13.41 19.59 21 21 19.59 13.41 12 21 4.41z"/>

            </svg>

        </span>

        <img id="photo-container" class="photo-container" src="" alt="" />

    </div>

</div>
