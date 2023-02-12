<?php
     $titre = "Tests";
     $header = "header";
     $active_link="active-link";
     $active_link1="";
     require "./include/header.inc.php";
?>

        <main>

            <section style="padding-top:90px;">

                <?php

                    if (isset($_POST['submit'])) {
                        // Recuperation des donnees a partir du formulaire
                        $num_etu = $_POST['num_etu'];
                        $nom_etu = $_POST['nom_etu'];
                        $prenom_etu = $_POST['prenom_etu'];
                        $email_etu = $_POST['email_etu'];
                        $formation_id = $_POST['formation_id'];
                        $groupe_id = $_POST['groupe_id'];

                        // Connexion a la BD
                        $db = pg_connect("host=postgresql-trombinoscope.alwaysdata.net port=5432 dbname=trombinoscope_db user=trombinoscope password=Jbsrinih13*");

                        // Insertion dans la table etudiant
                        $query = "INSERT INTO etudiant (num_etu, nom_etu, prenom_etu, email_etu, formation_id, groupe_id) 
                                    VALUES ('$num_etu', '$nom_etu', '$prenom_etu', '$email_etu', '$formation_id', '$groupe_id')";
                        $result = pg_query($db, $query);

                        // verificarion des insertions des donnees
                        if (!$result) {
                            echo "insertion failed";
                        } else {
                            echo "insertion done";

                            // recuperation des donnees de l'image
                            $file = $_FILES['file'];
                            $file_name = $file['name'];
                            $file_tmp = $file['tmp_name'];
                            $file_size = $file['size'];
                            $file_error = $file['error'];
                            $file_type = $file['type'];

                            // verification du depot de l'image
                            if ($file_error === 0) {
                                $file_content = file_get_contents($file_tmp);
                                
                                // Insertion des données dans la table photos
                                $query = "INSERT INTO photos (data, usr_id) 
                                            VALUES ('$file_content', '$num_etu')";
                                $result = pg_query($db, $query);
                            
                                // verification des insertions des donnees
                                if (!$result) {
                                    echo "insertion failed";
                                } else {
                                    echo "insertion done";
                                }
                            } 
                            else {
                                echo "Depot de l'image failed !";
                            }
                        }
                    }

                ?>

            </section>  

        </main>

        

<?php
    require "./include/footer.inc.php";
?>
