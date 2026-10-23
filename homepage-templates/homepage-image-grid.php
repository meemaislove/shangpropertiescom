<?php $grid_items = [

    [

        'image_url'   => 'http://shangproperties.com/wp-content/uploads/2026/04/residential.png',

        'title'       => 'Residential',

        'description' => 'More than a place to call home, it is the warmth and comforting experience that is waiting to be unfolded. Our residences is a unique integration of elegant style and contemporary detail that intrigues and amuses at every turn.',

        'card_link'   => 'https://shangproperties.com/businesses/residential/',

        ],

    [

        'image_url'   => 'http://shangproperties.com/wp-content/uploads/2026/04/malls.png',

        'title'       => 'Malls',

        'description' => 'A haven of creative and upscale spaces where you can relax, work, and play. We offer a selection of diverse, carefully curated, and emerging shopping and dining hot spots featuring only the best international and local brands pulsing with style and energy to suit every lifestyle.',

        'card_link'   => 'https://shangproperties.com/businesses/malls/',

        ],

    [

        'image_url'   => 'http://shangproperties.com/wp-content/uploads/2026/04/offices.png',

        'title'       => 'Offices',

        'description' => 'Discover the perfect workplace offering a range of refined amenities in highly prestigious business locations at  a Shang office building near you.',

        'card_link'   => 'https://shangproperties.com/businesses/office/',

        ],

    [

        'image_url'   => 'http://shangproperties.com/wp-content/uploads/2026/04/property-management-office.png',

        'title'       => 'Property Management Office',

        'description' => 'Luxury and convenience are at your fingertips in every Shang property. Enjoy exceptional amenities and world-class services from our expertly-trained staff.',

        'card_link'   => 'https://shangproperties.com/businesses/property-management/',

        ],

    [

        'image_url'   => 'http://shangproperties.com/wp-content/uploads/2026/04/hotels-serviced-apartments.png',

        'title'       => 'Hotels & Serviced Apartments',

        'description' => 'Relax and discover the city’s dynamic energy by staying in our signature hotels & serviced apartments offering spacious rooms with stunning views of the ever-evolving Manila skyline. We provide you  both a soothing and stylish stay for your on-the-go lifestyle.',

        'card_link'   => 'https://shangproperties.com/businesses/hospitality/',

        ]

];



?>



<section class="homepage-image-grid">

    <div class="homepage-image-grid-contents">

        <div data-aos="fade-up" data-aos-duration="1500" class="heading-text">

            <span class="title-kicker">Our business units</span>

            <h2>Exemplary Living</h2>

            <p>Experience luxurious living arrangements in prime locations. Sophisticated settings meet the conveniences of modern living to give you unmatched comfort.</p>

        </div>

        <div class="image-grid-items">

            <?php foreach ($grid_items as $item): ?>

                <?php
                $image_url = $item['image_url'];
                $image_id = attachment_url_to_postid($image_url);

                $image_alt = '';

                if ($image_id) {
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                }

                if (empty($image_alt)) {
                    $image_alt = $item['alt_text'] ?? $item['title'] ?? '';
                }
                ?>

                <a href="<?php echo esc_url($item['card_link']); ?>" class="image-grid-item" target="_blank">

                    <div data-aos="fade-up" data-aos-duration="1500" class="image-content">
                        <img
                            src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr($image_alt); ?>"
                        >

                        <div class="text-content">
                            <h3><?php echo esc_html($item['title']); ?></h3>
                            <p><?php echo esc_html($item['description']); ?></p>
                        </div>
                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    </div>

</section>
