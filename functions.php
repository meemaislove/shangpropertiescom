<?php
// if ( ! function_exists( 'template_theme_setup' ) ) :
// function template_theme_setup() {
// 	add_theme_support( 'post-thumbnails' );
// 	add_theme_support( 'post-formats',  array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
// 	register_nav_menus( array(
// 	    'primary'   => __( 'Primary Menu', 'template Header' )
// 	) );
// 	add_theme_support( 'woocommerce' );
// 	add_theme_support( 'wc-product-gallery-zoom' );
// 	add_theme_support( 'wc-product-gallery-lightbox' );
// 	add_theme_support( 'wc-product-gallery-slider' );
// }
// endif;
// add_action( 'after_setup_theme', 'template_theme_setup' );

// function theme_enqueue_assets() {
//     wp_enqueue_style(
//         'theme-style',
//         get_template_directory_uri() . '/inc/css/style.css',
//         [],
//         '1.0'
//     );
// }
// add_action('wp_enqueue_scripts', 'theme_enqueue_assets');


function shang_enqueue_styles() {

    $uri = get_template_directory_uri() . '/inc/css/';
    $path = get_template_directory() . '/inc/css/';

    // AOS
    wp_enqueue_style(
        'shang-aos',
        $uri . 'aos.css',
        [],
        filemtime($path . 'aos.css')
    );

    // Bootstrap
    wp_enqueue_style(
        'shang-bootstrap',
        $uri . 'bootstrap.min.css',
        [],
        filemtime($path . 'bootstrap.min.css')
    );

    // Owl Carousel
    wp_enqueue_style(
        'shang-owl-carousel',
        $uri . 'owl.carousel.min.css',
        [],
        filemtime($path . 'owl.carousel.min.css')
    );

    wp_enqueue_style(
        'shang-owl-theme',
        $uri . 'owl.theme.default.min.css',
        [],
        filemtime($path . 'owl.theme.default.min.css')
    );

    // Flickity
    wp_enqueue_style(
        'shang-flickity',
        $uri . 'flickity.css',
        [],
        filemtime($path . 'flickity.css')
    );

    // Global
    wp_enqueue_style(
        'shang-global',
        $uri . 'global.css',
        [],
        filemtime($path . 'global.css')
    );


    // Main styles (LOAD LAST)
    wp_enqueue_style(
        'shang-main',
        $uri . 'shang-base.css',
        [
            'shang-bootstrap',
            'shang-owl-carousel'
        ],
        filemtime($path . 'shang-base.css')
    );

    // Homepage
    wp_enqueue_style(
        'shang-homepage',
        $uri . 'shang-homepage.css',
        ['shang-main'],
        filemtime($path . 'shang-homepage.css')
    );

    // Inside
    wp_enqueue_style(
        'shang-inside',
        $uri . 'shang-inside.css',
        [],
        filemtime($path . 'shang-inside.css')
    );

    // Residentials
    wp_enqueue_style(
        'shang-residentials',
        $uri . 'shang-residentials.css',
        [],
        filemtime($path . 'shang-residentials.css')
    );

    // Single
    wp_enqueue_style(
        'shang-single',
        $uri . 'shang-single.css',
        [],
        filemtime($path . 'shang-single.css')
    );
}
add_action('wp_enqueue_scripts', 'shang_enqueue_styles');



