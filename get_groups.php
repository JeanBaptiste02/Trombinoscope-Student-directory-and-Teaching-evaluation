<?php

    // Connexion à la base de données
    $conn = pg_connect("host=postgresql-trombinoscope.alwaysdata.net port=5432 dbname=trombinoscope_db user=trombinoscope password=Jbsrinih13*");

    // Récupération de l'ID de la formation selectionné à partir des données envoyées via POST
    $formation_id = $_POST['formation_id'];

    // Requête SQL pour récupérer les groupes associés à la formation sélectionnée
    $result = pg_query($conn, "SELECT * FROM groupes where formation_id = '$formation_id'");

    // Boucle pour stocker les groupes dans un tableau
    $groupes = array();
    while ($row = pg_fetch_assoc($result)) {
        array_push($groupes, array(
            "id" => $row['id'],
            "nom_groupe" => $row['nom_groupe']
        ));
    }
    
    pg_close($conn);

    // Renvoi des données en JSON
    echo json_encode($groupes);

  


?>