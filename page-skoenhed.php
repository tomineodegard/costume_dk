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

				<div class="most_read_wrapperr">
					<h2 class="mostRead_h2">Mest læste</h2>
					<section id="most-read-container">
					</section>
				</div>

				<!-- <nav id="filter-options">
				</nav> -->
				
				<!-- <section>
					<ul id="filter-options">
						<li id="filter underline chosen is-category">Hudpleje</li>
						<li id="filter underline chosen is-category">Hårpleje</li>
						<li id="filter underline chosen is-category">Makeup</li>
						<li id="filter underline chosen is-category">Skønhedsfavoritter</li>
					</ul>
				</section> -->
			
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

		let artikler;
		let alleKategorier;
		let filterArtikel;

		let contentTemplate = document.querySelector("template#skoenhed");
		const container = document.querySelector("#articles-grid");

		let mostReadArticles;
		const mostReadContainer = document.querySelector("#most-read-container");
		let mostReadTemplate = document.querySelector("template#most-read-template");

		let filterHudpleje = "alle";
		let filterHaarpleje = "alle";
		let filterMakeup = "alle";
		let filterFavoritter = "alle";

		
		
		document.addEventListener("DOMContentLoaded", start);
		
		function start() {
			console.log("start function");
			
			getJson();
		}
		
		async function getJson() {
			const siteUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenhed?per_page=100";
			const fakeMostReadUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenhed?per_page=2";
			let skoenhedsKategorierUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenheds_kategorier";
	
			console.log("get JSON function")
			
			let response = await fetch(siteUrl);
			let fakeMostReadresponse = await fetch(fakeMostReadUrl);
			let skoenhedsKategorierResponse = await fetch(skoenhedsKategorierUrl);

			artikler = await response.json();
			mostReadArticles = await fakeMostReadresponse.json();
			alleKategorier = await skoenhedsKategorierResponse.json();

			visArtikler();
			showMostRead();
			// createButtons()
			getCategory();
		}
		
	
		function getCategory() {
			alleKategorier.forEach(cat => {
			document.querySelector(".is-category").innerHTML += `<p class="this_category" data-taxonomy="${cat.id}">${cat.name}</p>`;
		})
	}
		
		// function createButtons() {
		// 	alleKategorier.forEach(cat => {
		// 		document.querySelector("#filter-options").innerHTML += `<button class="filter" data-taxonomy="${cat.id}">${cat.name}</button>`;
				
		// 	});
		
		// 	registrerButtons();
		// }


		// function registrerButtons() {
		// 		document.querySelectorAll(".filter").forEach(elm => {
		// 			elm.addEventListener("click", filtrering);
		// 	})
		// };





		// function findCategory(kategorier) {
		// 	kategorier.forEach(kategori => {
		// 		if(kategori.skoenheds_kategorier.id === "31") {
		// 			document.querySelector(".is-category").innerHTML = "Hudpleje";
		// 		}
		// 		if(kategori.skoenheds_kategorier.id === "32") {
		// 			document.querySelector(".is-category").innerHTML = "Hårpleje";
		// 		}
		// 		if(kategori.skoenheds_kategorier.id === "30") {
		// 			document.querySelector(".is-category").innerHTML = "Makeup";
		// 		}
		// 		if(kategori.skoenheds_kategorier.id === "29") {
		// 			document.querySelector(".is-category").innerHTML = "Skønhedsfavoritter";
		// 		}
		// 		else {
		// 			console.log("error when finding category")
		// 		}
		// 	})
		// }

		function showMostRead() {
			console.log("vis mest leste");
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


		// function filtrering() {
		// 	filterArtikel = this.dataset.taxonomy;

		// 	console.log(filterArtikel);
		// 	console.log("du har valgt filtrer hud");

		// 	visArtikler();
		// }
		

		function visArtikler() {
			console.log("vis artikler");
			console.log(artikler);

			container.innerHTML = "";

			artikler.forEach(artikel => {
				// if (artikel.alleKategorier.includes(parseInt(filterArtikel))) {
                    let clone = contentTemplate.cloneNode(true).content;
					clone.querySelector(".teaserimage").src = artikel.featuredimage.guid;
                    clone.querySelector(".teaserheading").textContent = artikel.teaserheading;
                    clone.querySelector("article#individual_article_in_loop").addEventListener("click", () => { location.href = artikel.link;})
                    
                    container.appendChild(clone);
                // }
				// else {
				// 	console.log("det er fejl");
				// }
            })
		}


		
		// function selectFilter(userEvent) {
		// 	const taxonomy = userEvent.target.dataset.taxonomy;
		// 	if(taxonomy === "31") {
		// 		filterHudplejeArtikler();
		// 	}
		// 	else if(taxonomy === "32") {
		// 		filterHaarplejeArtikler();
		// 	} 
		// 	else if(taxonomy === "30") {
		// 		filterMakeupArtikler();
		// 	} 
		// 	else if(taxonomy === "29") {
		// 		filterFavoritterArtikler();
		// 	} 
		// 	console.log(`jeg har valgt ${taxonomy}`);
		// 	// setFilter(taxonomy);
		// }


		// function setFilter(taxonomy) {
		// 	settings.filterBy = taxonomy;
		// 	buildList();
		// }

		// function buildList() {
		// 	const currentList = filterList(artikler);
		// 	console.log("current list is showing now");
		// 	console.log(`${currentList}`);
		// 	// visArtikler(filteredList);
		// }



		
		// function filterHudplejeArtikler(artikel) {
		// 	return artikel.categoryId === "31";
		// }

		// function filterHudplejeArtikler() {
		// 	console.log("du har valgt filtrer hud");
		// 	// filterHud = this.dataset.hud;
        //     //  //fjern .valgt fra alle
        //     // document.querySelectorAll(".filter").forEach(elm => {
        //     //     elm.classList.remove("chosen");
        //     // });
        //     // //tilføj .valgt til den valgte
        //     // this.classList.add("chosen");
        //     // visArtikler();
        // }

		


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
