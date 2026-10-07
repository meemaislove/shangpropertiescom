<?php get_header(); ?>

<?php include get_template_directory() . '/homepage-templates/homepage-banner.php'; ?>

<?php include get_template_directory() . '/homepage-templates/homepage-image-grid.php'; ?>



<?php

$contents = [

    [

        'instance_id' => 'setOne',

        'kicker_text' => 'Exquisite Sense of Space',

        'title' => 'Details by Design',

        'description' => 'Our design philosophy focuses on an uncompromising vision. From the first architectural sketches to the careful selection of interior furnishings to the culmination of our overarching vision, a consistent thread flows through everything, resulting in environments that are both contextual and adaptable.',

        'img_url' => 'http://spi.whitedragontech.com/wp-content/uploads/2026/04/details-by-design.png',

        'alt_text' => 'Details by Design'

    ]

];



foreach ($contents as $item) {

    include get_template_directory() . '/homepage-templates/homepage-split-content.php';
}

?>



<?php

$contents = [

    [

        'instance_id' => 'setTwo',

        'kicker_text' => 'Exemplary Experience',

        'title' => 'Uniquely Personal',

        'description' => 'Carefully crafted to provide only the best, our international expertise and affiliations create a distinct Shang experience for all who visit. As such, we deliver an unprecedented, exclusive opportunity to enjoy a lifestyle no other development can offer.',

        'img_url' => 'http://spi.whitedragontech.com/wp-content/uploads/2026/04/uniquely-personal.png',

        'alt_text' => 'Uniquely Personal'

    ]

];



foreach ($contents as $item) {

    include get_template_directory() . '/homepage-templates/homepage-split-content.php';
}

?>



<?php include get_template_directory() . '/homepage-templates/homepage-featured-projects.php'; ?>



<?php include get_template_directory() . '/homepage-templates/homepage-maps.php'; ?>



<?php include get_template_directory() . '/homepage-templates/homepage-contact.php'; ?>



<?php include get_template_directory() . '/homepage-templates/homepage-carousel.php'; ?>



<?php include get_template_directory() . '/homepage-templates/homepage-years.php'; ?>



<?php include get_template_directory() . '/homepage-templates/homepage-news-updates.php'; ?>



<?php include get_template_directory() . '/homepage-templates/homepage-newsletter.php'; ?>





<?php get_footer(); ?>

<script type='text/javascript'>
    document.addEventListener("DOMContentLoaded", function() {

        var ladom = document.createElement("div");
        ladom.setAttribute("id", "myladom");
        Object.assign(ladom.style, {
            display: "none",
            position: "fixed",
            zIndex: "1",
            left: "0",
            top: "0",
            width: "100%",
            height: "100%",
            overflow: "auto",
            backgroundColor: "rgba(0, 0, 0, 0.5)",
            justifyContent: "center",
            alignItems: "center"
        });
        document.body.appendChild(ladom);

        var ladomContent = document.createElement("div");
        ladomContent.setAttribute("class", "ladom-content");
        Object.assign(ladomContent.style, {
            backgroundColor: "transparent",
            maxWidth: "1250px",
            padding: "25px",
            position: "relative"
        });
        ladom.appendChild(ladomContent);

        var closeSpan = document.createElement("span");
        closeSpan.setAttribute("class", "close");
        closeSpan.innerHTML = "×";
        Object.assign(closeSpan.style, {
            color: "#aaa",
            position: "absolute",
            top: "25px",
            right: "30px",
            fontSize: "28px",
            fontWeight: "bold",
            cursor: "pointer"
        });
        ladomContent.appendChild(closeSpan);

        var ladomLink = document.createElement("a");
        ladomLink.setAttribute("href", "https://www.shangproperties.com/new-developments/");
        ladomLink.setAttribute("target", "_blank");
        ladomContent.appendChild(ladomLink);

        var ladomImage = document.createElement("img");
        ladomImage.setAttribute("src", "https://spi.whitedragontech.com/wp-content/uploads/2026/08/shang-amenities-new.gif");
        Object.assign(ladomImage.style, {
            maxWidth: "100%",
            width: "100%"
        });
        ladomLink.appendChild(ladomImage);

        closeSpan.addEventListener("click", function() {
            ladom.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == ladom) {
                ladom.style.display = "none";
            }
        });

        setTimeout(function() {
            ladom.style.display = "flex";
        }, 5000);
    });
</script>
