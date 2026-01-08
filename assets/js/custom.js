
 $(document).ready(function() {  
              
     $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $("header").addClass("mi");
    } else {
        $("header").removeClass("mi");
    }
});
     
  
     
     $('li.menu-item-has-children > a').on('click', function(e) {
    e.preventDefault(); // Zapobiega domyślnemu zachowaniu linku
 $(this).parent().toggleClass('act');  
   });
     
     
$('.p-kontakt01-boxy > .p-kontakt01-box').first().addClass('act'); 

$('.p-kontakt01-boxy > .p-kontakt01-box h3').on('click', function(e) {
    e.preventDefault(); 
 $('.p-kontakt01-boxy > .p-kontakt01-box').removeClass('act');
 $(this).parent().addClass('act');  

   });
     
     
     
}); 


 AOS.init();
      
         