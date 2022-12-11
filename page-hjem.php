<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>


			<div id="content" class="site-content clr">

				<?php do_action( 'ocean_before_content_inner' ); ?>


                <!-- CUSTOM HERO SECTION -->
                <section class="hero"></section>

                <!-- SECTION WITH CATEGORY CARDS -->
                <div class="container-home-categories">
                    <div class="home_category">
                        <a class="first_cat_home" href="#">
                            <img class="cat-image" src = "<?php echo get_stylesheet_directory_uri()?>/assets/images/costume-kategoribillede-kultur.jpg" alt="">
                        </a>
                    </div>

                    <div class="home_category">
                        <a class="second_cat_home" href="#">
                            <img class="cat-image" src = "<?php echo get_stylesheet_directory_uri()?>/assets/images/mina-drikker-kaffe.jpg" alt="">
                        </a>
                    </div>

                    <div class="home_category">
                        <a class="third_cat_home" href="#">
                            <img class="cat-image" src = "<?php echo get_stylesheet_directory_uri()?>/assets/images/costume-kategoribillede-kultur.jpg" alt="">
                        </a>
                    </div>
                </div>

            <!-- CURRENT ISSUE WITH CTA -->
            <section class="current_issue"></section>

             <!-- HOROSKOP SECTION -->
             <section class="horoskop"></section>

        <script>
            "use strict";
            // wait until DOM is ready
            document.addEventListener("DOMContentLoaded", function(event) {
            
                console.log("DOM loaded");
                
                // wait until images, links, fonts, stylesheets, and js is loaded
                window.addEventListener("load", function(e) {
                
                // custom GSAP code goes here
                console.log("window loaded");
                
                }, false);
    
            });

            gsap.registerPlugin(ScrollTrigger);

            ScrollTrigger.defaults({
            markers: false
            });

            // Logo animation
            let triggerElement = document.querySelector(".elementor-11 .elementor-element.elementor-element-f29e20e > .elementor-container");
            let targetElement = document.querySelector("#scrollTriggeredLogo");
            
            let myTimeline = gsap.timeline({
                scrollTrigger: {
                trigger: triggerElement,
                start: "top center",
                end: "bottom top",
                scrub: 1,
                pin: true
                }
            });

            myTimeline.to(targetElement, {
                width: "20%",
                y: "-90%",
                duration: 1,
                toggleActions: "restart pause reverse pause",
                scale: 0.5,
            });
            
           
        </script>

				<?php
				// Elementor `single` location.
				if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

					// Start loop.
					while ( have_posts() ) :
						the_post();

						get_template_part( 'partials/page/layout' );

					endwhile;

				}
				?>

				<?php do_action( 'ocean_after_content_inner' ); ?>

			</div><!-- #content -->

			<?php do_action( 'ocean_after_content' ); ?>

		</div><!-- #primary -->

		<?php do_action( 'ocean_after_primary' ); ?>

	</div><!-- #content-wrap -->

	<?php do_action( 'ocean_after_content_wrap' ); ?>

<?php get_footer(); ?>
