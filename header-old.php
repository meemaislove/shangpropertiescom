<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(); ?></title>
  <?php include('stylesheet-manager.php'); ?>
  <?php wp_head(); ?>
  
</head>
<body <?php body_class(); ?>>
<header>
  <nav class="navbar navbar-expand-xl navbar-dark">
      <div class="container-fluid">
        <div class="offset-md-1 col-md-10">
          <div class="d-flex nav-container">
            <a class="navbar-brand" href="<?php echo get_home_url(); ?>/"><img src="#" alt=" Logo"/></a>
            <button class="navbar-toggler btn-burger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <?php 
                  // yung mga class dito sa loob depende sa deisng  yan
                  wp_nav_menu(array('Primary Menu' => 'Primary','menu_class' => 'navMenu navbar-nav me-auto mb-2 mb-lg-0','container' => false,));
                ?>
            </div>
          </div>
        </div>
      </div>
    </nav>
</header>