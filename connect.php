<?php
     $titre = "Tests";
     $header = "header";
     $active_link="";
     $active_link3="active-link";
     require "./include/header.inc.php";
?>

        <main>

            <section>

                <article style="margin-top:-80px;">

                    <center>
                    <div class="section">
                        <div class="container">
                            <div class="row full-height justify-content-center">
                                <div class="col-12 text-center align-self-center py-5">
                                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                        <h6 class="mb-0 pb-3" style="color:black;" id="insc_etu"><span>Espace Etudiants /</span><span> Espace Enseignants</span></h6>
                                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                                        <label for="reg-log"></label>
                                        <div class="card-3d-wrap mx-auto">
                                            <div class="card-3d-wrapper">
                                                <div class="card-front">
                                                    <div class="center-wrap">
                                                        <div class="section text-center">
                                                            <h4 class="mb-4 pb-3" style="color:white; margin-top: -80px; padding-bottom: 70px; font-size: 25px;">Espace Etudiants</h4>
                                                            <div class="form-group">
                                                                <input type="email" name="logemail" class="form-style" placeholder="Mail" id="logemail" autocomplete="off" style="margin-bottom:15px;">
                                                                <i class="input-icon uil uil-at"></i>
                                                            </div>	
                                                            <div class="form-group mt-2">
                                                                <input type="password" name="logpass" class="form-style" placeholder="Mot de Passe" id="logpass" autocomplete="off" style="margin-bottom:15px;">
                                                                <i class="input-icon uil uil-lock-alt"></i>
                                                            </div>
                                                            <div class="middle">
                                                                <a href="" class="btn btn1">Soumettre</a>
                                                            </div>    
                                                            <p class="mb-0 mt-4 text-center" style="color:blue;"><a href="connectEtu.php" class="link">Pas de compte ? Inscrivez-vous</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-back">
                                                    <div class="center-wrap">
                                                        <div class="section text-center">
                                                        <h4 class="mb-4 pb-3" style="color:white; margin-top: -80px; padding-bottom: 70px; font-size: 25px;">Espace Enseignants</h4>
                                                            <div class="form-group">
                                                                <input type="email" name="logemail" class="form-style" placeholder="Mail" id="logemail" autocomplete="off" style="margin-bottom:15px;">
                                                                <i class="input-icon uil uil-at"></i>
                                                            </div>	
                                                            <div class="form-group mt-2">
                                                                <input type="password" name="logpass" class="form-style" placeholder="Mot de Passe" id="logpass" autocomplete="off" style="margin-bottom:15px;">
                                                                <i class="input-icon uil uil-lock-alt"></i>
                                                            </div>
                                                            <div class="middle">
                                                                <a href="" class="btn btn1">Soumettre</a>
                                                            </div>    
                                                            <p class="mb-0 mt-4 text-center" style="color:blue;"><a href="connectEns.php" class="link">Pas de compte ? Inscrivez-vous</a></p>
                                                            </div>                                                                
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </center>
                </article>

            </section>  

        </main>

        

<?php
    require "./include/footer.inc.php";
?>
