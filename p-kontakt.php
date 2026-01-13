<?php
    /* Template Name: p-kontakt */
    get_header();

    $post_id = get_the_ID();
    $forms_list = get_field('forms_accordion', $post_id);
?>

<main class="p-kontakt  pod"> 
    <section  class="p-kontakt01"> 
        <div class="p-kontakt01-wrap pod-wrap "      >  
            <h1> Napisz do nas w sprawie swojego projektu! </h1>
            <h2> HELLO LET’S TALK ABOUT YOUR PROJECT </h2>
            <?php if ( $forms_list ) : ?>
                <div class="p-kontakt01-boxy" >
                    <?php foreach ( $forms_list as $form ) : ?>
                        <?php if ($form['form_id']) : ?>
                            <div class="p-kontakt01-box" > 
                                <h3> <?php echo esc_html( $form['header'] ); ?> </h3>  
                                <div class="form-wrap">
                                    <?php echo do_shortcode( '[contact_form id="' . esc_html( $form['form_id'] ) . '"]' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>