<?php
/* Template Name: Search-page */
/**
 * The template for displaying search forms
 */
?>

<?php
/* Template Name: Front-page */
get_header();
?>


    <main class="main">

        
        <div class="container  w1260">
            <div class="row">
     <div class="col-md-12 header-page-title">
                   <h1>  <?php the_title(); ?> </h1>
 
                </div>

                <div class="col-md-12 page-box-html search">
                    <div class="wysiwyg">

       <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

			<div class="input-group">
				<input type="text" name="s" id="s" class="form-control" placeholder="<?php _e( 'Wyszukaj', 'aa' ); ?>" />
				<span class="input-group-btn">
					<button type="submit" class="btn btn-secondary" name="submit" id="searchsubmit"><?php _e( 'Szukaj', 'aa' ); ?></button>
				</span>
			</div>
</form>
                        
                  
                        
                        
                    </div>


                </div>
                
                
                
            </div>
        </div>
        
</main>





<?php get_footer(); ?>