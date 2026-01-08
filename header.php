<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
 

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
<title><?php bloginfo( 'name' ); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" >

    <?php wp_head(); ?>
    
 
</head>

<body <?php body_class(); ?>>
    
   
 
<?php wp_body_open(); ?>

<div id="wrapper">
 
     
  
    <header>   
        <div class="header-wrap">                  
     <div class="header-wrap02">     
        <nav class="navbar navbar-expand-lg" aria-label="navbar example"> <div class="logo"><?php the_custom_logo(); ?></div> 
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation"><div class="linia"></div> <div class="linia"></div> <div class="linia"></div></button> 
            
           
            <div class="navbar-collapse collapse" id="navbarsExample05" style="">
                
               <?php
  wp_nav_menu(array(
    'theme_location' => 'main-menu',
    'menu_class' => 'navbar-nav',
    'menu_id' => 'primary-menu',
    'fallback_cb' => 'my_custom_fallback_menu',
    'depth' => 2,
    'echo' =>true,
  ));
?>
               
            </div> 
        
        </nav>
         </div>    
            
            
          </div> 
 
     </header>