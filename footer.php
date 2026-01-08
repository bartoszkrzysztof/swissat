
<footer id="sf" class="footer secc">   
 
    <?php 
    $footer = get_field('footer-info', 'option');   
    $ffooter = get_field('footer-copyright', 'option');   
    
 $fhtml1 = $footer['html1'];
 $fhtml2 = $footer['html2'];
 $fhtmlm = $footer['htmlm'];
    
 $ffhtml1 = $ffooter['html1'];
 $ffhtml2 = $ffooter['html2'];
 
 
        
    ?>
        
    <div class="footer-info" > 
    <div class="footer-info-wrap" > 

         <div class="boxy"> 
    <div class="box-a">         
   <h4>Swissat Family: Tam, gdzie należysz.</h4>	
<p>Nasza społeczność to serce każdego projektu.<br>Dołącz do społeczności liderów w budownictwie.<br></p>
<h5>KONTAKTY</h5>		
<p><br><strong>Dział Budowy Domów i Budynków Wielorodzinnych</strong><br>twojdom@swissatgroup.com<br></p>

<p><strong>Dział Księgowości</strong><br>invoice@swissatgroup.com<br></p>

<p><strong>Dział Sprzedaży Materiałów Budowlanych</strong><br>office@swissatgroup.com<br></p>

<p><strong>Dział Generalnego Wykonawcy</strong><br>timothy@swissatgroup.com</p>			

<h6>Swissat<br>Poland</h6>	

<p><em>Ulica długa 55,<br>85-034 Bydgoszcz<br>NIP: PL5542998517</em></p>	
        
      </div>
             
 
             
     <div class="box-b"> 
         
   <h5>TELEFON</h5>	
<p><a class="link-tel" href="tel:+48880858727">+48 880858727</a></p>	
<h5>SOCIAL</h5>		
<a class="link-f" href="https://www.facebook.com/Swissatdesigns"><i aria-hidden="true" class="icon-facebook"></i></a>


<h6>Swissat<br>Deutschland</h6>		
			
      <p><em>Robert-Mayer-Strasse 34<br>60486 Frankfurt am Main<br>ID: DE286765385</em></p>
         
      </div>
             
 <div class="box-c">  
<div class="gallery-footer"> 
 <h6>Zobacz naszą galerię</h6>	
    
  <?php 
$img1=423;
$img2=424;
$img3=425;
$img4=426;

if(!empty($img1)){ echo wp_get_attachment_image($img1,'thumbnail');  }
if(!empty($img2)){ echo wp_get_attachment_image($img2,'thumbnail');  }
if(!empty($img3)){ echo wp_get_attachment_image($img3,'thumbnail');  }
if(!empty($img4)){ echo wp_get_attachment_image($img4,'thumbnail');  }
             
             
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
