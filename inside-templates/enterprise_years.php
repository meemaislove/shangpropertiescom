<?php

/**

 * Layout: Enterprise Years; Origin: Homepage Years

 */



$custom_id       = get_sub_field('custom_id');

$background_image = get_sub_field('background_image');

$custom_classes  = get_sub_field('custom_classes');

$heading_tag     = get_sub_field('heading_tag');

$heading_text    = get_sub_field('heading_text');

$custom_content  = get_sub_field('custom_content');



$custom_content = shang_remove_p_tags($custom_content);



/**

 * Custom classes.

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



/**

 * Background image inline style.

 */

$background_style = '';



if ( ! empty($background_image) ) {

    $background_style = 'background-image: url(' . esc_url($background_image) . ');';

}

?>



<section

    data-aos="fade-up" data-aos-duration="1500"

    <?php if ( ! empty($custom_id) ) : ?>

        id="<?php echo esc_attr($custom_id); ?>"

    <?php endif; ?>

    class="homepage-years <?php echo esc_attr($custom_classes_output); ?>"

>

    <div

        class="homepage-years-background"

        <?php if ( ! empty($background_style) ) : ?>

            style="<?php echo esc_attr($background_style); ?>"

        <?php endif; ?>

    ></div>



    <div class="homepage-years-contents">

        <div class="years-container">



        <?php if ( ! empty($heading_text) ) : ?>

            <<?php echo esc_html($heading_tag); ?>>

                <?php echo esc_html($heading_text); ?>

            </<?php echo esc_html($heading_tag); ?>>

        <?php endif; ?>



        <?php if ( ! empty($custom_content) ) : ?>

            <div class="custom-content">

                <?php echo wp_kses_post($custom_content); ?>

            </div>

        <?php endif; ?>



        </div>

    </div>

</section>