function shang_enqueue_scripts() {

    $uri = get_template_directory_uri() . '/inc/js/';
    $path = get_template_directory() . '/inc/js/';

    // AOS
    wp_enqueue_script(
        'shang-aos',
        $uri . 'aos.js',
        [],
        filemtime($path . 'aos.js'),
        true
    );

    // Bootstrap (bundle includes Popper)
    wp_enqueue_script(
        'shang-bootstrap',
        $uri . 'bootstrap.bundle.min.js',
        [],
        filemtime($path . 'bootstrap.bundle.min.js'),
        true
    );

    // Owl Carousel (needs jQuery)
    wp_enqueue_script(
        'shang-owl',
        $uri . 'owl.carousel.min.js',
        ['jquery'],
        filemtime($path . 'owl.carousel.min.js'),
        true
    );

    // Flickity
    wp_enqueue_script(
        'shang-flickity',
        $uri . 'flickity.pkgd.js',
        ['jquery'],
        filemtime($path . 'flickity.pkgd.js'),
        true
    );

    // Main script (depends on everything)
    wp_enqueue_script(
        'shang-main',
        $uri . 'shang-scripts.js',
        ['jquery', 'shang-bootstrap', 'shang-owl', 'shang-aos'],
        filemtime($path . 'shang-scripts.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'shang_enqueue_scripts');

//remove top level p tags - wysiwyg
function shang_remove_p_tags( $content ) {
    if ( empty($content) ) {
        return '';
    }

    libxml_use_internal_errors(true);

    $dom = new DOMDocument();

    $dom->loadHTML(
        '<?xml encoding="utf-8" ?><div id="shang-temp-wrapper">' . $content . '</div>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );

    $wrapper = $dom->getElementById('shang-temp-wrapper');

    if ( ! $wrapper ) {
        return $content;
    }

    $children = [];

    foreach ( $wrapper->childNodes as $child ) {
        $children[] = $child;
    }

    foreach ( $children as $child ) {
        if ( $child->nodeName === 'p' ) {
            while ( $child->firstChild ) {
                $wrapper->insertBefore($child->firstChild, $child);
            }

            $wrapper->removeChild($child);
        }
    }

    $output = '';

    foreach ( $wrapper->childNodes as $child ) {
        $output .= $dom->saveHTML($child);
    }

    libxml_clear_errors();

    return $output;
}

add_filter('wpcf7_autop_or_not', '__return_false');



// Residential Grid
add_action('wp_ajax_filter_residentials', 'filter_residentials_ajax');
add_action('wp_ajax_nopriv_filter_residentials', 'filter_residentials_ajax');

function filter_residentials_ajax() {
    $locations = !empty($_POST['locations'])
        ? array_map('sanitize_text_field', (array) $_POST['locations'])
        : array();

    $property_type = !empty($_POST['property_type'])
        ? sanitize_text_field($_POST['property_type'])
        : 'default-type';

    $property_status = !empty($_POST['property_status'])
        ? sanitize_text_field($_POST['property_status'])
        : 'default-status';

    $meta_query = array('relation' => 'AND');

    if (!empty($locations)) {
        $meta_query[] = array(
            'key'     => 'location',
            'value'   => $locations,
            'compare' => 'IN',
        );
    }

    // All Properties = allow both pre-selling and ready-for-occupancy
    if ($property_type !== 'default-type') {
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => 'property_type',
                'value'   => $property_type,
                'compare' => '=',
            ),
            array(
                'key'     => 'property_type',
                'value'   => 'default-type',
                'compare' => '=',
            ),
        );
    }

    if ($property_status !== 'default-status') {
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => 'property_status',
                'value'   => $property_status,
                'compare' => '=',
            ),
            array(
                'key'     => 'property_status',
                'value'   => 'default-status',
                'compare' => '=',
            ),
        );
    }

    $args = array(
        'post_type'      => 'residentials',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'post__not_in'   => array(752, 756),
        'orderby'        => 'date',
        'order'          => 'ASC',
    );

    if (count($meta_query) > 1) {
        $args['meta_query'] = $meta_query;
    }

    $residentials_query = new WP_Query($args);

    if ($residentials_query->have_posts()) :
        while ($residentials_query->have_posts()) :
            $residentials_query->the_post();

            $permalink    = get_permalink();
            $title        = get_the_title();
            $preview_text = get_field('preview_text');
            ?>

            <div class="grid-item">
                <div class="main-details">
                    <div class="image-container">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php echo esc_url($permalink); ?>" target="_blank">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <h3><?php echo esc_html($title); ?></h3>

                    <?php if ($preview_text) : ?>
                        <div class="preview-text">
                            <?php echo wp_kses_post($preview_text); ?>
                        </div>
                    <?php endif; ?>


                </div>

                <div class="item-cta">
                    <div class="arrow-cta">
                        <a href="<?php echo esc_url($permalink); ?>" class="arrow-link" target="_blank">
                            Learn More
                            <svg width="41" height="11" viewBox="0 0 41 11" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(41, 11) rotate(180)">
                                    <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor"></path>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p class="no-results">No residential spaces found.</p>';
    endif;

    wp_die();
}



