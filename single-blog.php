<?php get_header(); ?>

<?php
$banner_image = get_field('banner_image');
$publish_date = get_field('publish_date');

$banner_url = '';

if (is_array($banner_image) && !empty($banner_image['url'])) {
    $banner_url = $banner_image['url'];
} elseif (is_numeric($banner_image)) {
    $banner_url = wp_get_attachment_image_url($banner_image, 'full');
} elseif (is_string($banner_image)) {
    $banner_url = $banner_image;
}

/* Fallback to featured image if no uploaded banner */
if (empty($banner_url) && has_post_thumbnail()) {
    $banner_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}

/* Calculate estimated reading time */
$content = get_post_field('post_content', get_the_ID());
$word_count = str_word_count(
    wp_strip_all_tags(
        strip_shortcodes($content)
    )
);

$read_time = max(1, ceil($word_count / 200));

/*
 * Use the ACF publish date when available.
 * Otherwise, use the post's original WordPress published date.
 */
$formatted_date = '';

if (!empty($publish_date)) {
    $date_obj = DateTime::createFromFormat('F j, Y', $publish_date);

    if ($date_obj) {
        $formatted_date = $date_obj->format('d.m.Y');
    }
}

if (empty($formatted_date)) {
    $formatted_date = get_the_date('d.m.Y', get_the_ID());
}
?>

<section
    class="single-post-banner"
    style="background: url('<?php echo esc_url($banner_url); ?>') center/cover no-repeat;"
>
    <div class="single-post-banner-contents">
        <span><?php echo esc_html($read_time); ?> Min. Read</span>

        <h1><?php the_title(); ?></h1>

        <?php if (!empty($formatted_date)) : ?>
            <span><?php echo esc_html($formatted_date); ?></span>
        <?php endif; ?>
    </div>
</section>

<section class="single-post-content blog-version">
    <div class="single-post-content-contents">
        <?php the_content(); ?>
    </div>
</section>

<section class="socmed-sharers">
    <div class="socmed-sharers-content">
        <p>Share it on:</p>

        <div class="socmed-icons">
            <a href="#" class="socmed-icon share-facebook" target="_blank" rel="noopener">
                <img
                    src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/sharer-icon-fb.png"
                    alt="Share on Facebook"
                >
            </a>

            <a href="#" class="socmed-icon share-x" target="_blank" rel="noopener">
                <img
                    src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/sharer-icon-x.png"
                    alt="Share on X"
                >
            </a>

            <a href="#" class="socmed-icon share-linkedin" target="_blank" rel="noopener">
                <img
                    src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/sharer-icon-linkedin.png"
                    alt="Share on LinkedIn"
                >
            </a>

            <a href="#" class="socmed-icon copy-link">
                <img
                    src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/sharer-icon-copy.png"
                    alt="Copy page link"
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
        $current_uri = $_SERVER['REQUEST_URI'];

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

                    $related_publish_date = get_field('publish_date');
                    $preview_text         = get_field('preview_text');

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
                            $related_formatted_date = $related_date_obj->format('d.m.Y');
                        }
                    }

                    if (empty($related_formatted_date)) {
                        $related_formatted_date = get_the_date('d.m.Y');
                    }

                    $related_content = get_post_field(
                        'post_content',
                        get_the_ID()
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
                ?>

                    <div class="related-post">
                        <div class="post-details">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="duration-details">
                                <span>
                                    <?php echo esc_html($related_formatted_date); ?>
                                </span>

                                <img
                                    src="https://spi.whitedragontech.com/wp-content/uploads/2026/06/detail-dot.png"
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
                                            src="https://spi.whitedragontech.com/wp-content/uploads/2026/05/arrow-icon.png"
                                            class="red-arrow"
                                            alt=""
                                        >

                                        <img
                                            src="https://spi.whitedragontech.com/wp-content/uploads/2026/05/arrow-icon-yellow.png"
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
