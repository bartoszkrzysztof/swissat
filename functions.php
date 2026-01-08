<?php



if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main-menu'   => 'Header Menu',			
			'lang-menu'   => 'Lang Menu',			
			'footer-menu' => 'Footer Menu',
		)
	);
}


 

 


function scripts_loader() {
	$theme_version = wp_get_theme()->get( 'Version' );

 $randNum = rand (11, 999);  

	// 1. Styles
 wp_enqueue_style( 'style-bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', false, $theme_version, 'all' );
   wp_enqueue_style( 'style-font-icomoon', get_template_directory_uri() . '/assets/icons/icomoon/styles.css', false, $theme_version, 'all' );
 // wp_enqueue_style( 'style-splide', get_template_directory_uri() . '/assets/splide/splide.min.css', false, $theme_version, 'all' );
 wp_enqueue_style( 'style-aos', get_template_directory_uri() . '/assets/aos/aos.css', false, $theme_version, 'all' );
 wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', false, $theme_version, 'all' );
 wp_enqueue_style( 'style-custom', get_template_directory_uri() . '/assets/css/custom.css', false, $theme_version, 'all' );
 wp_enqueue_style( 'style-custom1', get_template_directory_uri() . '/assets/css/custom1.css', false, $theme_version, 'all' );

   
	// 2. Scripts
    
    
    wp_enqueue_script( 'Jquery35', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', array( 'jquery' ), $theme_version, true );
        
	wp_enqueue_script( 'mainjs', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), $theme_version, true );
    
	wp_enqueue_script( 'aosjs', get_template_directory_uri() . '/assets/aos/aos.js', array( 'jquery' ), $theme_version, true );
    
	wp_enqueue_script( 'customjs', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_script( 'customjs1', get_template_directory_uri() . '/assets/js/custom1.js', array( 'jquery' ), $theme_version, true );

}
add_action( 'wp_enqueue_scripts', 'scripts_loader' );




if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Opcje motywu',
        'menu_title' => 'Opcje motywu',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}




    function new_excerpt_more($more) {
    global $post;
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


    function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );




/**
 * WordPress Breadcrumbs
 */


function getMenuItems($menuName)
{
    $menuLocations = get_nav_menu_locations();
    $menuID = $menuLocations[$menuName];
    return wp_get_nav_menu_items($menuID);
}



add_theme_support( 'post-thumbnails' ); 



add_action('after_setup_theme', 'load_lang');
function load_lang(){
  load_theme_textdomain('wwwmotyw', get_template_directory() . '/languages');
}

if(function_exists('pll_current_language')){
add_action('init', function() {
    
  pll_register_string('cofnij', 'Cofnij');
  pll_register_string('wyszukaj', 'Wyszukaj');
  pll_register_string('szukaj', 'Szukaj');
  pll_register_string('info-link-404', 'Przejdź do strony głównej');
  pll_register_string('info-404', 'Coś poszło nie tak, nie znaleźliśmy strony o którą Ci chodzi');
  pll_register_string('info-500', 'Serwer chwilowo nie odpowiada');
  pll_register_string('brak-wynikow', 'Brak wyników dla tej frazy');
  pll_register_string('wysz-fraze', 'Wyszukiwano frazę');
  pll_register_string('more', 'więcej');
  pll_register_string('wpisz', 'Wpisz szukaną frazę');
    
});
}
 

function logo_setup(){

  // Własne logo w motywie
  add_theme_support( 'custom-logo', array(
    'height'      => 250, // wysokość logo
    'width'       => 500, // szerokość logo
    'flex-height' => false, // czy wysokość ma być elastyczna
    'flex-width'  => true, // czy szerokość ma być elastyczna
  ) );

}
add_action('after_setup_theme', 'logo_setup');




function my_dequeue_block_library_styles() {
    wp_dequeue_style( 'wp-block-library' );   
}
add_action( 'wp_enqueue_scripts', 'my_dequeue_block_library_styles' );


add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'wp-emoji-styles' );
});



add_action("admin_head", "my_custom_styles");
function my_custom_styles() {
echo "<style> 
#adminmenu .update-plugins {display:none!important; }
.site-health-counter {display:none!important; }
tr#advanced-custom-fields-pro-update { display:none!important; }
</style>";
}



