<?php
/**
 * Template Name: Not found
 * Description: Page template 404 Not found
 *
 */

	get_header();
?>


   <main class="main">      
        <div id="post-0" class="container  w1220  error404 not-found  ">
            <div class="row">
                <div class="col-md-12 box-html7">
                                    
                    <div class="wysiwyg">
                        <br><br><br><br>
                        <div class="pag-header-title">404</div>
                        <div class="pag-header-subtitle"> <?php pll_e('Coś poszło nie tak, nie znaleźliśmy strony o którą Ci chodzi'); ?> </div>
                        <div class="pag-link-home">  <a href="<?php echo home_url(); ?>" > <?php pll_e('Przejdź do strony głównej'); ?> </a>
               
                          
                    </div>
             
                    </div>
                </div>
            </div>
        </div>
    </main>



<?php get_footer(); ?>
