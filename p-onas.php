<?php
/* Template Name: p-onas */
get_header();
?>

<main class="p-onas pod"> 
    
    
    <?php
$section = get_field('sekcja1');  
 $html1 = $section['html1'];
 
?>

    <section  class="p-onas01"> 
<div class="p-onas01-wrap pod-wrap ">       
    <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500"> 
        
        <?=$html1?>  
        
        </div>     
      
  </div>
        
    </section>
    
    
    
       <?php
$section = get_field('sekcja2');  
 $html2 = $section['html2'];
$img_url = $section['img'];
 
?>
     <section  class="p-onas02"> 
<div class="p-onas02-wrap pod-wrap "> 
    
     <div class="box-a"  style="background-image: url(<?=$img_url?>);" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500">
         
    </div>  
    
    <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" > 
        
         <?=$html2?>
        
        
        </div>     
       
  </div>
        
    </section>
    
    
    
       <?php
$section = get_field('sekcja3');  
 $html3 = $section['html3'];
$img_url3 = $section['img3'];
$text3 = $section['text3'];
 
?>
    
     <section  class="p-onas03"> 
<div class="p-onas03-wrap pod-wrap "> 
    
    
    
    <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800"> 
        
           <?=$html3?> 
        
        </div>  
    
    
     <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" >
            <img alt="image" src="<?=$img_url3?>"> 
         <p class="n4"> <?=$text3?>  </p>
    </div>  
    
    
       
  </div>
        
    </section>
    
    
      <?php
$section = get_field('sekcja4');  
 $html4 = $section['html4'];
$img_url4 = $section['img4'];
$img_url44 = $section['img44'];
$text4 = $section['text4'];
 
?>   
   
    
     <section  class="p-onas04" style="background-image: url(<?=$img_url4?>);" > 
<div class="p-onas04-wrap pod-wrap "> 
    
    
    
    <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800"> 
<h3><?=$text4?> </h3>
        
        
			
        
        </div>  
    
    
     <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">
        <?=$html4?>            		
        
        
        <img class="logo-design" src="<?=$img_url44?>"> 
    </div>  
    
    
       
  </div>
        
    </section>
    

    
    <?php
$section = get_field('sekcja5');  
 $pow = $section['pow'];
 $link5 = $section['link'];
 
?>   
    
     <section  class="p-onas05"  > 
<div class="p-onas05-wrap pod-wrap "> 
        <div class="boxy">  
            
            
             <?php  
          foreach ($pow as $item) {
       $pow_html5 = $item['html5'];  
       $znak = $item['znak'];  
              
              ?> 
            
<div class="box" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">
<img class="img-znak" src="<?=$znak?>"> 
<?=$pow_html5?>                               
    </div>
                        
 <?php   }   ?>   
          
 
        
    </div>
    <?=$link5?>  
   
       
  </div>
        
    </section>
    
    

</main>

 
<?php get_footer(); ?>