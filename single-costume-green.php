<?php


get_header(); ?>

<section class="green-container whitespace">
        <!-- the content of the article tag is the html template for the individual single article -->

        <article id="green-artikel">
            <div class="article-container">
                <aside class="image-wrapper">
                    <img class="featuredimage" src="" alt="">
                </aside>

                <div class="text-wrapper">
                    <div class="article-header">
                        <h2 class="heading h2-single"></h2>
                        <h3 class="subheading h3-single"></h3>
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
        </section>
    

        <script>
            console.log("single view costume green");
            let article;
            const url = "https://tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/costume-green/"+<?php echo get_the_ID() ?>; 

            
            document.addEventListener("DOMContentLoaded", start);
            
            function start() {
                console.log("start function");
                getJson();
            }
            
            async function getJson() {
                const data = await fetch(url);
                article = await data.json();
                showArticles();
            }

            function showArticles() {
                document.querySelector(".heading").textContent = article.title.rendered;
                document.querySelector(".subheading").textContent = article.subheading;
                document.querySelector(".subheading").textContent = article.subheading;        
                document.querySelector(".publicationdate").textContent = article.publicationdate;
                document.querySelector(".articleauthor").textContent = "Af " + article.articleauthor;
                document.querySelector(".bodytext1").textContent = article.bodytext1;
                document.querySelector(".image1").src = article.image1.guid;

                document.querySelector(".bodytext2").textContent = article.bodytext2;
                document.querySelector(".image2").src = article.image2.guid;
                document.querySelector(".featuredimage").src = article.featuredimage.guid;
                }


            getJson();




            getJson();

        </script>
<?php get_footer(); ?>



