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

				<nav id="filter-options"></nav>
				<section id="articles-grid" class="grid"></section>

				<div class="most_read_wrapper grid">
					<h2 class="most_read_heading">Mest læste</h2>
					<section id="most_read_container" class="grid"></section>
				</div>

				

			<template id="most_read_template">
				<article class="articleSpan">
					<img class="mostread_teaserimage" src="" alt="">
					<p class="is_category "></p>
					<p class="is_green"></p>
					<h5 class="teaserheading"></h5>
				</article>
			</template>

			<template id="kultur">
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
		let kultur_kategorier;
		let hasThisFilter = "alle";

		let contentTemplate = document.querySelector("template#kultur");
		const container = document.querySelector("#articles-grid");

		let mostReadArticles;
		const mostReadContainer = document.querySelector("#most_read_container");
		let mostReadTemplate = document.querySelector("template#most_read_template");
		
		
		document.addEventListener("DOMContentLoaded", start);
		
		function start() {
			console.log("Start");
			
			getJSON();
		}
		
		async function getJSON() {
			const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/kultur?per_page=100";
			const fakeMostReadUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/kultur?per_page=4";
			let kulturKategorierUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/kultur_kategorier";
	
			console.log("getJSON");
			
			let response = await fetch(siteUrl);
			let fakeMostReadresponse = await fetch(fakeMostReadUrl);
			let kulturKategorierResponse = await fetch(kulturKategorierUrl);

			articles = await response.json();
			mostReadArticles = await fakeMostReadresponse.json();
			kultur_kategorier = await kulturKategorierResponse.json();
			console.log(kultur_kategorier);


			showArticles();
			showMostRead();
			createButtons()
		}
		
		
		function createButtons() {
			kultur_kategorier.forEach(cat => {
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
				if (artikel.kultur_kategorier.includes(parseInt(hasThisFilter)) || hasThisFilter == "alle") {

                    let mostReadClone = mostReadTemplate.cloneNode(true).content;

					if (artikel.kultur_kategorier[0] === 29) {
						clone.querySelector(".is_category").textContent = "Skønhedsfavoritter";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.kultur_kategorier[0] === 30) {
						mostReadClone.querySelector(".is_category").textContent = "Makeup";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.kultur_kategorier[0] === 31) {
						mostReadClone.querySelector(".is_category").textContent = "Hudpleje";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}
						

					if (artikel.kultur_kategorier[0] === 32) {
						mostReadClone.querySelector(".is_category").textContent = "Hårpleje";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.kultur_kategorier[0] === 41) {
						mostReadClone.querySelector(".is_green").textContent = "Costume Green";
						mostReadClone.querySelector(".is_category").style.display = "none";
					}
					
					mostReadClone.querySelector(".mostread_teaserimage").src = artikel.featuredimage.guid;
                    mostReadClone.querySelector(".teaserheading").textContent = artikel.teaserheading;
					mostReadClone.querySelector("article.articleSpan").addEventListener("click", () => {
						location.href = artikel.link;
					})
                    
					mostReadContainer.appendChild(mostReadClone);
           		}
			   else {
				   console.log("error");
			   }
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
				if (artikel.kultur_kategorier.includes(parseInt(hasThisFilter)) || hasThisFilter == "alle") {

                    let clone = contentTemplate.cloneNode(true).content;

					if (artikel.kultur_kategorier[0] === 29) {
						clone.querySelector(".is_category").textContent = "Skønhedsfavoritter";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.kultur_kategorier[0] === 30) {
						clone.querySelector(".is_category").textContent = "Makeup";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.kultur_kategorier[0] === 31) {
						clone.querySelector(".is_category").textContent = "Hudpleje";
						clone.querySelector(".is_green").style.display = "none";
					}
						

					if (artikel.kultur_kategorier[0] === 32) {
						clone.querySelector(".is_category").textContent = "Hårpleje";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.kultur_kategorier[0] === 41) {
						clone.querySelector(".is_green").textContent = "Costume Green";
						clone.querySelector(".is_category").style.display = "none";
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