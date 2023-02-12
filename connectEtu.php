<?php
     $titre = "Tests";
     $header = "header";
     $active_link="active-link";
     $active_link1="";
     require "./include/header.inc.php";
?>

        <main>

            <section>

                <article style="margin-top:80px;">

                    <h1 class="insc_etu"> INSCRIPTION - Espace Etudiants<h1>

                    <form action="insertDatasEtu.php" method="post" enctype="multipart/form-data">
                        <label for="num_etu">Numéro d'étudiant:</label>
                        <input type="text" id="num_etu" name="num_etu" required>
                        
                        <label for="nom_etu">Nom:</label>
                        <input type="text" id="nom_etu" name="nom_etu" required>
                        
                        <label for="prenom_etu">Prénom:</label>
                        <input type="text" id="prenom_etu" name="prenom_etu" required>
                        
                        <label for="email_etu">Adresse email:</label>
                        <input type="email" id="email_etu" name="email_etu" required>
                        
                        <label for="formation_id">ID de formation:</label>
                        <input type="text" id="formation_id" name="formation_id" required>
                        
                        <label for="groupe_id">ID de groupe:</label>
                        <input type="number" id="groupe_id" name="groupe_id" required>
                        
                        <label for="photo">Photo:</label>
                        <input type="file" id="photo" name="photo" required>

                        <input type="submit" value="Envoyer">
                    </form>


                </article>

            </section>  

        </main>

        

<?php
    require "./include/footer.inc.php";
?>
