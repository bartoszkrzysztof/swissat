<?php
/* Template Name: p-home */
get_header();
?>

<main> 

  

<?php
$section = get_field('sekcja1');  
 $name = $section['name'];
 $name2 = $section['name2'];
 $html1 = $section['html1'];
 $img1= $section['img'];
?>
<section class="section01"> 
<div class="section01-wrap"> 
      <h2 data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500"><?=$name?></h2>
    <div class="boxy">   
        
   <div class="box3" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">
            <?php 
$img1=423;
echo wp_get_attachment_image($img1, 'full') ?>          
              
    </div>
        
        
      <div class="box2" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">      
       <?=$html1?>             
        
    </div>
   
        
    </div>
    </div>
</section>

    

    
    
    
    
    


</main>

 
<?php get_footer(); ?>