//Select2

function enqueue_cf7_select2_assets() {
    wp_enqueue_style(
        'select2-css',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        array(),
        '4.1.0'
    );

    wp_enqueue_script(
        'select2-js',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
        array('jquery'),
        '4.1.0',
        true
    );

    wp_add_inline_script('select2-js', "
        jQuery(document).ready(function($) {

            function initCF7Select2() {
                $('.cf7-select2').each(function() {
                    var field = $(this);

                    if (!field.hasClass('select2-hidden-accessible')) {
                        field.select2({
                            width: '100%',
                            placeholder: field.find('option:first').text(),
                            allowClear: false
                        });
                    }
                });
            }

            initCF7Select2();

            document.addEventListener('wpcf7reset', function() {
                setTimeout(function() {
                    $('.cf7-select2').val('').trigger('change');
                }, 100);
            });

        });
    ");
}
add_action('wp_enqueue_scripts', 'enqueue_cf7_select2_assets');


add_action('wp_ajax_filter_news_updates', 'filter_news_updates_ajax');
add_action('wp_ajax_nopriv_filter_news_updates', 'filter_news_updates_ajax');

function filter_news_updates_ajax() {

    $post_type = 'news-updates';

    $raw_categories = isset($_POST['categories']) ? (array) $_POST['categories'] : array();

    $categories = array_map(function ($category) {
        return sanitize_text_field(wp_unslash($category));
    }, $raw_categories);

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
    );

    /**
     * ACF field:
     * Field Label: Category Type
     * Field Name: category_type
     *
     * Since this is an ACF radio button, use meta_query, not tax_query.
     */
    if (!empty($categories)) {
        $args['meta_query'] = array(
            array(
                'key'     => 'category_type',
                'value'   => $categories,
                'compare' => 'IN',
            ),
        );
    }

    $news_updates_query = new WP_Query($args);

    if ($news_updates_query->have_posts()) :

        while ($news_updates_query->have_posts()) : $news_updates_query->the_post();

            $permalink    = get_permalink();
            $title        = get_the_title();
            $preview_text = get_field('preview_text');
            $publish_date = get_field('publish_date');

            /* ACF Radio: Category Type Label */
            $category_type_field = get_field_object('category_type');
            $category_type_value = get_field('category_type');
            $category_type_label = '';

            if ($category_type_field && $category_type_value) {
                if (is_array($category_type_value) && isset($category_type_value['label'])) {
                    $category_type_label = $category_type_value['label'];
                } elseif (isset($category_type_field['choices'][$category_type_value])) {
                    $category_type_label = $category_type_field['choices'][$category_type_value];
                } else {
                    $category_type_label = $category_type_value;
                }
            }


            $publish_date_raw = get_field('publish_date', false, false);
            $publish_timestamp = 0;

            if ($publish_date_raw) {
                if (preg_match('/^\d{8}$/', $publish_date_raw)) {
                    $date_object = DateTime::createFromFormat('Ymd', $publish_date_raw);

                    if ($date_object) {
                        $publish_timestamp = $date_object->getTimestamp();
                    }
                } else {
                    $publish_timestamp = strtotime($publish_date_raw);
                }
            }

            ?>

            <div class="grid-item"
                data-title="<?php echo esc_attr(strtolower($title)); ?>"
                data-date="<?php echo esc_attr($publish_timestamp); ?>">

                <div class="main-details">

                    <div class="image-container">

                        <?php if (has_post_thumbnail()) : ?>

                            <a href="<?php echo esc_url($permalink); ?>" target="_blank">
                                <?php the_post_thumbnail('large'); ?>
                            </a>

                        <?php endif; ?>

                    </div>

                    <?php if ($category_type_label) : ?>
                            <span class="title-kicker"><?php echo esc_html($category_type_label); ?></span>
                    <?php endif; ?>

                    <h3><?php echo esc_html($title); ?></h3>

                    <?php if ($preview_text) : ?>

                        <div class="preview-text d-none">
                            <?php echo wp_kses_post($preview_text); ?>
                        </div>

                    <?php endif; ?>

                    <span class="news-publish-date"><?php echo esc_html($publish_date); ?></span>

                </div>

                <div class="item-cta">

                    <div class="arrow-cta">

                        <a href="<?php echo esc_url($permalink); ?>" class="arrow-link" target="_blank">

                            Learn More

                            <svg width="41" height="11" viewBox="0 0 41 11" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(41, 11) rotate(180)">
                                    <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor" fill-opacity="1.0"></path>
                                </g>
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

            <?php

        endwhile;

    else :

        echo '<p class="no-results">No news and updates found.</p>';

    endif;

    wp_reset_postdata();
    wp_die();
}


