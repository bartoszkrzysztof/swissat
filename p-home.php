<?php
/* Template Name: p-home */
get_header();
?>

<main> 

  

<?php
$section = get_field('sekcja1');  
 $html1 = $section['html1'];
 
?>
<section class="section01"> 
<div class="section01-wrap"> 
    
    <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500">
<?= $html1 ?>
         
    </div> 
    <div class="box-b">  </div> 
    
     </div>
</section>

    

    
 <?php
$section = get_field('sekcja2');  
 $html2 = $section['html2'];
 $pow = $section['pow'];
 
?>   
 
<section id="oferta" class="section02"> 
<div  class="section02-wrap"> 
     
    <div class="bigbox" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">
        <?= $html2 ?>
                           
    </div>
 
    <div class="boxy">  
        
        <?php  
          foreach ($pow as $item) {
       $pow_html = $item['html'];  
              
              ?>
     <div class="box" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800"><?=$pow_html?></div> 
        
   <?php   }   ?>

         
    </div>
    
    </div>
</section>
    
    
  <?php
$section = get_field('sekcja3');  
 $img_url = $section['img'];
 $pow = $section['pow'];
 
?>      

<section class="section03"> 
<div class="section03-wrap"> 
    
    <div class="box-a" style="background-image: url(<?=$img_url?>);" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500">
       
    
    </div> 
    <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500" > 
        
    <?php  
          foreach ($pow as $item) {
       $pow_html = $item['html'];  
        ?>
    <?=$pow_html?>        
   <?php   }   ?>
        
   
    </div> 
    
     </div>
</section>
    
    
      <?php
$section = get_field('sekcja4');  
 $html4 = $section['html4'];
 $pow = $section['pow'];
 
?>     
    
    <section class="section04" style="background-image: url(/wp-content/uploads/2026/01/bg3.jpg);" > 
<div class="section04-wrap"  > 
    
    <div class="box-a" id="sli" style="background-image: url(/wp-content/uploads/2026/01/c1.jpg);" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500">
       
    
    </div> 
    <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500"> 
        
        <?=$html4?>            
    
    </div> 
    
     </div>
</section>
    

</main>

 
<?php get_footer(); ?>