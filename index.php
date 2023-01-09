<?php
    $titre = "Accueil - Trombinoscope";
    $header = "header";
    $active_link="active-link";
    $active_link1="";
    require "./include/header.inc.php";
?>
        
        <main class="main">
            <!--==================== HOME ====================-->
            <section class="home" id="home">
                <img src="https://blog.headway-advisory.com/wp-content/uploads/2018/06/Site-universitaire-de-Saint-Martin-UCP-Droits-universite%CC%81-de-Cergy-Pontoise.jpg" alt="" class="home__img">

                <div class="home__container container grid">
                    <div class="home__data">
                        <span class="home__data-subtitle" style="font-weight: bold;background-color: rgb(0 0 0 / 65%);border-radius: 20px 2px 1px;padding-left: 20px;color: deepskyblue;font-size: 20px;padding-right: 20px;">Trombinoscope - Licence Informatique</span>
                        <h1 class="home__data-title" style="    font-weight: bold;background-color: rgb(0 0 0 / 65%);border-radius: 0px 20px 20px;padding-left: 20px;">
                            Avec un compte sur ce site, vous pouvez vous faire identifier <br>par vos professeurs.
                        </h1>
                        <a href="#" class="button">Explore</a>
                    </div>
                </div>
            </section>
        </main>

<?php
    require "./include/footer.inc.php";
?>