//Blogs Filter and Sort
add_action('wp_ajax_filter_blogs', 'filter_blogs_ajax');
add_action('wp_ajax_nopriv_filter_blogs', 'filter_blogs_ajax');

function filter_blogs_ajax() {

    $post_type = 'blog';

    $raw_categories = isset($_POST['categories']) ? (array) $_POST['categories'] : array();

    $categories = array_map(function ($category) {
        return sanitize_text_field(wp_unslash($category));
    }, $raw_categories);

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
    );

    /**
     * ACF field:
     * Field Label: Category Type
     * Field Name: category_type
     *
     * Since this is an ACF radio button, use meta_query, not tax_query.
     */
    if (!empty($categories)) {
        $args['meta_query'] = array(
            array(
                'key'     => 'category_type',
                'value'   => $categories,
                'compare' => 'IN',
            ),
        );
    }

    $blogs_query = new WP_Query($args);

    if ($blogs_query->have_posts()) :

        while ($blogs_query->have_posts()) : $blogs_query->the_post();

            $permalink    = get_permalink();
            $title        = get_the_title();
            $preview_text = get_field('preview_text');
            $publish_date = get_field('publish_date');

            /* ACF Radio: Category Type Label */
            $category_type_field = get_field_object('category_type');
            $category_type_value = get_field('category_type');
            $category_type_label = '';

            if ($category_type_field && $category_type_value) {
                if (is_array($category_type_value) && isset($category_type_value['label'])) {
                    $category_type_label = $category_type_value['label'];
                } elseif (isset($category_type_field['choices'][$category_type_value])) {
                    $category_type_label = $category_type_field['choices'][$category_type_value];
                } else {
                    $category_type_label = $category_type_value;
                }
            }

            $publish_date_raw = get_field('publish_date', false, false);
            $publish_timestamp = 0;

            if ($publish_date_raw) {
                if (preg_match('/^\d{8}$/', $publish_date_raw)) {
                    $date_object = DateTime::createFromFormat('Ymd', $publish_date_raw);

                    if ($date_object) {
                        $publish_timestamp = $date_object->getTimestamp();
                    }
                } else {
                    $publish_timestamp = strtotime($publish_date_raw);
                }
            }

            ?>

            <div class="grid-item"
                data-title="<?php echo esc_attr(strtolower($title)); ?>"
                data-date="<?php echo esc_attr($publish_timestamp); ?>">

                <div class="main-details">

                    <div class="image-container">

                        <?php if (has_post_thumbnail()) : ?>

                            <a href="<?php echo esc_url($permalink); ?>" target="_blank">
                                <?php the_post_thumbnail('large'); ?>
                            </a>

                        <?php endif; ?>

                    </div>

                    <?php if ($category_type_label) : ?>
                        <span class="title-kicker"><?php echo esc_html($category_type_label); ?></span>
                    <?php endif; ?>

                    <h3><?php echo esc_html($title); ?></h3>

                    <?php if ($preview_text) : ?>

                        <div class="preview-text d-none">
                            <?php echo wp_kses_post($preview_text); ?>
                        </div>

                    <?php endif; ?>

                    <span class="news-publish-date"><?php echo esc_html($publish_date); ?></span>

                </div>

                <div class="item-cta">

                    <div class="arrow-cta">

                        <a href="<?php echo esc_url($permalink); ?>" class="arrow-link" target="_blank">

                            Learn More

                            <svg width="41" height="11" viewBox="0 0 41 11" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(41, 11) rotate(180)">
                                    <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor" fill-opacity="1.0"></path>
                                </g>
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

            <?php

        endwhile;

    else :

        echo '<p class="no-results">No blogs found.</p>';

    endif;

    wp_reset_postdata();
    wp_die();
}


