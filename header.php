<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS are enqueued -->

    <?php wp_head(); ?>

    <link
        rel="preload"
        as="image"
        href="http://shangproperties.com/wp-content/uploads/2026/04/homepage-banner-bg.png"
        fetchpriority="high"
    >



</head>



<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php include get_template_directory() . '/homepage-templates/nav-main.php'; ?>