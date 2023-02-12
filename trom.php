<?php
     $titre = "Tests";
     $header = "header";
     $active_link="";
     $active_link1="active-link";
     require "./include/header.inc.php";
?>

        <main>

            <section>

                <div class="section-trombino">

                    <div class="menu">

                        <div class="box_filter">

                            <div class="service-icon">
                                <i class="ri-search-line"></i>
                            </div>

                            <input type="search" id="searchInput" name="search" placeholder="Entrez le nom d'un élève">
                        </div>

                        <?php
                            // Connexion à la base de données
                            $conn = pg_connect("host=postgresql-trombinoscope.alwaysdata.net port=5432 dbname=trombinoscope_db user=trombinoscope password=Jbsrinih13*");

                            // Requête SQL pour récupérer le nom de chaque formation
                            $result1 = pg_query($conn, "SELECT * FROM formations");

                            // Boucle pour afficher chaque nom de formation
                            echo "<div class = 'box_filter'> \n";

                                echo "<div class='service-icon'> \n";
                                    echo "<i class='ri-macbook-line'></i> \n";
                                echo "</div> \n";

                                echo "<select id='first'>  \n";
                                echo "<option value=''>Choisissez une filière</option> \n";
                                while ($row = pg_fetch_assoc($result1)) {
                                    echo "<option value='".$row['id']."'>".$row['nom_formation']."</option> \n";
                                }
                                echo "</select> \n";
                            echo "</div> \n";

                            pg_close($conn);
                          
                        ?>

                        <div class="box_filter">

                            <div class="service-icon">
                                <i class="ri-group-fill"></i>
                            </div>


                            <select id="second">
                                <option value="">Choisissez d'abord une filière</option>
                            </select>
                           


                        </div>
                       
                    </div>
                    
                    <div class="container-trombino">

                        <?php

                            // Connexion à la base de données
                            $conn = pg_connect("host=postgresql-trombinoscope.alwaysdata.net port=5432 dbname=trombinoscope_db user=trombinoscope password=Jbsrinih13*");

                            // Requête SQL pour récupérer les données des étudiants en fonction de la page courante
                            $result1 = pg_query($conn, "SELECT * FROM etudiant ORDER BY nom_etu, prenom_etu");

                            // Boucle pour afficher chaque etudiant
                            while ($row = pg_fetch_assoc($result1)) {
                                $str = "box";
                                $box = $row['formation_id']." ".$row['groupe_id']." ".$str;
                                echo "<div class='".$box."'> \n";
                                    $sub_res = pg_query($conn, "SELECT * FROM photos where usr_id = '".$row['num_etu']."'");
                                    $sub_row = pg_fetch_assoc($sub_res);
                                    echo "<div class='image'> \n";
                                        echo "<img src='".$sub_row['data']."' alt='photo de letudiant'> \n";
                                    echo "</div> \n";
                                    echo "<p class='etu'>".$row['nom_etu']." ".$row['prenom_etu']."</p> \n";

                                    $id_formation = $row['formation_id'];
                                    $result2 = pg_query($conn, "SELECT * FROM formations WHERE id = '".$id_formation."' ");
                                    $row1 = pg_fetch_assoc($result2);
                                    $nom_formation = $row1['nom_formation'];
                                    
                                    $id_groupe = $row['groupe_id'];
                                    $result3 = pg_query($conn, "SELECT * FROM groupes WHERE id = $id_groupe");
                                    $row2 = pg_fetch_assoc($result3);
                                    $nom_groupe = $row2['nom_groupe'];

                                    echo "<h2 class='etu_pr'>".$nom_formation." | ".$nom_groupe."</h2> \n";
                                    echo "<p class='etu_mail'>".$row['email_etu']."</p>";
                                echo "</div>";
                            }

                            // Fermeture de la connexion à la base de données
                            pg_close($conn);

                        ?>

                    <p class="error-message" style="display:none">Aucun résultat trouvé</p>


                </div>

                <div class="pagination"> 

                    <button class="btn" onclick="firstPage()">|<</button>
                    <button class="btn" onclick="previous()"><</button>
                    <span id="pageInfo"></span>
                    <button class="btn" onclick="nextPage()">></button>
                    <button class="btn" onclick="lastPage()">>|</button>          

                </div>

                <div>

                    <?php

                            // Connect to the database
                            $conn =  pg_connect("host=postgresql-trombinoscope.alwaysdata.net port=5432 dbname=trombinoscope_db user=trombinoscope password=Jbsrinih13*");

                            // Check if the file was uploaded
                            if (isset($_FILES['photo'])) {
                            // Get the file data
                            $photo = pg_escape_bytea(file_get_contents($_FILES['photo']['tmp_name']));
                            // Get the user ID
                            $usr_id = intval($_POST['usr_id']);
                            // Insert the photo data into the database
                            $query = "UPDATE photos SET data = '$photo' WHERE usr_id = '".$usr_id."' ";
                            pg_query($conn, $query);
                            }

                            // Check if the form was submitted
                            // if (isset($_POST['submit'])) {
                            //     // Get the file data
                            //     $photo = $_FILES['photo'];
                            //     $file_type = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));

                            //     // Check if the file is a valid image type
                            //     if ($file_type !== 'jpg' && $file_type !== 'jpeg' && $file_type !== 'png' && $file_type !== 'gif') {
                            //         echo 'Invalid file type';
                            //     } else {
                            //         // Get the user ID
                            //         $usr_id = intval($_POST['usr_id']);

                            //         // Escape the data
                            //         $escaped_photo = pg_escape_bytea(file_get_contents($photo['tmp_name']));
                            //         $escaped_usr_id = pg_escape_literal($usr_id);

                            //         // Insert the photo data into the database
                            //         $query = "UPDATE photos SET data = '$escaped_photo' WHERE usr_id = $escaped_usr_id";
                            //         pg_query($conn, $query);
                            //     }
                            // }
                            
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="photo">
                        <input type="text" name="usr_id" placeholder="Enter User ID">
                        <input type="submit" value="Upload Photo">
                    </form>

                    <?php
                    //    // Get the user ID
                    //     $usr_id = intval($_GET['usr_id']);

                    //     // Escape the user ID
                    //     $escaped_usr_id = pg_escape_literal($usr_id);

                    //     // Get the photo data from the database
                    //     $query = "SELECT data FROM photos WHERE usr_id = $escaped_usr_id";
                    //     $result = pg_query($conn, $query);

                    //     if (pg_num_rows($result) > 0) {
                    //     $photo_data = pg_fetch_result($result, 'data');
                    //     $decoded_photo = pg_unescape_bytea($photo_data);

                    //     // Display the photo
                        
                    //     echo "<div class='image'> \n";
                    //     echo "<img src='".$decoded_photo."' alt='photo de letudiant'> \n";
                    //     echo "</div> \n";
                    //     } else {
                    //     echo 'Photo not found';
                    //     }

                    ?>


                </div>

                <div class="pdf">
                    <!-- <a href="javascript:genPDF()">Télécharger le pdf</a> -->
                    <button onclick="generatePDF()">Télécharger le pdf</button>
<!-- 
                    <div class="wrapper">
                        <div id="contentToPrint">
                            <h1 style="font-size: 22px;">toto toto toto</h1>
                            <p style="font-size: 16px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer 
                            took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                            with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                            software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                            <img src="images/1.jpg" width="100%">
                            <p style="color: #dd9504; font-size: 18px; margin-top:20px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer  </p>
                        </div>
                    </div> -->
                </div>
            </section>  

        </main>

        

<?php
    require "./include/footer.inc.php";
?>
