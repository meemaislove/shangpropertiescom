<?php

/* Template Name: Residentials Single Template */

get_header();



if ( function_exists('have_rows') && have_rows('about_inside') ) :



    while ( have_rows('about_inside') ) : the_row();



        // Ensure layout key -> safe filename

        // This should match your ACF flexible content layout "Name"

        $layout = sanitize_key( get_row_layout() );



        // Support parent/child themes

        $template_path = locate_template( "inside-templates/{$layout}.php", false, false );



        if ( $template_path ) {

            // Inside each layout partial you can use get_sub_field() as usual

            include $template_path;

        } else {

            echo "<!-- Missing layout file: inside-templates/{$layout}.php -->";

        }



    endwhile;



else :

    echo "<!-- No rows in about_inside -->";

endif;



get_footer();
