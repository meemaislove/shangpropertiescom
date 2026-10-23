<?php get_header(); ?>

<?php
$post_id               = get_the_ID();
$article_content_field = 'article_content';

$featured_image_placeholder = 'https://shangproperties.com/wp-content/uploads/2026/07/post-featured-placeholder.png';

/**
 * Calculate the article reading time from the ACF Text Content layouts.
 * Falls back to the standard WordPress editor content.
 */
$get_article_read_time = static function ($article_id) use ($article_content_field) {
    $article_rows = get_field($article_content_field, $article_id);
    $article_text = '';

    if (is_array($article_rows)) {
        foreach ($article_rows as $row) {
            if (
                !empty($row['acf_fc_layout']) &&
                $row['acf_fc_layout'] === 'text_content' &&
                !empty($row['text'])
            ) {
                $article_text .= ' ' . $row['text'];
            }
        }
    }

    /*
     * Fallback for older articles using the standard editor.
     */
    if (trim($article_text) === '') {
        $article_text = get_post_field('post_content', $article_id);
    }

    $clean_text = wp_strip_all_tags(
        strip_shortcodes($article_text)
    );

    $word_count = str_word_count($clean_text);

    return max(1, (int) ceil($word_count / 200));
};

/**
 * Format the ACF publish date.
 * Falls back to the WordPress published date.
 */
$format_article_date = static function ($publish_date, $article_id) {
    if (!empty($publish_date)) {
        $date_obj = DateTime::createFromFormat(
            'F j, Y',
            trim($publish_date)
        );

        if ($date_obj instanceof DateTime) {
            return $date_obj->format('d.m.Y');
        }

        /*
         * Additional fallback in case the ACF date format changes.
         */
        $timestamp = strtotime($publish_date);

        if ($timestamp !== false) {
            return date_i18n('d.m.Y', $timestamp);
        }
    }

    return get_the_date('d.m.Y', $article_id);
};

/*
 * Banner fields.
 */
$banner_image = get_field('banner_image', $post_id);
$publish_date = get_field('publish_date', $post_id);

$banner_url = '';

if (is_array($banner_image) && !empty($banner_image['url'])) {
    $banner_url = $banner_image['url'];
} elseif (is_numeric($banner_image)) {
    $banner_url = wp_get_attachment_image_url(
        $banner_image,
        'full'
    );
} elseif (is_string($banner_image) && !empty($banner_image)) {
    $banner_url = $banner_image;
}

/*
 * Use the featured image when the ACF banner image is empty.
 */
if (empty($banner_url) && has_post_thumbnail($post_id)) {
    $banner_url = get_the_post_thumbnail_url(
        $post_id,
        'full'
    );
}

/*
 * Use the placeholder when neither the ACF banner image
 * nor the featured image is available.
 */
if (empty($banner_url)) {
    $banner_url = $featured_image_placeholder;
}

$read_time = $get_article_read_time($post_id);

$formatted_date = $format_article_date(
    $publish_date,
    $post_id
);
?>

<section
    class="single-post-banner"
    style="background: url('<?php echo esc_url($banner_url); ?>') center/cover no-repeat;"
>
    <div class="single-post-banner-contents">

        <span>
            <?php echo esc_html($read_time); ?> Min. Read
        </span>

        <h1>
            <?php the_title(); ?>
        </h1>

        <?php if (!empty($formatted_date)) : ?>
            <span>
                <?php echo esc_html($formatted_date); ?>
            </span>
        <?php endif; ?>

    </div>
</section>

<section class="single-post-content">
    <div class="single-post-content-contents">

        <?php if (have_rows($article_content_field, $post_id)) : ?>

            <?php
            while (have_rows($article_content_field, $post_id)) :
                the_row();

                $layout_name = get_row_layout();

                if (empty($layout_name)) {
                    continue;
                }

                /*
                 * Layout mapping:
                 *
                 * large_image
                 * → news-updates-templates/large_image.php
                 *
                 * slider
                 * → news-updates-templates/slider.php
                 *
                 * text_content
                 * → news-updates-templates/text_content.php
                 *
                 * video_section
                 * → news-updates-templates/video_section.php
                 */
                $layout_file = get_theme_file_path(
                    'news-updates-templates/' .
                    sanitize_file_name($layout_name) .
                    '.php'
                );

                if (is_readable($layout_file)) {
                    include $layout_file;
                } elseif (defined('WP_DEBUG') && WP_DEBUG) {
                    echo '<!-- Missing layout file: news-updates-templates/' .
                        esc_html($layout_name) .
                        '.php -->';
                }

            endwhile;
            ?>

        <?php else : ?>

            <?php
            /*
             * Fallback for older posts that still use the
             * standard WordPress editor.
             */
            the_content();
            ?>

        <?php endif; ?>

    </div>
</section>

<section class="socmed-sharers">
    <div class="socmed-sharers-content">

        <p>Share it on:</p>

        <div class="socmed-icons">

            <a
                href="#"
                class="socmed-icon share-facebook"
                target="_blank"
                rel="noopener"
            >
                <img
                    src="https://shangproperties.com/wp-content/uploads/2026/06/sharer-icon-fb.png"
                    alt="Share on Facebook"
                >
            </a>

            <a
                href="#"
                class="socmed-icon share-x"
                target="_blank"
                rel="noopener"
            >
                <img
                    src="https://shangproperties.com/wp-content/uploads/2026/06/sharer-icon-x.png"
                    alt="Share on X"
                >
            </a>

            <a
                href="#"
                class="socmed-icon share-linkedin"
                target="_blank"
                rel="noopener"
            >
                <img
                    src="https://shangproperties.com/wp-content/uploads/2026/06/sharer-icon-linkedin.png"
                    alt="Share on LinkedIn"
                >
            </a>

            <a
                href="#"
                class="socmed-icon copy-link"
            >
                <img
                    src="https://shangproperties.com/wp-content/uploads/2026/06/sharer-icon-copy.png"
                    alt="Copy article link"
                >
            </a>

        </div>
    </div>
