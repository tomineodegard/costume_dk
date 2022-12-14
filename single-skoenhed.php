<?php

get_header(); ?>

  
        <section class="single_sticky_section">
        <article id="skoenhed-artikel">
            <div class="article-container">
                <aside class="image-wrapper">
                    <img class="sticky_featuredimage" src="" alt="">
                </aside>

                <div class="text-wrapper">
                    <div class="header_container">
                        <p class="is_category"></p>
                        <p class="is_green"></p>
                        <h1 class="heading h1-single"></h1>
                        <h2 class="subheading h2-single"></h2>
                        <div class="author_and_date">
                            <p class="publicationdate p2"></p>
                            <p>-</p>
                            <p class="articleauthor p2"></p>
                        </div>
                    </div>

                    <div class="article-content">
                        <p class="bodytext1"></p>
                        <img class="image1" src="" alt="">

                        <p class="bodytext2"></p>
                        <img class="image2" src="" alt="">
                    </div>
                </div>
            </div>
            </article>
       

            <section id="pack-grid">
                <figure class="pack-wrap">
                    <img class="packshot1" src="" alt="">
                    <div class="packinfo">
                        <p class="packbrand1"></p>
                        <p class="packprice1"></p>
                    </div>
                </figure>

                <figure class="pack-wrap" >
                    <img class="packshot2" src="" alt="">
                    <p class="packbrand2"></p>
                    <p class="packprice2"></p>
                </figure>

                <figure class="pack-wrap">
                    <img class="packshot3" src="" alt="">
                    <p class="packbrand3"></p>
                    <p class="packprice3"></p>
                </figure>

                <figure class="pack-wrap">
                    <img class="packshot4" src="" alt="">
                    <p class="packbrand4"></p>
                    <p class="packprice4"></p>
                </figure>
            </section>
        </section>



        <script>
            console.log("single view skoenhed");
            let article;
            const url = "https://tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/skoenhed/"+<?php echo get_the_ID() ?>; 


            document.addEventListener("DOMContentLoaded", start);
		
		    function start() {
		        console.log("start function");
			    getJson();
		    }

            
            async function getJson() {
                const response = await fetch(url);
                article = await response.json();
                showSingleArticle();
            }

            function showSingleArticle() {
                console.log(article);

                document.querySelector(".is_category").textContent = article.skoenheds_kategorier;
                document.querySelector(".heading").textContent = article.title.rendered;
                document.querySelector(".subheading").textContent = article.subheading;
                document.querySelector(".subheading").textContent = article.subheading;        
                document.querySelector(".publicationdate").textContent = article.publicationdate;
                document.querySelector(".articleauthor").textContent = "Af " + article.articleauthor;
                document.querySelector(".bodytext1").textContent = article.bodytext1;
                document.querySelector(".image1").src = article.image1.guid;

                document.querySelector(".bodytext2").textContent = article.bodytext2;
                document.querySelector(".image2").src = article.image2.guid;
                document.querySelector(".sticky_featuredimage").src = article.featuredimage.guid;

                document.querySelector(".packshot1").src = article.packshot1.guid;
                document.querySelector(".packbrand1").textContent = article.packbrand1;
                document.querySelector(".packprice1").textContent = article.packprice1;

                document.querySelector(".packshot2").src = article.packshot2.guid;
                document.querySelector(".packbrand2").textContent = article.packbrand2;
                document.querySelector(".packprice2").textContent = article.packprice2;

                document.querySelector(".packshot3").src = article.packshot3.guid;
                document.querySelector(".packbrand3").textContent = article.packbrand3;
                document.querySelector(".packprice3").textContent = article.packprice3;

                document.querySelector(".packshot4").src = article.packshot4.guid;
                document.querySelector(".packbrand4").textContent = article.packbrand4;
                document.querySelector(".packprice4").textContent = article.packprice4;
            }


        </script>



<?php get_footer(); ?>



