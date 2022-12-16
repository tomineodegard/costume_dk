<?php

get_header(); ?>

  <div id="content-wrap" class="container clr">
      <div id="primary" class="conent-area clr">
        <section class="single_sticky_section">
        <article id="skoenhed-artikel">
            <div class="article-container">
                <aside class="image-wrapper">
                    <img class="sticky_featuredimage" src="" alt="">
                </aside>

                <div class="text-wrapper">
                    <div class="header_container">
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
       

            <!-- <div class="pack-heading">
                <h3 class="pack-h3">Inspireret? Vi har fire fund til dig lige her...</h3>
            </div> -->
            <section id="pack-grid">
                <figure class="pack-wrap">
                <a href="#"><img class="packshot1" src="" alt=""></a>
                    <div class="packinfo">
                        <a href="#"><p class="packbrand1"></p></a>
                        <a href="#"><p class="packprice1"></p></a>
                    </div>
                </figure>

                <figure class="pack-wrap" >
                    <a href="#"><img class="packshot2" src="" alt=""></a>
                    <div class="packinfo">
                        <a href="#"><p class="packbrand2"></p></a>
                        <a href="#"><p class="packprice2"></p></a>
                    </div>
                </figure>

                <figure class="pack-wrap">
                    <a href="#"><img class="packshot3" src="" alt=""></a>
                    <div class="packinfo">
                        <a href="#"><p class="packbrand3"></p></a>
                        <a href="#"><p class="packprice3"></p></a>
                    </div>
                </figure>

                <figure class="pack-wrap">
                    <a href="#"><img class="packshot4" src="" alt=""></a>
                    <div class="packinfo">
                        <a href="#"><p class="packbrand4"></p></a>
                        <a href="#"><p class="packprice4"></p></a>
                       
                    </div>
                </figure>
            </section>
        </section>
     </div>
</div>



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



