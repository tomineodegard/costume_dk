<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>


			<div id="content" class="site-content clr">

				<?php do_action( 'ocean_before_content_inner' ); ?>

                <!-- SECTION WITH CATEGORY CARDS -->
                <!-- <div class="container-home-categories">
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
                </div> -->

            <!-- CURRENT ISSUE WITH CTA -->
            <!-- <section class="current_issue"></section> -->

            <!-- NEWEST ARTICLES -->
            <!-- <section id="newest-container"></section> -->


             <!-- HOROSKOP SECTION -->
             <!-- <section class="horoskop"></section> -->

             <template id="newest-template">
				<article id="newest-articles" class="NewestArticleSpan">
					<h6 class="is-category"></h6>
					<img class="mostReadTeaserImage" src="" alt="">
					<h5 class="mostReadTeaserHeading"></h5>
				</article>
			</template>

        <script>

            console.log("hjem");

            let newestMode;
            let newestSkoenhed;
            let newestKultur;
            let newestGreen;

            const newestContainer = document.querySelector("#newest-container");
		    let newestTemplate = document.querySelector("template#newest-template");

            document.addEventListener("DOMContentLoaded", start);
            console.log("DOM loaded");
		
                function start() {
                    console.log("start function");
                    getJson();
                }

            async function getJson() {
                const newestModeUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode?per_page=1";
                const newestSkoenhedUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenhed?per_page=1";
                const newestKulturUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/kultur?per_page=1";
                const newestGreenUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/costume-green?per_page=1";
                console.log("get JSON function")
                
                let newestModeResponse = await fetch(newestModeUrl);
                let newestSkoenhedResponse = await fetch(newestSkoenhedUrl);
                let newestKulturResponse = await fetch(newestKulturUrl);
                let newestGreenResponse = await fetch(newestGreenUrl);

                newestMode = await newestModeResponse.json();
                newestSkoenhed = await newestModeResponse.json();
                newestKultur = await newestModeResponse.json();
                newestGreen = await newestModeResponse.json();

                showNewest();
		    }

            function showNewest() {
                console.log("vis nyeste artikler");
                newestContainer.innerHTML = "";

                newestArticles.forEach(artikel => {
                    const newestClone = newestTemplate.cloneNode(true).content;
                        newestClone.querySelector(".newestTeaserImage").src = artikel.featuredimage.guid;
                        newestClone.querySelector(".newestTeaserHeading").textContent = artikel.teaserheading;
                        newestClone.querySelector("article#most-read-articles").addEventListener("click", () => {
                            location.href = artikel.link;
                    })
				newestContainer.appendChild(newestClone);
			})
		}
		

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
