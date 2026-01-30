

<div class="lann"> <div class="lann-wrap"> 
<?php
$languages = pll_the_languages(['raw' => 1]);

echo '<ul class="lang-switcher">';

foreach ($languages as $lang) {
    if ( ! $lang['current_lang'] ) {
        echo '<li>';
        echo '<a href="' . esc_url($lang['url']) . '">';
        echo '<img src="/wp-content/uploads/polylang/flags/' . $lang['slug'] . '.svg">';
        echo '</a>';
        echo '</li>';
    }
}

echo '</ul>';
?>
</div> 
</div> 


    <?php 
    $footer = get_field('footer-info', 'option');   
    $ffooter = get_field('footer-copyright', 'option');   
    
 
 $t1 = $footer['t1'];
 $t2 = $footer['t2'];
 $t3 = $footer['t3'];
 $fgal = $footer['fgal'];
    
 $ffhtml1 = $ffooter['html1'];
 $ffhtml2 = $ffooter['html2'];
 $infom = $ffooter['infom'];
       
    ?>


<div class="blin"> 
     <a href="https://m.me/Swissatdesigns?ref=Kontakt%20ze%20strony%20www"      
        target="_blank"  data-bs-toggle="tooltip"   data-bs-placement="top"
   title="<?=$infom?>"><i class="icon-bubble"></i></a>  
</div>

<footer id="sf" class="footer secc">   
 

        
    <div class="footer-info" > 
    <div class="footer-info-wrap" > 

 <div class="boxy"> 
    <div class="box-a">         
   <?=$t1 ?>
      </div>
             
 
             
     <div class="box-b"> 
 <?=$t2 ?>         
      </div>
             
 <div class="box-c">  
<div class="gallery-footer"> 
    <?=$t3 ?>
    
  <?php 
 foreach ($fgal as $imgid) {       
  if(!empty($imgid)){ echo wp_get_attachment_image($imgid,'thumbnail');  }
 }
              
 ?>
              </div> 
             
                 </div>
        
      </div>
      </div>
      </div>
    
    
       <div class="footer-copyright" > 
  
           <div class="footer-copyright-wrap" > <?=$ffhtml1 ?> <?=$ffhtml2 ?>
    
    </div> 
    </div>  
    
    
</footer> 
</div>



<?php wp_footer(); ?>




</body>

</html>
