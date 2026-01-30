
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
     
     
      var images = [
        "/wp-content/uploads/2026/01/c1.jpg",
        "/wp-content/uploads/2026/01/c2.jpg",
        "/wp-content/uploads/2026/01/c3.jpg",
        "/wp-content/uploads/2026/01/c4.jpg",
        "/wp-content/uploads/2026/01/c5.jpg"       
    ];

    var index = 0;

    setInterval(function () {
        index = (index + 1) % images.length;

        $("#sli").css("background-image", "url(" + images[index] + ")");
    }, 2000);
     
     
  //  $('.p-kontakt01-boxy > .p-kontakt01-box').first().addClass('act'); 

    $('.p-kontakt01-boxy > .p-kontakt01-box h3').on('click', function(e) {
        e.preventDefault(); 
       // $('.p-kontakt01-boxy > .p-kontakt01-box').removeClass('act');
        //$(this).parent().addClass('act');    
      //  $(this).parent().toggleClass('act');
        
        if ($(this).parent().hasClass('act')) {
        $(this).parent().removeClass('act');
    } else {
        $('.p-kontakt01-boxy > .p-kontakt01-box').removeClass('act');
        $(this).parent().addClass('act');
    }
        
        
        var $parent = $(this).parent();
        if ($parent.length) {
            var headerH = $('header').outerHeight() || 0;
            $('html, body').animate({
                scrollTop: Math.max(0, $parent.offset().top - headerH)
            }, 400);
        }
    }); 
}); 


 const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));


 AOS.init();

         