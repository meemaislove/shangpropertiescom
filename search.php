<?php
get_header();

$search_query = get_search_query();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$blog_search_query = new WP_Query(array(
    'post_type'      => 'blog',
    'posts_per_page' => 9,
    'post_status'    => 'publish',
    's'              => $search_query,
    'paged'          => $paged,
));
?>

<section
    id="searchBanner"
    class="about-banner search-banner"
    style="background-image: url('https://shangproperties.com/wp-content/uploads/2026/06/search-banner-bg.png');"
>
    <div class="about-banner-contents">
        <div class="banner-heading">
            <h1>Search results for "<?php echo esc_html($search_query); ?>"</h1>
        </div>
    </div>
</section>

<section
    class="related-posts search-results-posts"
    data-search="<?php echo esc_attr($search_query); ?>"
>
    <div class="related-posts-content">

        <?php if ($blog_search_query->have_posts()) : ?>

            <div class="related-posts" id="searchResultsPosts">

                <?php while ($blog_search_query->have_posts()) : $blog_search_query->the_post(); ?>

                    <?php search_blog_render_card(); ?>

                <?php endwhile; ?>

            </div>

            <div id="searchResultsPagination">
                <?php echo search_blog_render_pagination(1, $blog_search_query->max_num_pages); ?>
            </div>

        <?php else : ?>

            <div class="related-posts" id="searchResultsPosts">
                <p class="no-results">
                    No results found for "<?php echo esc_html($search_query); ?>".
                </p>
            </div>

            <div id="searchResultsPagination"></div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </div>
</section>

<?php get_footer(); ?>
