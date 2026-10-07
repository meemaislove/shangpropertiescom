<?php

$custom_id           = get_sub_field('custom_id');

$custom_classes      = get_sub_field('custom_classes');

$kicker_text         = get_sub_field('kicker_text');

$heading_tag         = get_sub_field('heading_tag') ?: 'h2';

$heading_title       = get_sub_field('heading_title');

$heading_description = get_sub_field('heading_description');



$section_id = $custom_id ? ' id="' . esc_attr($custom_id) . '"' : '';



$classes = ['homepage-years'];



if ($custom_classes) {

    $extra_classes = array_map('trim', explode(',', $custom_classes));

    $extra_classes = array_filter($extra_classes);



    $classes = array_merge($classes, $extra_classes);

}



$classes = implode(' ', $classes);



$allowed_heading_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];



if (!in_array($heading_tag, $allowed_heading_tags, true)) {

    $heading_tag = 'h2';

}

?>



<section data-aos="fade-up" data-aos-duration="1500" class="<?php echo esc_attr($classes); ?>"<?php echo $section_id; ?>>

    <div class="homepage-years-background"></div>



    <div class="homepage-years-contents">

        <div class="years-container">

            <div class="years-counter">

                <span class="count-main">37</span>

                <span class="count-text">years</span>

            </div>



            <div class="heading-text">

                <?php if ($kicker_text) : ?>

                    <span class="title-kicker"><?php echo esc_html($kicker_text); ?></span>

                <?php endif; ?>



                <?php if ($heading_title) : ?>

                    <<?php echo esc_html($heading_tag); ?>>

                        <?php echo esc_html($heading_title); ?>

                    </<?php echo esc_html($heading_tag); ?>>

                <?php endif; ?>



                <?php if ($heading_description) : ?>

                    <?php echo wp_kses_post($heading_description); ?>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>
