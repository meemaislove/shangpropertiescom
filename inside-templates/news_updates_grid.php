<section class="residentials-grid news-updates-grid">

    <div class="residentials-grid-contents news-updates-grid-contents">
        <h2>All News and Updates</h2>
        <div class="grid-title">

            <div class="filter-button-container">

                <a href="#" class="filter-btn " id="newsUpdatesFilter">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 5H4L10.4 13.4089V19.2222L13.6 21V13.4089L20 5Z" stroke="#81001F" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                    <span>Filter</span>

                    <svg class="filter-chevron" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 6L9 12L15 18" stroke="#81001F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                </a>

            </div>

            <div class="sort-by-container">

                <a href="#" class="sort-by-btn" id="newsUpdatesSort" data-current-sort="newest">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_5540_6123" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="12" y="5" width="12" height="14">
                            <path d="M24 5.55469H12V18.5547H24V5.55469Z" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_5540_6123)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8223 6.20194C11.8223 5.78191 12.086 5.44141 12.4114 5.44141H23.4093C23.7347 5.44141 23.9985 5.78191 23.9985 6.20194C23.9985 6.62198 23.7347 6.96248 23.4093 6.96248H12.4114C12.086 6.96248 11.8223 6.62198 11.8223 6.20194Z" fill="#81001F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8223 9.9207C11.8223 9.50067 12.086 9.16016 12.4114 9.16016H20.3765C20.7019 9.16016 20.9656 9.50067 20.9656 9.9207C20.9656 10.3407 20.7019 10.6812 20.3765 10.6812H12.4114C12.086 10.6812 11.8223 10.3407 11.8223 9.9207Z" fill="#81001F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8223 13.6433C11.8223 13.2233 12.086 12.8828 12.4114 12.8828H17.8552C18.1806 12.8828 18.4444 13.2233 18.4444 13.6433C18.4444 14.0633 18.1806 14.4038 17.8552 14.4038L12.4114 14.4039C12.086 14.4039 11.8223 14.0634 11.8223 13.6433Z" fill="#81001F"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8223 17.366C11.8223 16.946 12.086 16.6055 12.4114 16.6055H15.4529C15.7783 16.6055 16.0421 16.946 16.0421 17.366C16.0421 17.786 15.7783 18.1265 15.4529 18.1265L12.4114 18.1266C12.086 18.1266 11.8223 17.7861 11.8223 17.366Z" fill="#81001F"/>
                        </g>
                        <path d="M5.42516 5.01948C5.19085 4.78517 4.81095 4.78517 4.57663 5.01948L0.758255 8.83786C0.523941 9.07217 0.523941 9.45207 0.758255 9.68638C0.99257 9.9207 1.37247 9.9207 1.60678 9.68639L5.0009 6.29227L8.39501 9.68639C8.62932 9.9207 9.00922 9.9207 9.24354 9.68639C9.47785 9.45207 9.47785 9.07217 9.24354 8.83786L5.42516 5.01948ZM5.6009 18.1244V5.44374H4.4009V18.1244H5.6009Z" fill="#81001F"/>
                    </svg>

                    <span class="title-kicker">Sort By:</span>
                    <span class="sort-text" id="newsUpdatesSortCurrent">Most recent first</span>

                </a>

                <div class="news-sort-dropdown" id="newsUpdatesSortDropdown">

                    <a href="#" class="news-sort-option is-active" data-sort="newest">
                        Most recent first
                    </a>

                    <a href="#" class="news-sort-option" data-sort="oldest">
                        Older first
                    </a>

                    <a href="#" class="news-sort-option" data-sort="az">
                        Alphabetically (A-Z)
                    </a>

                    <a href="#" class="news-sort-option" data-sort="za">
                        Alphabetically (Z-A)
                    </a>

                </div>

            </div>

            <div class="grid-filter" id="newsUpdatesFilterBox">

                <div class="filter-inputs">

                    <div class="filter-left">

                        <div class="filter-group filter-location">

                            <span>Categories</span>

                            <label><input type="checkbox" name="news_category[]" value="news-updates"> News & Updates</label>
                            <label><input type="checkbox" name="news_category[]" value="amenities"> Amenities</label>
                            <label><input type="checkbox" name="news_category[]" value="lifestyle"> Lifestyle</label>
                            <label><input type="checkbox" name="news_category[]" value="security-connectivity"> Security & Connectivity</label>
                            <label><input type="checkbox" name="news_category[]" value="show-suite"> Show Suite Units</label>
                            <label><input type="checkbox" name="news_category[]" value="wellness"> Wellness</label>

                        </div>

                    </div>

                </div>

                <div class="filter-buttons">

                    <a href="#" id="clearNewsUpdatesFilter" class="standard-btn custom-red custom-red-outline">Clear</a>

                    <a href="#" id="applyNewsUpdatesFilter" class="standard-btn custom-red">Apply Filter</a>

                </div>

            </div>

        </div>

        <?php
        $news_updates_query = new WP_Query(array(
            'post_type'      => 'news-updates',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'ASC',
        ));
        ?>
        <?php if ($news_updates_query->have_posts()) : ?>

            <div class="grid-list" id="newsUpdatesGrid">

                <?php while ($news_updates_query->have_posts()) : $news_updates_query->the_post(); ?>

                    <?php
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

                                    <a href="<?php echo esc_url($permalink); ?>" >
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

                                <a href="<?php echo esc_url($permalink); ?>" class="arrow-link" >

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

                <?php endwhile; ?>

            </div>

        <?php else : ?>

            <div class="grid-list" id="newsUpdatesGrid">
                <p class="no-results">No news and updates found.</p>
            </div>

        <?php endif; ?>

        <div class="news-load-more-wrap" id="newsUpdatesLoadMoreWrap">
            <a href="#" class="standard-btn custom-red" id="newsUpdatesLoadMore">Load More</a>
        </div>

        <?php wp_reset_postdata(); ?>

    </div>

</section>
