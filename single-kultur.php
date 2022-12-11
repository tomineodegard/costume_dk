<?php


get_header(); ?>


    <main id="main" class="site-main">
        <section class="kultur-container">

            <article id="kultur-artikel">
                <img class="image" src="" alt="" />
                <h2 class="heading"></h2>
                <h2 class="category"></h2>
                <h3 class="subheading"></h3>
                <h4 class="publicationdate"></h4>
                <h4 class="type"></h4>
            </article>
        </section>
    </main>

        <script>
            console.log("single view kultur");
            let element;
            const url = "https://tomineodegard.dk/kea/eksamen/costume/wp-json/wp/v2/kultur/"+<?php echo get_the_ID() ?>; 

            async function getJson() {
                const data = await fetch(url);
                element = await data.json();
                showArticles();
            }

            function showArticles() {
                document.querySelector(".heading").textContent = element.title.rendered;
                document.querySelector(".category").textContent = element.categories.value;
                document.querySelector(".subheading").textContent = element.subheading;
                document.querySelector(".subheading").textContent = element.subheading;        
                document.querySelector(".publicationdate").textContent = element.publicationdate;
                document.querySelector(".type").textContent = element.type;
                }


            getJson();

        </script>

<?php get_footer(); ?>



