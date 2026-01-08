<?php
/**
 * The Template for displaying all single posts.
 */

	get_header();
?>



<section class="blog00-post" > 
<div class="blog-post w1366">

    
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
  
 echo "<article id='post-";
the_ID();
echo "'";
post_class();
echo ">";
    
    
  ?>  
    
    <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>           
 
    
    <section class="p-produkt-title "  style="background-image: url(<?=$thumb?>);"  > 
   <div class="p-produkt-title-wrap"  >
      <h1><?php the_title(); ?> </h1>    
      
          </div> 
      </section>
    
   <?php 
      echo "<div class='row'>";

 echo "<div class='entry-content col-md-12'>";
 echo "<div class='entry-title'>";
   the_title(); 
 echo "</div>";    
    echo "<div class='data'>";
   // the_time( 'F j Y' );  
   // the_time( 'd.m.Y' ); 
    the_time( 'j F Y' ); 

    echo "</div>";
    
echo "</a>";

    echo "<div class='tresc'>";
    
    the_content();   

echo "</div>";
echo "</div>";
echo "</div>";
	echo "</article>";

 			
  endwhile;
        ?>
  
    
    
</div>
</section>




<?php get_footer(); ?>
