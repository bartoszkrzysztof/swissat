<?php
/* Template Name: Search-results */
/**
 * The Template for displaying Search Results pages.
 */

	get_header();
?>
    
 <main class="main">

        
        <div class="container  w1260">
            <div class="row">
     

                <div class="col-md-12 page-box-html search-results">
                    <div class="wysiwyg">
                        
                        
               <? 
                
                   get_search_query(); 

                    if ( get_search_query() ) { ?>
                <div class="box-jest">
<div class="header-page-title">
                    <h1><?php printf( __( 'Wyszukiwano frazę: %s', 'aa' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                 </div>
                           
                  
                    <?php if ( have_posts() ) : ?>
                   <?php while ( have_posts() ) : the_post(); ?>                  
                  
                        <div class="box01">
                            <h2><?php the_title(); ?> </h2>
                            <h3><?php the_excerpt(); ?> </h3>     
                            <a href="<?php the_permalink(); ?>"> więcej </a>                    
                          
                        </div>   
                        <?php endwhile; ?>
                    <?php else : ?>    
                    <div class="box01">                  
                    <div class="box-brak">  
   
                        <h2>Brak wyników dla tej frazy: <span> <? echo get_search_query();  ?></span> </h2>
                    </div>
                    </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>

               
               
                </div>
  <? }else {  ?>
                <div class="box-brak">
<div class="header-page-title">
    <h1>Wpisz szukaną frazę</h1> </div>
                     <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

			<div class="input-group">
				<input type="text" name="s" id="s" class="form-control" placeholder="<?php _e( 'Wyszukaj', 'aa' ); ?>" />
				<span class="input-group-btn">
					<button type="submit" class="btn btn-secondary" name="submit" id="searchsubmit"><?php _e( 'Szukaj', 'aa' ); ?></button>
				</span>
			</div>
</form>

                </div>      
                  <?  }  ?>
                 
               </div>


                </div>
                
                
                
            </div>
        </div>
        
</main>

	
	
<?php get_footer(); ?>
