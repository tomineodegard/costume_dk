<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="whitespace">
				<section class="category-heading">
					<h1 class="category_h1">Costume green</h1>
					<p class="page_description">Costume handler altid om det nye sort, men vi sætter også fokus på en anden farve: grøn. Mere specifik: grøn mode. Bæredygtig mode og skønhed fylder mere og mere i mærkernes bevidsthed, og det er en nødvendighed, hvis vi stadig vil have ren luft at trække ned i vores lunger, grønne skove, rent havvand og vilde dyr. Derfor vil vi her guide dig til alle de grønne tips, modenyheder, mærker, butikker, personer og skønhedsprodukter, der alt sammen hjælper jorden lidt mod det bedre. Store forandringer begynder småt.</p>
				</section>

				<h2 class="mostRead_h2">Mæst leste</h1>
				<section id="most-read-container"></section>

				<!-- <nav id="filter-options"></nav> -->

				<section id="articles-grid"></section>
			</div>

			<template id="costume-green">
				<article id="individual_article_in_loop" class="articleSpan">
					<h6 class="is-category"></h6>
					<img class="teaserimage" src="" alt="">
					<h5 class="teaserheading"></h5>
				</article>
			</template>

		<script>

            console.log("page costume green individual_article_in_loop");

            let artikler;

            let contentTemplate = document.querySelector("template#costume-green");
		    const container = document.querySelector("#articles-grid");

            function start() {
                console.log("the id is", <?php echo get_the_ID() ?>);
                console.log(siteUrl);
                
                getJson();
            }

            async function getJson() {
                const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/costume-green?per_page=100";
                const responese = await fetch(url);
                artikler = await responese.json();
                console.log(artikler);

                showArticles();
            }

            function showArticles() {

                artikler.forEach(artikel => {
                    let clone = contentTemplate.cloneNode(true).content;
                    clone.querySelector(".image").textContent = artikel.featuredimage.guid;
                    clone.querySelector(".heading").textContent = artikel.title.rendered;
                    clone.querySelector(".subheading").textContent = artikel.subheading;
                    clone.querySelector(".articleAuthor").textContent = artikel.articleAuthor;
                    clone.querySelector("article").addEventListener("click", () => {
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
