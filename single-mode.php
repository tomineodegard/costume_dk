
<?php

// $embed = get_field("embed_instagram");

get_header(); ?>

  
<section class="mode-container article-container">
        <!-- the content of the article tag is the html template for the individual single article -->

        <article id="mode-artikel">
            <div class="article-inner">
                <aside class="image-wrapper">
                    <img class="featuredimage" src="" alt="">
                </aside>

                <div class="text-wrapper">
                    <div class="article-header">
                        <h1 class="heading h2-single"></h1>
                        <h3 class="subheading h3-single"></h3>
                        <div class="author_and_date">
                            <p class="publicationdate p2"></p>
                            <p>-</p>
                            <p class="articleauthor p2"></p>
                        </div>
                        
                    </div>
                    <div class="article-content">
                        <p class="bodytext1"></p>
                        <div class="two-pack-grid">
                            <div class="pack-left">
                                <img class="pack1" id="pack-image" src="" alt="">
                                <p class="pack-description1"></p>
                            </div>
                            <div class="pack-right">
                                <img class="pack2" id="pack-image" src="" alt="">
                                <p class="pack-description2"></p>
                            </div>
                        </div>

                        <div class="two-pack-grid">
                            <div class="pack-left">
                                <img class="pack3" id="pack-image" src="" alt="">
                                <p class="pack-description3"></p>
                            </div>
                            <div class="pack-right">
                                <img class="pack4" id="pack-image" src="" alt="">
                                <p class="pack-description4"></p>
                            </div>
                        </div>

                        <p class="bodytext2"></p>

                    </div>
                </div>
            </div>
            </article>
        </section>

        <script>
            console.log("single view mode");
            let article;
            const url = "https://tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/mode/"+<?php echo get_the_ID() ?>; 

            document.addEventListener("DOMContentLoaded", start);
		
		    function start() {
		        console.log("start function");
			    getJson();
		    }

            
            async function getJson() {
                const response = await fetch(url);
                article = await response.json();
                showArticles();
            }

            function showArticles() {
                document.querySelector(".heading").textContent = article.title.rendered;
                document.querySelector(".subheading").textContent = article.subheading;
                document.querySelector(".subheading").textContent = article.subheading;        
                document.querySelector(".publicationdate").textContent = article.publicationdate;
                document.querySelector(".articleauthor").textContent = "Af " + article.articleauthor;
                document.querySelector(".bodytext1").textContent = article.bodytext1;

                document.querySelector(".pack1").src = article.pack1.guid;
                document.querySelector(".pack-description1").textContent = article.packdescription1;

                document.querySelector(".pack2").src = article.pack2.guid;
                document.querySelector(".pack-description2").textContent = article.packdescription2;

                document.querySelector(".pack3").src = article.pack3.guid;
                document.querySelector(".pack-description3").textContent = article.packdescription3;

                document.querySelector(".pack4").src = article.pack4.guid;
                document.querySelector(".pack-description4").textContent = article.packdescription4;

                document.querySelector(".featuredimage").src = article.featuredimage.guid;
                }

        </script>

<?php get_footer(); ?>
