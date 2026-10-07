<section class="homepage-news-updates">

    <div data-aos="fade-up" data-aos-duration="1500" class="homepage-news-updates-contents">

        <div class="heading-content">

            <div class="text-content">

                <span class="title-kicker">News & Updates</span>

                <h2>The Press Room</h2>

                <p>Get the latest Shang updates and news.</p>

            </div>

            <div class="heading-cta">

                <a href="https://spi.whitedragontech.com/news-updates/" class="standard-btn custom-red red-text">View All News & Updates</a>

            </div>

        </div>



        <div class="news-updates-grid">

            <?php

            $args = array(
                'post_type'      => 'news-updates',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :

                while ($news_query->have_posts()) : $news_query->the_post();

                    $publish_date = get_field('publish_date', $post_id);

                    if (empty($publish_date)) {
                        $publish_date = get_the_date('F j, Y', $post_id);
                    }

                    $preview_text = get_field('preview_text');
                    $featured_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $title        = get_the_title();
                    $permalink    = get_permalink();


                    $featured_img_id  = get_post_thumbnail_id(get_the_ID());
                    $featured_img_alt = get_post_meta($featured_img_id, '_wp_attachment_image_alt', true);

            ?>

                <div class="news-update-item">

                    <a href="<?php echo esc_url($permalink); ?>" class="item-heading" target="_blank" rel="noopener noreferrer">

                        <div class="item-image">

                            <?php if ($featured_img) : ?>

                                <img src="<?php echo esc_url($featured_img); ?>" alt="<?php echo esc_attr($featured_img_alt); ?>"">

                            <?php endif; ?>

                        </div>

                        <div class="item-text">

                            <span class="title-kicker">News &amp; Updates</span>

                            <h3><?php echo esc_html($title); ?></h3>

                            <?php //echo $preview_text; ?>

                        </div>

                        <div class="item-cta">

                            <span><?php echo esc_html($publish_date); ?></span>

                            <div class="arrow-cta">

                                <a href="<?php echo esc_url($permalink); ?>" class="arrow-link" target="_blank">Read More

                                    <svg width="41" height="11" viewBox="0 0 41 11" xmlns="http://www.w3.org/2000/svg">

                                        <g transform="translate(41, 11) rotate(180)">

                                            <path d="M40.2945 4.62654C39.5818 4.62654 4.41173 4.62654 4.41173 4.62654L5.99177 3.06676C6.49687 2.56405 5.88876 1.96483 5.38605 1.45973C4.88334 0.954573 4.67635 0.734958 4.17125 1.2376L0.375731 5.00228C-0.129237 5.50621 -0.13085 6.32583 0.374441 6.83021L4.16693 10.5902C4.67196 11.0927 4.88327 10.9292 5.38605 10.424C5.88876 9.91885 6.49255 9.2637 5.98745 8.76099L4.41173 7.20718H40.2945C41.0071 7.20718 40.8766 6.62651 40.8766 5.91387C40.8766 5.20122 41.0071 4.62654 40.2945 4.62654Z" fill="currentColor" fill-opacity="1.0"/>

                                        </g>

                                    </svg>

                                </a>

                            </div>

                        </div>

                    </a>

                </div>

            <?php

                endwhile;

                wp_reset_postdata();

            endif;

            ?>

        </div>



    </div>

</section>
