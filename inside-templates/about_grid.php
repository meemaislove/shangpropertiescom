<?php

/**

 * Layout: About Grid

 * File: inside-templates/about_grid.php

 */



$custom_id      = get_sub_field('custom_id');

$custom_classes = get_sub_field('custom_classes');

$kicker_text    = get_sub_field('kicker_text');

$heading_tag    = get_sub_field('heading_tag');

$heading_text   = get_sub_field('heading_text');

$grid_content   = get_sub_field('grid_content');



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

    data-aos="fade-up" data-aos-duration="1500"

    <?php if ( ! empty($custom_id) ) : ?>

        id="<?php echo esc_attr($custom_id); ?>"

    <?php endif; ?>

    class="about-grid <?php echo esc_attr($custom_classes_output); ?>"

>

    <div class="about-grid-contents">



        <div class="heading-content">



            <?php if ( ! empty($kicker_text) ) : ?>

                <span class="title-kicker"><?php echo esc_html($kicker_text); ?></span>

            <?php endif; ?>



            <?php if ( ! empty($heading_text) ) : ?>

                <<?php echo esc_html($heading_tag); ?>>

                    <?php echo esc_html($heading_text); ?>

                </<?php echo esc_html($heading_tag); ?>>

            <?php endif; ?>



        </div>



        <?php if ( ! empty($grid_content) ) : ?>

            <div class="about-grid-list">



                <?php foreach ( $grid_content as $grid_item ) : ?>



                    <?php

                    $item_content = $grid_item['grid_item'] ?? '';



                    if ( ! empty($item_content) ) :

                        $item_content = shang_remove_p_tags($item_content);

                    ?>





                            <?php echo wp_kses_post($item_content); ?>





                    <?php endif; ?>



                <?php endforeach; ?>



            </div>

        <?php endif; ?>



    </div>

</section>
