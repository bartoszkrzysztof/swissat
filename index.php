<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

	get_header();

	$page_id = get_option( 'page_for_posts' );

// print_r($page_id );

$more_text = "Zobacz więcej";

$section = get_field('standardy', $page_id);
 $img = $section['img'];
 
 $html1 = $section['html1'];
 $html2 = $section['html2'];
 $html3 = $section['html3'];


?>


<section class="p-produkt-title "  style="background-image: url(<?=$img?>);"  > 
   <div class="p-produkt-title-wrap"  >
      <h1><?php single_post_title(); ?> </h1>    
      
          </div> 
      </section>
<section class="blog00" > 


  <div class="container akty">
      
    
<h1 class="title1" style="display:none;"><?php single_post_title(); ?></h1>

	<div class="row kafelki section-list-art-big">

            
              <?php

while ( have_posts() ) : the_post();
        
$post_id = get_the_ID(); 
$title = get_the_title($post_id);
$data =get_the_date( 'j F Y', $post_id);
$link =get_permalink($post_id);
$excerpt =get_the_excerpt($post_id);
$yes=has_post_thumbnail($post_id);
 
echo "<div class='col-md-12 col-lg-12 col-xl-12 box-1'><div class='box'> "; 

if($yes){ echo "<div class='img2'> ". get_the_post_thumbnail($post_id, 'thumbnail') ."</div>";    }

echo "<div class='text'>  
<div class='title'><a href='".$link."'>  ".$title." </a> </div>
<div class='date'> ".$data." </div>
<div class='excerpt'>  ".$excerpt." </div>
<div class='more'>  <a href='".$link."'> ".$more_text." </a> </div>


 </div>";


 

 
  echo "</div>";
    echo "</div>";


 endwhile;

?>
        <div class="col-md-12 pag1 ">     
        <?php 
  global $wp_query;
$total = $wp_query->max_num_pages;
if ( $total > 1 )  {
if ( !$current_page = get_query_var('paged') )
$current_page = 1;
$format = empty( get_option('permalink_structure') ) ? '&page=%#%' : 'page/%#%/';
echo paginate_links(array(
'base' => get_pagenum_link(1) . '%_%',
'format' => $format,
'current' => $current_page,
'total' => $total,
'mid_size' => 4,
'type' => 'list'
));
}          
  ?>     
       </div>
       
       
		</div> </div> 
	</section>


 
<?php get_footer(); ?>
