<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>

	
				<section class="category-heading">
					<h1 class="category_h1">Skønhed</h1>
					<p class="page_description">I vores skønhedssektion her på Costume.dk holder vores skønhedsredaktør dig opdateret på alt det nye inden for hårpleje, hudpleje og makeup, så du kan holde dig skøn året rundt – fra top til tå. Her kan du blant andet finde guides til, hvordan du får mest ud af dine skønhedsprodukter, og vi forsyner dig også med tips til flotte makeup-looks.</p>
				</section>

				<nav id="filter-options"></nav>

				<div class="most_read_wrapperr">
					<h2 class="mostRead_h2">Mest læste</h2>
					<section id="most-read-container">
					</section>
				</div>

			
			<section id="articles-grid"></section>
			

			<template id="most-read-template">
				<article id="most-read-articles" class="mostReadArticleSpan">
					<h6 class="is-category"></h6>
					<img class="mostReadTeaserImage" src="" alt="">
					<h5 class="mostReadTeaserHeading"></h5>
				</article>
			</template>

			<template id="skoenhed">
				<article id="individual_article_in_loop" class="articleSpan">
					<div class="is-category"></div>
					<!-- <h6 class="is-category"></h6> -->
					<img class="teaserimage" src="" alt="">
					<h5 class="teaserheading"></h5>
				</article>
			</template>

		<script>

		console.log("page skønhed individual_article_in_loop");

		let articles;
		let skoenheds_kategorier;
		let filterOnCategories = "alle";

		let contentTemplate = document.querySelector("template#skoenhed");
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
			const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenhed?per_page=100";
			const fakeMostReadUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenhed?per_page=2";
			let skoenhedsKategorierUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenheds_kategorier";
	
			console.log("getJSON");
			
			let response = await fetch(siteUrl);
			let fakeMostReadresponse = await fetch(fakeMostReadUrl);
			let skoenhedsKategorierResponse = await fetch(skoenhedsKategorierUrl);

			articles = await response.json();
			mostReadArticles = await fakeMostReadresponse.json();
			skoenheds_kategorier = await skoenhedsKategorierResponse.json();
			console.log(skoenheds_kategorier);


			showArticles();
			showMostRead();
			createButtons()
			getCategory();
		}
		
	
		function getCategory() {
			skoenheds_kategorier.forEach(cat => {
			document.querySelector(".is-category").innerHTML += `<p class="this_category" data-taxonomy="${cat.id}">${cat.name}</p>`;
		})
	}
		
		function createButtons() {
			skoenheds_kategorier.forEach(cat => {
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
			filterOnCategories = this.dataset.taxonomy;

			console.log(filterOnCategories);
			console.log("du har valgt filtrer hud");

			showArticles();
		}
		

		function showArticles() {
			console.log("show articles");
			console.log(articles);

			container.innerHTML = "";

			articles.forEach(artikel => {
				if (artikel.skoenheds_kategorier.includes(parseInt(filterOnCategories)) || filterOnCategories == "alle") {
                    let clone = contentTemplate.cloneNode(true).content;
					clone.querySelector(".teaserimage").src = artikel.featuredimage.guid;
                    clone.querySelector(".teaserheading").textContent = artikel.teaserheading;
                    clone.querySelector("article#individual_article_in_loop").addEventListener("click", () => { location.href = artikel.link;})
                    
                    container.appendChild(clone);
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
