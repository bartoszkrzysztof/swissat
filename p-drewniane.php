<?php
/* Template Name: p-drewniane */
get_header();
?>

<main class="p-drewniane pod"> 

   
    
       <?php
$section = get_field('sekcja1');  
 $text1 = $section['text1'];
 $html1 = $section['html1'];
 $linkf = $section['linkf'];
 $linko = $section['linko'];
 
?>
    
 <section  class="p-drewniane01"  > 
<div class="p-drewniane01-wrap pod-wrap "> 


     <div class="boxy"> 
    
         <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800"> 
             
             
             <h1> <?=$text1?> </h1>
             
             
    <div class="video"> 
    <video class="elementor-video" src="<?=$linkf?>" autoplay="" loop="" muted="muted" controlslist="nodownload"></video> </div>
             <?=$html1?>
             
             
        </div>  
    
    
     <div class="box-b" style="background-image: url(<?=$linko?>);" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" >
         
           
    </div>  
         
        </div>     
    
     
  </div>
        
    </section>
     
           <?php
$section = get_field('sekcja2');  
 $img1 = $section['img1'];
 $img2 = $section['img2'];                 
 $text1 = $section['text1'];
 $text2 = $section['text2'];
 $text3 = $section['text3'];
 $text4 = $section['text4'];
 
?>   
    
     <section  class="p-drewniane00"  > 
<div class="p-drewniane00-wrap pod-wrap "> 
    
     <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" >
        <div class="box-aa" >  
   
              <div> <div class="img2"><img src="<?=$img1?>"> </div>  <div class="text">  	
<?=$text1?>
</div>   </div>
                 
               
            
           </div>
              <div class="box-bb" >  

      <div> <div class="img2"><img src="<?=$img2?>"> </div>  <div class="text">  
          <?=$text2?>
     </div>   </div>
            
           </div>
           </div>
    
    
    <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" >
    <div class="box-cc"  > 
        
     <div class="pri"> <h2><?=$text3?></h2><div class="pri-wrap">   
         <?=$text4?>
             
             </div> </div>
        
               </div>
           </div>
        
           </div>
        
    </section>
    
    
    
     <?php
 $section = get_field('sekcja3');  
 $html1 = $section['html1'];
 $pow = $section['pow'];
 
 ?>
  
 <section  class="p-drewniane02"    > 
<div class="p-drewniane02-wrap pod-wrap ">  
 <?=$html1?>
    
     <div class="boxy"> 
    
  <ul>
      
       <?php  
     foreach ($pow as $item) {
       $html11 = $item['html11'];  
       $img22 = $item['img22'];   
      ?> 
      
       <li> <div class="znak2"><img src="/wp-content/uploads/2026/01/giphy.gif"> </div>
<div class="text"><?=$html11?></div><div class="img2"><img src="<?=$img22?>"></div></li>
                                                          
 <?php   }   ?> 
  
           
  </ul>
    </div>     
      </div>
        
    </section>
    
    
    
   <?php
 $section = get_field('sekcja4');  
 $name = $section['name'];
 $html1 = $section['html1'];
 $img1 = $section['img1'];
 $img2 = $section['img2'];
 $img3 = $section['img3'];
 $img4 = $section['img4'];
 $img5 = $section['img5'];
    
 $link1 = $section['link1'];
 $link2 = $section['link2'];
  
 ?>
    

      <section  class="p-drewniane03"> 
<div class="p-drewniane03-wrap pod-wrap ">
    
     <h2 data-aos="zoom-in" data-aos-offset="200" data-aos-duration="500"><?=$name?></h2>
    
    <div class="boxy" > 
            
    <div class="box-a" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800">   
        
         <div class="box-aa"> 
    	<img alt="step1" src="<?=$img2?>">
    	<img alt="step2" src="<?=$img3?>">
    	<img alt="step3" src="<?=$img4?>">
    	<img alt="step4" src="<?=$img5?>">    
        </div> 
        
        </div>  
    
    
     <div class="box-b" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" >
        <?=$html1?>
            </div>  
         
 <div class="box-c" data-aos="zoom-in" data-aos-offset="200" data-aos-duration="800" >
     <img alt="icon home" src="<?=$img1?>">
         
           
    </div>  
        
        
    </div>  
    
    
       
  </div>
        
    </section>
    
    
    
    
      
  
 <section  class="p-przekierowania"  > 
<div class="p-przekierowania-wrap pod-wrap "> 

<?=$link1?>
<?=$link2?>
  
     
  </div>
        
    </section>
    
    
    
    
    
    
</main>

 
<?php get_footer(); ?>