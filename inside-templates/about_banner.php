<?php

/**

 * Layout: About Banner

 * File: inside-templates/about_banner.php

 */



$custom_id             = get_sub_field('custom_id');

$custom_classes        = get_sub_field('custom_classes');

$image_source          = get_sub_field('image_source');

$image_source_mobile   = get_sub_field('image_source_mobile');

$heading_tag           = get_sub_field('heading_tag');

$heading_title         = get_sub_field('heading_title');

$heading_description   = get_sub_field('heading_description');



/**

 * Convert comma-separated custom classes into valid sibling classes.

 * Example ACF input:

 * "dark-banner, has-overlay, spacing-large"

 *

 * Output:

 * "dark-banner has-overlay spacing-large"

 */

$custom_classes_array = [];



if (! empty($custom_classes)) {

    $custom_classes_array = array_map('trim', explode(',', $custom_classes));

    $custom_classes_array = array_filter($custom_classes_array);

    $custom_classes_array = array_map('sanitize_html_class', $custom_classes_array);
}



$custom_classes_output = implode(' ', $custom_classes_array);



/**

 * Heading tag fallback + safety.

 */

if (empty($heading_tag)) {

    $heading_tag = 'h1';
}



$allowed_heading_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];



if (! in_array($heading_tag, $allowed_heading_tags, true)) {

    $heading_tag = 'h1';
}



/**

 * Inline background image style.

 */

$background_style = '';



if (! empty($image_source)) {

    $background_style = 'background-image: url(' . esc_url($image_source) . ');';
}

?>



<section

    data-aos="fade-down" data-aos-duration="1500"

    <?php if (! empty($custom_id)) : ?>

    id="<?php echo esc_attr($custom_id); ?>"

    <?php endif; ?>

    class="about-banner <?php echo esc_attr($custom_classes_output); ?>"

    <?php if (! empty($background_style)) : ?>

    style="<?php echo esc_attr($background_style); ?>"

    <?php endif; ?>>

    <!-- Rima -->

    <?php if (! empty($image_source_mobile) && ! empty($custom_id)) : ?>
        <style>
            @media (max-width: 767px) {
                #<?php echo esc_attr($custom_id); ?> {
                    background-image: url(<?php echo esc_url($image_source_mobile); ?>) !important;
                }
            }
        </style>
    <?php endif; ?>

    <!-- End Rima -->

    <div class="about-banner-contents">



        <?php if (have_rows('breadcrumbs')) : ?>

            <div class="banner-breadcrumbs">

                <?php

                $breadcrumb_items = [];



                while (have_rows('breadcrumbs')) : the_row();



                    $page_title = get_sub_field('page_title');

                    $page_link  = get_sub_field('page_link');



                    if (empty($page_title)) {

                        continue;
                    }



                    if (! empty($page_link)) {

                        $breadcrumb_items[] = sprintf(

                            '<a href="%s" class="breadcrumb-link" >%s</a>',

                            esc_url($page_link),

                            esc_html($page_title)

                        );
                    } else {

                        $breadcrumb_items[] = esc_html($page_title);
                    }



                endwhile;



                echo implode(' / ', $breadcrumb_items);

                ?>

            </div>

        <?php endif; ?>



        <?php if (! empty($heading_title)) : ?>

            <div class="banner-heading">

                <<?php echo esc_html($heading_tag); ?>>

                    <?php echo esc_html($heading_title); ?>

                </<?php echo esc_html($heading_tag); ?>>

                <?php if (! empty($heading_description)) : ?>

                    <?php echo wp_kses_post($heading_description); ?>

                <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>

</section>