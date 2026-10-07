<section class="residentials-grid">

    <div data-aos="fade-up" data-aos-duration="1500" class="residentials-grid-contents">

        <div class="grid-title">

            <!-- <h2>Residential Spaces</h2> -->



            <div class="filter-button-container">

                <a href="#" class="filter-btn" id="residentialsFilter">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                        <path d="M20 5H4L10.4 13.4089V19.2222L13.6 21V13.4089L20 5Z" stroke="#81001F" stroke-linecap="round" stroke-linejoin="round"></path>

                    </svg>



                    <span>Filter</span>



                    <svg class="filter-chevron" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                        <path d="M15 6L9 12L15 18" stroke="#81001F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>

                    </svg>

                </a>

            </div>



            <div class="grid-filter" id="residentialsFilterBox">



                <div class="filter-inputs">



                    <div class="filter-left">

                        <div class="filter-group filter-location">

                            <span>Location</span>



                            <label><input type="checkbox" name="location[]" value="cebu-city"> Cebu City</label>

                            <label><input type="checkbox" name="location[]" value="makati-city"> Makati City</label>

                            <label><input type="checkbox" name="location[]" value="mandaluyong-city"> Mandaluyong City</label>

                            <label><input type="checkbox" name="location[]" value="pasig-city"> Pasig City</label>

                            <label><input type="checkbox" name="location[]" value="quezon-city"> Quezon City</label>

                            <label><input type="checkbox" name="location[]" value="taguig-city"> Taguig City</label>

                        </div>

                    </div>



                    <div class="filter-right">

                        <div class="filter-group filter-property-type">

                            <span>Property Type</span>

                            <div class="filter-list">

                                <label><input type="radio" name="property_type" value="default-type" checked> All Properties</label>

                                <label><input type="radio" name="property_type" value="pre-selling"> Pre-Selling</label>

                                <label><input type="radio" name="property_type" value="ready-for-occupancy"> Ready for Occupancy</label>

                            </div>

                        </div>



                        <div class="filter-group filter-property-status">

                            <span>Property Status</span>

                            <div class="filter-list">

                                <label><input type="radio" name="property_status" value="default-status" checked> All Properties</label>

                                <label><input type="radio" name="property_status" value="for-sale"> For Sale</label>

                                <label><input type="radio" name="property_status" value="for-lease"> For Lease</label>

                            </div>

                        </div>

                    </div>



                </div>



                <div class="filter-buttons">

                    <a href="/" id="clearButton" class="standard-btn custom-red custom-red-outline">Clear</a>

                    <a href="/" id="applyFilter" class="standard-btn custom-red">Apply Filter</a>

                </div>



            </div>





        </div>



        <?php

        $residentials_query = new WP_Query(array(
            'post_type'      => 'residentials',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'post__not_in'   => array(752, 756),
            'orderby'        => 'date',
            'order'          => 'ASC',
        ));

        ?>



        <?php if ($residentials_query->have_posts()) : ?>

            <div class="grid-list" id="residentialsGrid">



                <?php while ($residentials_query->have_posts()) : $residentials_query->the_post(); ?>

                    <?php

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

            <p>No residential spaces found.</p>

        <?php endif; ?>



        <?php wp_reset_postdata(); ?>

    </div>

</section>