//Search results
add_action('wp_ajax_search_blog_results', 'search_blog_results_ajax');
add_action('wp_ajax_nopriv_search_blog_results', 'search_blog_results_ajax');

function search_blog_results_ajax() {
    if (
        !isset($_POST['nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'search_blog_results_nonce')
    ) {
        wp_send_json_error(array(
            'message' => 'Security check failed.',
        ));
    }

    $search_query = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])) : '';
    $paged        = isset($_POST['page']) ? absint($_POST['page']) : 1;

    $blog_search_query = new WP_Query(array(
        'post_type'      => 'blog',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
        's'              => $search_query,
        'paged'          => $paged,
    ));

    ob_start();

    if ($blog_search_query->have_posts()) :
        while ($blog_search_query->have_posts()) : $blog_search_query->the_post();
            search_blog_render_card();
        endwhile;
    else :
        ?>
        <p class="no-results">
            No results found for "<?php echo esc_html($search_query); ?>".
        </p>
        <?php
    endif;

    $html = ob_get_clean();

    $pagination = search_blog_render_pagination(
        $paged,
        $blog_search_query->max_num_pages
    );

    wp_reset_postdata();

    wp_send_json_success(array(
        'html'       => $html,
        'pagination' => $pagination,
    ));
}


function search_blog_render_card() {
    $publish_date = function_exists('get_field') ? get_field('publish_date') : '';
    $preview_text = function_exists('get_field') ? get_field('preview_text') : '';

    if ($publish_date) {
        if (preg_match('/^\d{8}$/', $publish_date)) {
            $date_object = DateTime::createFromFormat('Ymd', $publish_date);
            $formatted_date = $date_object ? $date_object->format('d.m.Y') : get_the_date('d.m.Y');
        } else {
            $formatted_date = date('d.m.Y', strtotime($publish_date));
        }
    } else {
        $formatted_date = get_the_date('d.m.Y');
    }

    $word_count = str_word_count(strip_tags(get_the_content()));
    $read_time  = max(1, ceil($word_count / 200));
    ?>

    <div class="related-post">
        <div class="post-details">

            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>
            <?php endif; ?>

            <div class="duration-details">
                <span><?php echo esc_html($formatted_date); ?></span>

                <img src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/detail-dot.png" alt="">

                <span><?php echo esc_html($read_time); ?> min. read</span>
            </div>

            <h3><?php the_title(); ?></h3>

            <p>
                <?php echo $preview_text ? wp_kses_post($preview_text) : esc_html(wp_trim_words(get_the_excerpt(), 22, '...')); ?>
            </p>

        </div>

        <div class="item-cta">
            <div class="arrow-cta">
                <a class="arrow-link" href="<?php the_permalink(); ?>" target="_blank" rel="noopener">
                    Read More
                    <div class="arrow-icons" aria-hidden="true">
                        <img src="https://spi.whitedragontech.com/wp-content/uploads/2026/05/arrow-icon.png" class="red-arrow" alt="">
                        <img src="https://spi.whitedragontech.com/wp-content/uploads/2026/05/arrow-icon-yellow.png" class="yellow-arrow" alt="">
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php
}


