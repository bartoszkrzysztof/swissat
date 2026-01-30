<?php
/* Template Name: p-technologie */
get_header();
?>

<main class="p-technologie pod"> 

    <section  class="p-technologie01"> 
<div class="p-technologie01-wrap pod-wrap ">    
     <div class="boxy"> 
         
 <?php
$section = get_field('sekcja1');  
 $html1 = $section['html1'];
 $linkf = $section['linkf'];
 $linkp = $section['linkp'];
 
?>
    
    <div id="tea" class="box-a">  
  <video autoplay="" loop="" muted="" playsinline="">
  <source src="<?=$linkf?>" type="video/mp4">
   </video>
        
        <div class="box-aa">  
            <?= $html1 ?>    
            <?=$linkp?>
     <a href="#teb"> <i class="icon-arrow-down8"></i>  </a>
   
        </div>     
        </div>     
         
          <?php
$section = get_field('sekcja2');  
 $html2 = $section['html2'];
 $linkff = $section['linkff'];
 $linkpp = $section['linkpp'];
 
?>
         
         
    <div id="teb" class="box-b" >      
    <video autoplay="" loop="" muted="" playsinline="">
  <source src="<?=$linkff?>" type="video/mp4">
   </video>
       
        
<div class="box-bb" > 
   <?=$html2?>
     <?=$linkpp?>
     <a href="#tea"> <i class="icon-arrow-up8"></i>  </a>
    </div>    
    </div>    
  </div>
  </div>
        
    </section>
    
    
</main>

 
<?php get_footer(); ?>