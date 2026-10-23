<?php

$carousel_items = [

    [

        'youtube_url' => 'https://www.youtube.com/watch?v=Wc8TrkPBjNQ',

        'thumbnail_url' => 'http://shangproperties.com/wp-content/uploads/2026/04/shang-properties-unveiled.png',

        'sub_text' => 'Shang Properties Unveiled'

    ],

    [

        'youtube_url' => 'https://www.youtube.com/watch?v=Q2ajgZqKXmQ',

        'thumbnail_url' => 'http://shangproperties.com/wp-content/uploads/2026/04/brian-of-aurelia-residence.png',

        'sub_text' => 'With Conceptual Architect Brian Lee. Partner, Skidmore Owings & Merrill, LLP'

    ],

    [

        'youtube_url' => 'https://www.youtube.com/watch?v=39Ca1oJJKgY&t=1s',

        'thumbnail_url' => 'http://shangproperties.com/wp-content/uploads/2026/04/with-francesca-muzio.png',

        'sub_text' => 'With Designer Francesca Muzio. Founder and CEO, FM Architettura D’Interni'

    ],

    [

        'youtube_url' => 'https://www.youtube.com/watch?v=ntH7YoJQg8g',

        'thumbnail_url' => 'http://shangproperties.com/wp-content/uploads/2026/04/bea-valdes-designer.png',

        'sub_text' => 'Bea Valdes, Designer'

    ],

];

?>



<section id="homepageCarousel" class="homepage-carousel">

    <div data-aos="fade-up" data-aos-duration="1500" class="homepage-carousel-contents">

        <div class="heading-text">

            <span class="title-kicker">Featured Video</span>

            <h2>The Shang Experience</h2>

        </div>



        <div class="video-carousel">

            <?php foreach ($carousel_items as $item): ?>

                <div class="carousel-cell">

                    <img class="play-button" src="http://shangproperties.com/wp-content/uploads/2026/04/play-button.png" alt="play-button">

 
                    <?php
                        $attachment_id = attachment_url_to_postid($item['thumbnail_url']);
                        $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

                        // Fallback to sub_text if no alt text is assigned.
                        if (empty($image_alt)) {
                            $image_alt = $item['sub_text'];
                        }
                    ?>

                    <img class="carousel-thumbnail"
                        src="<?php echo esc_url($item['thumbnail_url']); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        data-youtube-url="<?php echo esc_url($item['youtube_url']); ?>" />



                    <p class="carousel-subtext"><?php echo $item['sub_text']; ?></p>

                </div>

            <?php endforeach; ?>

        </div>



    </div>

</section>



<section class="carousel-navigation">

    <div class="carousel-navigation-contents">

        <span class="carousel-status"></span>

        <div class="carousel-buttons"></div>

    </div>

</section>



<!-- Lightbox Modal -->

<div id="video-modal" class="modal">

    <div class="modal-content">

        <span class="close-btn">&times;</span>

        <div id="video-container" class="video-container"></div>

    </div>

</div>
