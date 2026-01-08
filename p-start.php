<?php
/* Template Name: p-start */
get_header();
?>

<main> 
<?php
 $section = get_field('start');  
 $imgbc = $section['img'];
 $text = $section['text'];
     ?>

<section  class="start" style="background-image: url();"> 
 <video autoplay="" loop="" muted="" playsinline="">
  <source src="./wp-content/uploads/2026/01/film.mov" type="video/mp4">
   </video>
             
    

<div class="start-wrap">  
 <div class="start-box" >
    
<div class="start-text" data-aos="zoom-in" data-aos-offset="100" data-aos-duration="600" >
 <div class="biglogo"> <img src="https://test62.redgrafik.pl/wp-content/uploads/2026/01/cropped-logo.png"></div>
<div class="start-link">  <a href="#"> HURTOWNIA </a>   <a href="/home/"> BUDOWNICTWO  </a>   </div>

     
    </div>  
  
    </div>
    </div>

</section>

 


</main>

 
<?php get_footer(); ?>