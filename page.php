<?php
get_header();

?>


<main class="main pod">
        
      
        
  <section class="section-title" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="300"> 
<div class="section-title-wrap"> 
 <h1>  <?php the_title(); ?> </h1>
     </div>
</section>
        
   <section class="section-content" data-aos="zoom-in" data-aos-offset="100" data-aos-duration="200"> 
<div class="section-content-wrap"> 
     <div class="page-html">
     <?php the_content(); ?>
     </div>
     </div>
</section>
        
  
    </main>

<?php get_footer(); ?>