function search_blog_chevron_svg() {
    return '
        <svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.48156 0.336413L10.2465 7.87203C10.3387 7.96174 10.4041 8.05893 10.4428 8.16359C10.4816 8.26825 10.5006 8.38039 10.5 8.5C10.5 8.61961 10.4806 8.73175 10.4419 8.83641C10.4032 8.94107 10.3381 9.03826 10.2465 9.12797L2.48156 16.686C2.26651 16.8953 1.99769 17 1.67511 17C1.35253 17 1.07603 16.8879 0.845621 16.6636C0.615207 16.4393 0.5 16.1777 0.5 15.8786C0.5 15.5796 0.615207 15.3179 0.845621 15.0937L7.61981 8.5L0.845623 1.90633C0.630569 1.69701 0.523042 1.43894 0.523042 1.13214C0.523042 0.825331 0.63825 0.560087 0.868664 0.336413C1.09908 0.112137 1.36789 0 1.67511 0C1.98233 0 2.25115 0.112137 2.48156 0.336413Z" fill="currentColor"/>
        </svg>
    ';
}


function search_blog_render_pagination($current_page, $max_pages) {
    if ($max_pages <= 1) {
        return '';
    }

    $max_pages    = max(1, absint($max_pages));
    $current_page = min($max_pages, max(1, absint($current_page)));

    // Pages that should always be visible
    $pages = [1, $max_pages, $current_page - 1, $current_page, $current_page + 1];

    // Near the start: 1 2 3
    if ($current_page <= 3) {
        $pages = array_merge($pages, [1, 2, 3]);
    }

    // Near the end: last three
    if ($current_page >= $max_pages - 2) {
        $pages = array_merge($pages, [$max_pages - 2, $max_pages - 1, $max_pages]);
    }

    $pages = array_unique(array_filter($pages, function ($p) use ($max_pages) {
        return $p >= 1 && $p <= $max_pages;
    }));
    sort($pages);

    ob_start();
    ?>

    <div class="search-pagination">

        <button
            type="button"
            class="page-numbers prev"
            data-page="<?php echo esc_attr(max(1, $current_page - 1)); ?>"
            <?php disabled($current_page <= 1); ?>
            aria-label="Previous page"
        >
            <span class="pagination-chevron pagination-chevron-prev">
                <?php echo search_blog_chevron_svg(); ?>
            </span>
        </button>

        <?php
        $prev = 0;
        foreach ($pages as $i) :

            if ($prev) {
                $gap = $i - $prev;

                if ($gap === 2) :
                    // Only one page hidden: show it instead of dots
                    $mid = $prev + 1; ?>
                    <button
                        type="button"
                        class="page-numbers"
                        data-page="<?php echo esc_attr($mid); ?>"
                    >
                        <?php echo esc_html($mid); ?>
                    </button>
                <?php elseif ($gap > 2) : ?>
                    <span class="page-numbers dots" aria-hidden="true">&hellip;</span>
                <?php endif;
            }
            ?>

            <button
                type="button"
                class="page-numbers <?php echo $i === $current_page ? 'current' : ''; ?>"
                data-page="<?php echo esc_attr($i); ?>"
                <?php disabled($i === $current_page); ?>
            >
                <?php echo esc_html($i); ?>
            </button>

            <?php
            $prev = $i;
        endforeach;
        ?>

        <button
            type="button"
            class="page-numbers next"
            data-page="<?php echo esc_attr(min($max_pages, $current_page + 1)); ?>"
            <?php disabled($current_page >= $max_pages); ?>
            aria-label="Next page"
        >
            <span class="pagination-chevron pagination-chevron-next">
                <?php echo search_blog_chevron_svg(); ?>
            </span>
        </button>

    </div>

    <?php
    return ob_get_clean();
}


add_action('wp_footer', 'search_blog_ajax_config', 5);

function search_blog_ajax_config() {
    ?>
    <script>
        window.searchBlogAjax = {
            ajaxurl: "<?php echo esc_url(admin_url('admin-ajax.php')); ?>",
            nonce: "<?php echo esc_attr(wp_create_nonce('search_blog_results_nonce')); ?>"
        };
    </script>
    <?php
}

// Yoast title

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});
