<?php

/**

 * Layout: Enterprise Nav Mini

 * File: inside-templates/enterprise_nav_mini.php

 */



$custom_id      = get_sub_field('custom_id');

$custom_classes = get_sub_field('custom_classes');



/**

 * Convert comma-separated custom classes into valid sibling classes.

 */

$custom_classes_array = [];



if ( ! empty($custom_classes) ) {

    $custom_classes_array = array_map('trim', explode(',', $custom_classes));

    $custom_classes_array = array_filter($custom_classes_array);

    $custom_classes_array = array_map('sanitize_html_class', $custom_classes_array);

}



$custom_classes_output = implode(' ', $custom_classes_array);





$current_page_slug = '';



if ( is_singular() ) {

    $current_page_slug = get_post_field('post_name', get_queried_object_id());

}



$current_page_slug_class = sanitize_html_class($current_page_slug);



/**

 * Temporary hardcoded nav array.

 * These are NOT from ACF.

 * Only custom_id and custom_classes are from ACF.

 */

$mini_nav_links = [

    [

        'link_title' => 'About Us',

        'link_url'   => 'http://spi.whitedragontech.com/offices/the-enterprise-center/',

        'link_id'    => 'enterpriseCenterMini'

    ],

    [

        'link_title' => 'Leasing Services',

        'link_url'   => 'http://spi.whitedragontech.com/offices/the-enterprise-center/leasing-services/',

        'link_id'    => 'enterpriseLeasingMini'

    ],

    [

        'link_title' => 'FAQS',

        'link_url'   => 'http://spi.whitedragontech.com/offices/the-enterprise-center/faqs/',

        'link_id'    => 'enterpriseFaqsMini'

    ]

];

?>



<section

    <?php if ( ! empty($custom_id) ) : ?>

        id="<?php echo esc_attr($custom_id); ?>"

    <?php endif; ?>

    class="about-nav-mini <?php echo esc_attr($custom_classes_output); ?>"

>

    <div class="about-nav-mini-contents">



        <?php foreach ( $mini_nav_links as $mini_nav_link ) : ?>

            <?php

            $link_title = $mini_nav_link['link_title'];

            $link_url   = $mini_nav_link['link_url'];

            $link_id    = $mini_nav_link['link_id'];

            ?>



            <a

                href="<?php echo esc_url($link_url); ?>"

                class="mini-link <?php echo esc_attr($current_page_slug_class); ?>"

                id="<?php echo esc_html($link_id); ?>"

            >

                <?php echo esc_html($link_title); ?>

            </a>



        <?php endforeach; ?>



    </div>

</section>
