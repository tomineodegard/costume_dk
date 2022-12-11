<?php

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>

			<div id="whitespace">
				<section class="category-heading">
					<h1 class="category_h1">Skønhed</h1>
					<p class="page_description">I vores skønhedssektion her på Costume.dk holder vores skønhedsredaktør dig opdateret på alt det nye inden for hårpleje, hudpleje og makeup, så du kan holde dig skøn året rundt – fra top til tå. Her kan du blant andet finde guides til, hvordan du får mest ud af dine skønhedsprodukter, og vi forsyner dig også med tips til flotte makeup-looks.</p>
				</section>

				<h2 class="mostRead_h2">Mæst leste</h1>
				<section id="most-read-container"></section>
				
				<section>
					<ul id="filter-options">
						<li id="filter underline chosen">Hudpleje</li>
						<li id="filter underline chosen">Hårpleje</li>
						<li id="filter underline chosen">Makeup</li>
						<li id="filter underline chosen">Skønhedsfavoritter</li>
					</ul>
				</section>
				<section id="articles-grid"></section>
			</div>
			

			<template id="most-read-template">
				<article id="most-read-articles" class="mostReadArticleSpan">
					<h6 class="is-category"></h6>
					<img class="mostReadTeaserImage" src="" alt="">
					<h5 class="mostReadTeaserHeading"></h5>
				</article>
			</template>

			<template id="skoenhed">
				<article id="loopview" class="articleSpan">
					<h6 class="is-category"></h6>
					<img class="teaserimage" src="" alt="">
					<h5 class="teaserheading"></h5>
				</article>
			</template>

		<script>

		console.log("page skønhed loopview");

		let artikler;
		let mostReadArticles;
		let hudplejeArray;
		let haarplejeArray;
		let makeupArray;
		let favoritterArray;

		const container = document.querySelector("#articles-grid");
		const mostReadContainer = document.querySelector("#most-read-container");
		let mostReadTemplate = document.querySelector("template#most-read-template");
		let contentTemplate = document.querySelector("template#skoenhed");
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
			const hudplejeUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenheds_kategorier/31";
			const haarplejeUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenheds_kategorier/32";
			const makeupUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenheds_kategorier/30";
			const favoritterUrl = "https://www.tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenheds_kategorier/29";
	
			console.log("get JSON function")
			
			let response = await fetch(siteUrl);
			let fakeMostReadresponse = await fetch(fakeMostReadUrl);
			let skoenhedsKategorierResponse = await fetch(skoenhedsKategorierUrl);
			let hudResponse = await fetch(hudplejeUrl);
			let haarResponse = await fetch(haarplejeUrl);
			let makeupResponse = await fetch(makeupUrl);
			let favoritterResponse = await fetch(favoritterUrl);

			artikler = await response.json();
			mostReadArticles = await fakeMostReadresponse.json();
			skoenhedsKategorierUrl = await skoenhedsKategorierResponse.json();
			hudplejeArray = await hudResponse.json();
			haarplejeArray = await haarResponse.json();
			makeupArray = await makeupResponse.json();
			favoritterArray = await favoritterResponse.json();


			// console.log(skoenhedsKategori);
			// console.log(hudplejeArray);
			// console.log(haarplejeArray);
			// console.log(makeupArray);
			// console.log(favoritterArray);

			visArtikler();
			showMostRead();
			findCategory();
			// createButtons(hudplejeArray);
		}
		
	
		
		// function createButtons() {

			// artikler.forEach(cat => {
			// 	document.querySelector("#filter-options").innerHTML += `<button class="filter" data-taxonomy="${cat.id}">${cat.name}</button>`;
			// });

			// hudplejeArray.forEach(cat => {
			// 	document.querySelector("#filter-options").innerHTML += `<button class="filter" data-taxonomy="${cat.id}">${cat.name}</button>`;
			// });
		
		// 	registrerButtons();
		// }

		function findCategory() {
			artikler.forEach(artikel => {
				if(artikel.skoenheds_kategorier.id === "31") {
					document.querySelector(".is-category").innerHTML = "Hudpleje";
				}
				if(artikel.skoenheds_kategorier.id === "32") {
					document.querySelector(".is-category").innerHTML = "Hårpleje";
				}
				if(artikel.skoenheds_kategorier.id === "30") {
					document.querySelector(".is-category").innerHTML = "Makeup";
				}
				if(artikel.skoenheds_kategorier.id === "29") {
					document.querySelector(".is-category").innerHTML = "Skønhedsfavoritter";
				}
				else {
					console.log("error when finding category")
				}
			})
		}

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

		

		function visArtikler() {
			console.log("vis artikler");
			console.log(artikler);

            // console.log({filterHudpleje});
            // console.log({filterHaarpleje});
            // console.log({filterMakeup});
			// console.log({filterFavoritter});

			container.innerHTML = "";

			artikler.forEach(artikel => {
                //tjek filterFarve, filterHoejde og filterPriser til filtrering
                if ((filterHudpleje == "alle"  || artikel.hudpleje.includes(parseInt(filterHudpleje))) 
                && (filterHaarpleje == "alle"  || artikel.haarpleje.includes(parseInt(filterHaarpleje))) 
                && (filterMakeup == "alle"  || artikel.makeup.includes(parseInt(filterMakeup)))
				&& (filterFavoritter == "alle"  || artikel.favoritter.includes(parseInt(filterFavoritter)))) {
                    const clone = contentTemplate.cloneNode(true).content;
					clone.querySelector(".teaserimage").src = artikel.featuredimage.guid;
                    clone.querySelector(".teaserheading").textContent = artikel.teaserheading;
                    clone.querySelector("article#loopview").addEventListener("click", () => {
                        location.href = artikel.link;
                    })
                    
                    container.appendChild(clone);
                } else {
                    console.log("der er ingen artikler");
                }
            })
		}




		function registrerButtons() {
			document.querySelectorAll(".filter-button").forEach(elm => {
                elm.addEventListener("click", filterHudplejeArtikler);
            })
		}

		function filterHudplejeArtikler() {
			console.log("filtrer hud");
			filterHud = this.dataset.hud;
             //fjern .valgt fra alle
            document.querySelectorAll(".filter-button").forEach(elm => {
                elm.classList.remove("chosen");
            });
            //tilføj .valgt til den valgte
            this.classList.add("chosen");
            visArtikler();
        }

		function filterHaarplejeArtikler() {
			console.log("filtrer haar");
			filterHud = this.dataset.haar;
             //fjern .valgt fra alle
            document.querySelectorAll(".filter-button").forEach(elm => {
                elm.classList.remove("chosen");
            });
            //tilføj .valgt til den valgte
            this.classList.add("chosen");
            visArtikler();
        }

		function filterMakeupArtikler() {
			console.log("filtrer makeup");
			filterMakeup = this.dataset.makeup;
             //fjern .valgt fra alle
            document.querySelectorAll(".filter-button").forEach(elm => {
                elm.classList.remove("chosen");
            });
            //tilføj .valgt til den valgte
            this.classList.add("chosen");
            visArtikler();
        }

		function filterFavoritterArtikler() {
			console.log("filtrer makeup");
			filterFavoritter = this.dataset.favoritter;
             //fjern .valgt fra alle
            document.querySelectorAll(".filter-button").forEach(elm => {
                elm.classList.remove("chosen");
            });
            //tilføj .valgt til den valgte
            this.classList.add("chosen");
            visArtikler();
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