</section>

<section class="related-posts">
    <div class="related-posts-content">
        <div class="heading-text">
            <?php
            $post_type = get_post_type();

            if ($post_type === 'news-updates') :
            ?>
                <h2>Related News and Updates</h2>

                <p>
                    Our News &amp; Updates section keeps you connected to new projects,
                    events, and innovations in luxury living.
                </p>

            <?php elseif ($post_type === 'blog' || $post_type === 'post') : ?>

                <h2>Related Journals</h2>

                <p>
                    Discover a treasure trove of articles encompassing luxury living,
                    industry expertise, and insightful perspectives.
                </p>
            <?php endif; ?>
        </div>

        <?php
        $current_id  = get_the_ID();
        $current_uri = isset($_SERVER['REQUEST_URI'])
            ? wp_unslash($_SERVER['REQUEST_URI'])
            : '';

        if (strpos($current_uri, '/news-updates/') !== false) {
            $post_type = 'news-updates';
        } elseif (
            strpos($current_uri, '/blog/') !== false ||
            strpos($current_uri, '/blogs/') !== false
        ) {
            $post_type = 'blog';
        } else {
            $post_type = get_post_type();
        }

        $related_posts = new WP_Query([
            'post_type'      => $post_type,
            'posts_per_page' => 3,
            'post__not_in'   => [$current_id],
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if ($related_posts->have_posts()) :
        ?>
            <div class="related-posts">
                <?php
                while ($related_posts->have_posts()) :
                    $related_posts->the_post();

                    $related_post_id = get_the_ID();

                    $related_publish_date = get_field(
                        'publish_date',
                        $related_post_id
                    );

                    $preview_text = get_field(
                        'preview_text',
                        $related_post_id
                    );

                    /*
                     * Use each related post's ACF date.
                     * Fall back to its WordPress published date.
                     */
                    $related_formatted_date = '';

                    if (!empty($related_publish_date)) {
                        $related_date_obj = DateTime::createFromFormat(
                            'F j, Y',
                            $related_publish_date
                        );

                        if ($related_date_obj) {
                            $related_formatted_date = $related_date_obj->format(
                                'd.m.Y'
                            );
                        }
                    }

                    if (empty($related_formatted_date)) {
                        $related_formatted_date = get_the_date(
                            'd.m.Y',
                            $related_post_id
                        );
                    }

                    /*
                     * Calculate related post reading time.
                     */
                    $related_content = get_post_field(
                        'post_content',
                        $related_post_id
                    );

                    $related_word_count = str_word_count(
                        wp_strip_all_tags(
                            strip_shortcodes($related_content)
                        )
                    );

                    $related_read_time = max(
                        1,
                        ceil($related_word_count / 200)
                    );

                    /*
                     * Get featured image ID, URL, and backend alt text.
                     */
                    $related_thumbnail_id = get_post_thumbnail_id(
                        $related_post_id
                    );

                    $related_thumbnail_url = '';
                    $related_thumbnail_alt = '';

                    if ($related_thumbnail_id) {
                        $related_thumbnail_url = wp_get_attachment_image_url(
                            $related_thumbnail_id,
                            'medium_large'
                        );

                        $related_thumbnail_alt = get_post_meta(
                            $related_thumbnail_id,
                            '_wp_attachment_image_alt',
                            true
                        );
                    }

                    /*
                     * Fall back to post title when backend alt is empty.
                     */
                    if (empty($related_thumbnail_alt)) {
                        $related_thumbnail_alt = get_the_title(
                            $related_post_id
                        );
                    }
                ?>

                    <div class="related-post">
                        <div class="post-details">

                            <?php if (!empty($related_thumbnail_url)) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img
                                        src="<?php echo esc_url($related_thumbnail_url); ?>"
                                        alt="<?php echo esc_attr($related_thumbnail_alt); ?>"
                                        loading="lazy"
                                    >
                                </a>
                            <?php endif; ?>

                            <div class="duration-details">
                                <span>
                                    <?php echo esc_html($related_formatted_date); ?>
                                </span>

                                <img
                                    src="https://shangproperties.com/wp-content/uploads/2026/06/detail-dot.png"
                                    alt=""
                                >

                                <span>
                                    <?php echo esc_html($related_read_time); ?> min. read
                                </span>
                            </div>

                            <h3><?php the_title(); ?></h3>

                            <p>
                                <?php
                                echo $preview_text
                                    ? wp_kses_post($preview_text)
                                    : esc_html(
                                        wp_trim_words(
                                            get_the_excerpt(),
                                            22,
                                            '...'
                                        )
                                    );
                                ?>
                            </p>
                        </div>

                        <div class="item-cta">
                            <div class="arrow-cta">
                                <a
                                    class="arrow-link"
                                    href="<?php the_permalink(); ?>"
                                    target="_blank"
                                    rel="noopener"
                                >
                                    Read More

                                    <div class="arrow-icons" aria-hidden="true">
                                        <img
                                            src="https://shangproperties.com/wp-content/uploads/2026/05/arrow-icon.png"
                                            class="red-arrow"
                                            alt=""
                                        >

                                        <img
                                            src="https://shangproperties.com/wp-content/uploads/2026/05/arrow-icon-yellow.png"
                                            class="yellow-arrow"
                                            alt=""
                                        >
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>
        <?php
        endif;

        wp_reset_postdata();
        ?>
    </div>
</section>

<?php get_footer(); ?>
