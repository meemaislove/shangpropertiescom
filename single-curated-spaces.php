<?php
/**
 * Single template for Curated Spaces CPT
 */

$template_path = get_stylesheet_directory() . '/about-inside-template.php';

if (file_exists($template_path)) {
    include $template_path;
    return;
}

get_header();
?>

<main>
    <p>Template file not found.</p>
</main>

<?php get_footer(); ?>
