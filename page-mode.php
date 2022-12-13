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

				<nav id="filter-options"></nav>
				<section id="articles-grid"></section>

				<div class="most_read_wrapper">
					<h2 class="mostRead_h2">Mest læste</h2>
					<section id="most-read-container"></section>
				</div>

				

			<template id="most-read-template">
				<article id="most-read-articles" class="mostReadArticleSpan">
					<img class="mostReadTeaserImage" src="" alt="">
					<p class="is_category "></p>
					<p class="is_green"></p>
					<h5 class="mostReadTeaserHeading"></h5>
				</article>
			</template>

			<template id="mode">
				<article id="individual_article_in_loop" class="articleSpan">
					<img class="teaserimage" src="" alt="">
					<p class="is_category "></p>
					<p class="is_green"></p>
					<h5 class="teaserheading"></h5>
				</article>
			</template>

		<script>

		console.log("page skønhed individual_article_in_loop");

		let articles;
		let mode_kategorier;
		let hasThisFilter = "alle";

		let contentTemplate = document.querySelector("template#mode");
		const container = document.querySelector("#articles-grid");

		let mostReadArticles;
		const mostReadContainer = document.querySelector("#most-read-container");
		let mostReadTemplate = document.querySelector("template#most-read-template");
		
		
		document.addEventListener("DOMContentLoaded", start);
		
		function start() {
			console.log("Start");
			
			getJSON();
		}
		
		async function getJSON() {
			const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode?per_page=100";
			const fakeMostReadUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode?per_page=2";
			let modeKategorierUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode_kategorier";
	
			console.log("getJSON");
			
			let response = await fetch(siteUrl);
			let fakeMostReadresponse = await fetch(fakeMostReadUrl);
			let modeKategorierResponse = await fetch(modeKategorierUrl);

			articles = await response.json();
			mostReadArticles = await fakeMostReadresponse.json();
			mode_kategorier = await modeKategorierResponse.json();
			console.log(mode_kategorier);


			showArticles();
			showMostRead();
			createButtons()
		}
		
		
		function createButtons() {
			mode_kategorier.forEach(cat => {
				document.querySelector("#filter-options").innerHTML += `<button class="filter" data-taxonomy="${cat.id}">${cat.name}</button>`;
				
			});
		
			registrerButtons();
		}


		function registrerButtons() {
				document.querySelectorAll(".filter").forEach(elm => {
					elm.addEventListener("click", filterArticles);
			})
		};


		function showMostRead() {
			console.log("show fake most read articles");
			mostReadContainer.innerHTML = "";

			mostReadArticles.forEach(artikel => {
				const mostReadClone = mostReadTemplate.cloneNode(true).content;
					mostReadClone.querySelector(".mostReadTeaserImage").src = artikel.featuredimage.guid;
					mostReadClone.querySelector(".mostReadTeaserHeading").textContent = artikel.teaserheading;
                    mostReadClone.querySelector("article#most-read-articles").addEventListener("click", () => {
                        location.href = artikel.link;
				})
				mostReadContainer.appendChild(mostReadClone);
			})
		}


		function filterArticles() {
			hasThisFilter = this.dataset.taxonomy;

			showArticles();
		}
		

		function showArticles() {
			console.log("show articles");
			console.log(articles);

			container.innerHTML = "";
			articles.forEach(artikel => {
				if (artikel.mode_kategorier.includes(parseInt(hasThisFilter)) || hasThisFilter == "alle") {

                    let clone = contentTemplate.cloneNode(true).content;

					if (artikel.mode_kategorier[0] == 45) {
						clone.querySelector(".is_category").textContent = "Inspiration";
					}

					if (artikel.mode_kategorier[0] == 46) {
						clone.querySelector(".is_category").textContent = "Trending";
					}

					if (artikel.mode_kategorier[0] == 47) {
						clone.querySelector(".is_category").textContent = "Sæsonens Favoritter";
					}
						

					if (artikel.mode_kategorier[0] == 48) {
						clone.querySelector(".is_category").textContent = "Modeuge";
					}

					if (artikel.mode_kategorier[0] == 49) {
						clone.querySelector(".is_green").textContent = "Costume Green";
					}
					
					clone.querySelector(".teaserimage").src = artikel.featuredimage.guid;
                    clone.querySelector(".teaserheading").textContent = artikel.teaserheading;
                    clone.querySelector("article#individual_article_in_loop").addEventListener("click", () => { location.href = artikel.link;})
                    
                    container.appendChild(clone);
           	}
			   else {
				   console.log("error");
			   }
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
