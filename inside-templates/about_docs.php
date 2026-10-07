<?php

$custom_id      = get_sub_field('custom_id');

$custom_classes = get_sub_field('custom_classes');

$heading_tag    = get_sub_field('heading_tag') ?: 'h2';

$heading_text   = get_sub_field('heading_text');



$section_id = $custom_id ? ' id="' . esc_attr($custom_id) . '"' : '';



$classes = ['about-docs'];



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



<?php if (have_rows('docs_grid')) : ?>

    <section data-aos="fade-up" data-aos-duration="1500" class="<?php echo esc_attr($classes); ?>"<?php echo $section_id; ?>>

        <div class="about-docs-contents">

            <?php if ($heading_text) : ?>

                <div class="heading-text">

                    <<?php echo esc_html($heading_tag); ?>>

                        <?php echo esc_html($heading_text); ?>

                    </<?php echo esc_html($heading_tag); ?>>

                </div>

            <?php endif; ?>



            <div class="docs-grid">

                <?php while (have_rows('docs_grid')) : the_row(); ?>

                    <?php

                    $layout = get_row_layout();



                    $template_path = locate_template(

                        'inside-templates/inside-sub-templates/' . $layout . '.php'

                    );



                    if ($template_path) {

                        include $template_path;

                    }

                    ?>

                <?php endwhile; ?>

            </div>

        </div>

    </section>

<?php endif; ?>
