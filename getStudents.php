<?php
  // Connexion à la base de données
  $conn = pg_connect("host=postgresql-trombinoscope.alwaysdata.net port=5432 dbname=trombinoscope_db user=trombinoscope password=Jbsrinih13*");

  // Nombre d'étudiants par page
  $studentsPerPage = 8;

  // Récupération des valeurs de formation et de groupe
  $form = (isset($_GET['formation_id']) && !empty($_GET['formation_id'])) ? $_GET['formation_id'] : '';
  $grp = (isset($_GET['group_id']) && !empty($_GET['group_id'])) ? $_GET['group_id'] : '';

  // Préparation de la clause WHERE
  $where = array();
  if ($form) {
    $where[] = "formation_id = '".strval($form)."'";;
  }
  if ($grp) {
    $where[] = "groupe_id = '".strval($grp)."'";
  }
  $whereClause = implode(" AND ", $where);
  if (!empty($whereClause)) {
    $whereClause = "WHERE " . $whereClause;
  }

  // Récupération du nombre total d'étudiants
  $result = pg_query($conn, "SELECT COUNT(*) FROM etudiant " . $whereClause);
  $totalStudents = pg_fetch_result($result, 0, 0);

  // Récupération de la page courante
  $currentPage = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;

  // Calcul du nombre total de pages
  $totalPages = ceil($totalStudents / $studentsPerPage);

  // S'assurer que la page courante est valide
  $currentPage = max(1, min($currentPage, $totalPages));

  // Calcul de l'index de départ pour la requête SQL
  $offset = ($currentPage - 1) * $studentsPerPage;

  // Récupération des étudiants pour la page courante
  $result = pg_query($conn, "SELECT * FROM etudiant " . $whereClause . " LIMIT " . strval($studentsPerPage) . " OFFSET " . strval($offset));
  $students = pg_fetch_all($result);

  // Envoi des données au format JSON
  header("Content-Type: application/json");
  echo json_encode(array(
    "totalPages" => $totalPages,
    "currentPage" => $currentPage,
    "students" => $students
  ));
  pg_close($conn);
?>