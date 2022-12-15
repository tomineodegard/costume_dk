<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>

	
				<section class="category-heading">
				<a href="https://www.tomineodegard.dk/kea/eksamen/costume/mode/"><h1 class="category_h1">Mode</h1></a>
					<p class="page_description">Hvad er sæsonens hotteste trends? Hvilke nye brads skal du holde øje med? Og hvor finder du lige sæsonens mest populære item? Få svar på det og meget mere i modeektionen her på Costume.dk, hvor vores passionerede moderedaktion sørger for at holde dig ajour med alt der rører sig i modeverdenen.</p>
				</section>


				<nav id="filter_options_desktop"></nav>

				<div class="dropdown_menu_container">
					<div class="dropdown">
					<button class="filter_btn">Filtrer efter kategori <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
						</button>
						<nav class="dropdown_content hide" id="dropdown_filter_options"><div class="filter chosen" data-taxonomy="all"></div></nav>
					</div>
				</div>


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
		const mostReadContainer = document.querySelector("#most_read_container");
		let mostReadTemplate = document.querySelector("template#most_read_template");
		
		
		document.addEventListener("DOMContentLoaded", start);
		
		function start() {
			console.log("Start");
			
			getJSON();
		}
		
		async function getJSON() {
			const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode?per_page=100";
			const fakeMostReadUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode?per_page=4";
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
			createButtons();
			createDropdown();
		}
		
		
		function createButtons() {
			mode_kategorier.forEach(cat => {
				document.querySelector("#filter_options_desktop").innerHTML += `<button class="filter" data-taxonomy="${cat.id}">${cat.name}</button>`;
				
			});
		
			registrerButtons();
		};

		function createDropdown() {
			mode_kategorier.forEach(cat => {
				document.querySelector("#dropdown_filter_options").innerHTML += `<button class="filter close_after_click" data-taxonomy="${cat.id}">${cat.name}</button>`;
				
			});
		
			registrerButtons();
		};


		function registrerButtons() {
				document.querySelectorAll(".filter").forEach(elm => {
					elm.addEventListener("click", filterArticles);
			})
		};


		function showMostRead() {
			console.log("show fake most read articles");
			mostReadContainer.innerHTML = "";

			mostReadArticles.forEach(artikel => {
				if (artikel.mode_kategorier.includes(parseInt(hasThisFilter)) || hasThisFilter == "alle") {

                    let mostReadClone = mostReadTemplate.cloneNode(true).content;

					if (artikel.mode_kategorier[0] === 46) {
						mostReadClone.querySelector(".is_category").textContent = "Trending";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.mode_kategorier[0] === 47) {
						mostReadClone.querySelector(".is_category").textContent = "Sæsonens Favoritter";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.mode_kategorier[0] === 48) {
						mostReadClone.querySelector(".is_category").textContent = "Modeuge";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}
						

					if (artikel.mode_kategorier[0] === 45) {
						mostReadClone.querySelector(".is_category").textContent = "Inspiration";
						mostReadClone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.mode_kategorier[0] === 49) {
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
				if (artikel.mode_kategorier.includes(parseInt(hasThisFilter)) || hasThisFilter == "alle") {

                    let clone = contentTemplate.cloneNode(true).content;

					if (artikel.mode_kategorier[0] === 46) {
						clone.querySelector(".is_category").textContent = "Trending";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.mode_kategorier[0] === 47) {
						clone.querySelector(".is_category").textContent = "Sæsonens Favoritter";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.mode_kategorier[0] === 48) {
						clone.querySelector(".is_category").textContent = "Modeuge";
						clone.querySelector(".is_green").style.display = "none";
					}
						

					if (artikel.mode_kategorier[0] === 45) {
						clone.querySelector(".is_category").textContent = "Inspiration";
						clone.querySelector(".is_green").style.display = "none";
					}

					if (artikel.mode_kategorier[0] === 49) {
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