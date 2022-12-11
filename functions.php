<?php
add_action( 'wp_enqueue_scripts', 'enqueue_important_files' );
function enqueue_important_files() {
    /* Get the parent stylesheet in the parent-theme´s  forlder */
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    /* Registrer and enque GSAP */
    wp_register_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js', array(), false, true );
    wp_enqueue_script('gsap'); 

    /* Registrer and enque our gsap-custom file */
    wp_register_script('gsap_custom.js', get_stylesheet_directory_uri() . '/gsap_custom.js', [], 1, true);
    wp_enqueue_script('gsap_custom.js');


    }
?>