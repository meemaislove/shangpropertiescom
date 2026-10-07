<?php
$file_name = get_sub_field('file_name');

if (!empty($file_name)) {
    $template_path = get_stylesheet_directory() . '/hardcode-templates/' . basename($file_name);

    if (file_exists($template_path)) {
        include $template_path;
    }
}
?>
