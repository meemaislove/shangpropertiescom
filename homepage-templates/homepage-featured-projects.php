<?php
if (!function_exists('spi_get_image_alt_by_url')) {
    function spi_get_image_alt_by_url($image_url, $fallback = '')
    {
        $image_id = attachment_url_to_postid($image_url);

        if ($image_id) {
            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

            if (!empty($image_alt)) {
                return $image_alt;
            }
        }

        return $fallback;
    }
}

$bauhinia_web_url    = 'http://shangproperties.com/wp-content/uploads/2026/10/Shang-Bauhinia.png';
$bauhinia_mobile_url = 'http://shangproperties.com/wp-content/uploads/2026/04/featured-bauhinia-cropped.png';

$summit_web_url    = 'http://shangproperties.com/wp-content/uploads/2026/10/Shang-Summit.png';
$summit_mobile_url = 'http://shangproperties.com/wp-content/uploads/2026/04/featured-summit-cropped.png';

$laya_web_url    = 'http://shangproperties.com/wp-content/uploads/2026/10/Laya.png';
$laya_mobile_url = 'http://shangproperties.com/wp-content/uploads/2026/04/featured-laya-cropped.png';
?>

<section class="homepage-featured-projects">

    <div data-aos="fade-up" data-aos-duration="1500" class="homepage-featured-projects-contents">

        <div class="heading-text">

            <span class="title-kicker">Featured Projects</span>

            <h2>Properties on the Rise</h2>

            <p>Take a look at some of our properties in greater detail.</p>

            <a href="https://shangproperties.com/businesses/residential/" class="standard-btn custom-red red-text">Explore Projects</a>

        </div>

        <div class="featured-projects">

            <a href="https://shangproperties.com/residentials/shang-bauhinia-residences/" class="project-card" id="shangBauhiniaCard" target="_blank">

                <img
                    src="<?php echo esc_url($bauhinia_web_url); ?>"
                    class="web-only"
                    alt="<?php echo esc_attr(spi_get_image_alt_by_url($bauhinia_web_url, 'Shang Bauhinia')); ?>"
                >

                <img
                    src="<?php echo esc_url($bauhinia_mobile_url); ?>"
                    class="mobile-only"
                    alt="<?php echo esc_attr(spi_get_image_alt_by_url($bauhinia_mobile_url, 'Shang Bauhinia')); ?>"
                >

                <div class="text-content">

                    <span class="title-kicker">Residential</span>

                    <h3>Shang Bauhinia Residences</h3>

                </div>

            </a>

            <a href="https://shangproperties.com/residentials/shang-summit/ " class="project-card" id="shangSummitCard" target="_blank">

                <img
                    src="<?php echo esc_url($summit_web_url); ?>"
                    class="web-only"
                    alt="<?php echo esc_attr(spi_get_image_alt_by_url($summit_web_url, 'Shang Summit')); ?>"
                >

                <img
                    src="<?php echo esc_url($summit_mobile_url); ?>"
                    class="mobile-only"
                    alt="<?php echo esc_attr(spi_get_image_alt_by_url($summit_mobile_url, 'Shang Summit')); ?>"
                >

                <div class="text-content">

                    <span class="title-kicker">Residential</span>

                    <h3>Shang Summit</h3>

                </div>

            </a>

            <a href="https://shangproperties.com/residentials/laya-by-shang-properties/" class="project-card" id="shangLayaCard" target="_blank">

                <img
                    src="<?php echo esc_url($laya_web_url); ?>"
                    class="web-only"
                    alt="<?php echo esc_attr(spi_get_image_alt_by_url($laya_web_url, 'Shang Laya')); ?>"
                >

                <img
                    src="<?php echo esc_url($laya_mobile_url); ?>"
                    class="mobile-only"
                    alt="<?php echo esc_attr(spi_get_image_alt_by_url($laya_mobile_url, 'Shang Laya')); ?>"
                >

                <div class="text-content">

                    <span class="title-kicker">Residential</span>

                    <h3>Laya by Shang Properties</h3>

                </div>

            </a>

        </div>

    </div>

</section>
