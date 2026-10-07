<section class="residentials-grid custom-grid">

    <div class="residentials-grid-contents">

        <?php
        $custom_properties = get_sub_field('custom_properties');

        $post_ids = array_filter(array_map('intval', explode(',', $custom_properties)));

        $residentials_query = new WP_Query(array(
            'post_type'      => 'residentials',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'post__in'       => !empty($post_ids) ? $post_ids : array(0),
            'orderby'        => 'post__in',
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


                            <span class="title-kicker">Residential</span>
                            <h3><a href="<?php echo esc_url($permalink); ?>" target="_blank"><?php echo esc_html($title); ?></a></h3>



                            <?php if ($preview_text) : ?>

                                <div class="preview-text">

                                    <?php echo wp_kses_post($preview_text); ?>

                                </div>

                            <?php endif; ?>

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
