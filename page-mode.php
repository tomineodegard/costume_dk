<?php


get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>

            <section class="category-heading">
                <h1 class="category_h1">Mode</h1>
                <p class="page_description">Hvad er sæsonens hotteste trends? Hvilke nye brads skal du holde øje med? Og hvor finder du lige sæsonens mest populære item? Få svar på det og meget mere i modesektionen her på Costume.dk, hvor vores passionerede moderedaktion sørger for at holde dig ajour med alt der rører sig i modeverdenen.</p>
            </section>
        
            <section id="articles-grid"></section>

            <template id="mode">
                <article id="loopview" class="articleSpan">
                    <h6 class="is-category"></h6>
                    <img class="teaserimage" src="" alt="">
                    <h5 class="teaserheading"></h5>
                </article>
            </template>

        <script>
        console.log("page mode loopview");

        let artikler;
        let contentTemplate = document.querySelector("template#mode");
        const modeugeUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode-kategorier/25";
		const saesonensFavoritterUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode-kategorier/28";
		const trendingUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode-kategorier/27";
		const inspirationUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode-kategorier/26";

       
        const container = document.querySelector("#articles-grid");

        document.addEventListener("DOMContentLoaded", start);
		
		function start() {
		    console.log("start function");
			getJson();
		}


            async function getJson() {
                const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode?per_page=100";
                const response = await fetch(siteUrl);
                artikler = await response.json();

                console.log("get JSON function")
                showArticles();
            }

            function showArticles() {



                artikler.forEach(artikel => {
                    let clone = contentTemplate.cloneNode(true).content;
                    // clone.querySelector(".is-category").textContent = artikel.taxonomy.name;
                    clone.querySelector(".teaserimage").src = artikel.featuredimage.guid;
                    clone.querySelector(".teaserheading").textContent = artikel.teaserheading;
                    clone.querySelector("article#loopview").addEventListener("click", () => {
                        location.href = artikel.link;
                    })
                    
                    container.appendChild(clone);
                })
            }
        </script>
			<div id="content" class="site-content clr">

				<?php do_action( 'ocean_before_content_inner' ); ?>

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
