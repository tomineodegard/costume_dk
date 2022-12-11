<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>
            <section class="category-heading">
            <h1 class="category_h1">Kultur</h1>
            <p class="page_description">Her på Costume.dk har vi altid fingeren på pulsen, når det kommer til byens bedste spisesteder, de lækreste opskrifter, nyeste film og serier samt sæsonens kulturelle begivenheder – og vi sørger også for, at holde dig opdateret på, hvad du skal opleve uden for landets grænser.</p>
        </section>
        
        <!-- <nav class="filter" id="filerOnCategory"></nav> -->
        <section class="articles-grid"></section>

        <template>
            <article id="kultur" class="articleSpan">
                <img class="featuredimage" src="" alt="">
                <h5 class="teaserheading"></h5>
            </article>
        </template>

        <script>        
            let elements;
            const siteUrl = "<?php echo esc_url( home_url( '/' ) ); ?>";

            function start() {
                getJson();
            }


            async function getJson() {
                const url = siteUrl +"wp-json/wp/v2/kultur?per_page=100";
                const data = await fetch(url);
                elements = await data.json();
                console.log(elements);
                showArticles();
            }

            function showArticles() {
                let contentTemplate = document.querySelector("template");
                let container = document.querySelector(".articles-grid");

                elements.forEach(element => {
                    let myTemplateClone = contentTemplate.cloneNode(true).content;
                    myTemplateClone.querySelector(".featuredimage").src = element.featuredimage.guid;
                    myTemplateClone.querySelector(".teaserheading").textContent = element.teaserheading;
                    // myTemplateClone.querySelector(".article-heading").textContent = element.title.rendered;
                    myTemplateClone.querySelector("article").addEventListener("click", () => {
                        location.href = element.link;
                    })
                    
                    container.appendChild(myTemplateClone);
                })
            }
            getJson();
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
