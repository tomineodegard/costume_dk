<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>
            <section class="category-heading">
            <h1 class="category_h1">Nyheder</h1>
            <p class="page_description">Costume er først med de største og mest interessante nyheder – både når det kommer til nyheder fra Danmark eller det store udland. Hvis du ikke vil gå glip af noget, kan du altid følge med på vores sociale medier, så du kan være iblandt de første til at vide, når vi har nye artikler til dig.</p>
        </section>

        <section class="articles-grid"></section>

        <template>
            <article id="nyheder" class="articleSpan">
                <img class="featuredimage" src="" alt="">
                <h5 class="teaserheading"></h5>
            </article>
        </template>

        <script>
            let elements;
            const siteUrl = "<?php echo esc_url( home_url( '/' ) ); ?>";

            function start() {
                console.log("the id is", <?php echo get_the_ID() ?>);
                console.log(siteUrl);
                
                getJson();
            }

            async function getJson() {
                const url = siteUrl +"wp-json/wp/v2/nyheder?per_page=100";
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
                    myTemplateClone.querySelector(".image").textContent = element.featuredimage.guid;
                    myTemplateClone.querySelector(".heading").textContent = element.title.rendered;
                    myTemplateClone.querySelector(".subheading").textContent = element.subheading;
                    myTemplateClone.querySelector(".articleAuthor").textContent = element.articleAuthor;
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
