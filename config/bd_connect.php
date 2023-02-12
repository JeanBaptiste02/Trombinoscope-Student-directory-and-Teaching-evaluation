<?php

$host = "postgresql-trombinoscope.alwaysdata.net";
$username = "trombinoscope";
$password = "Jbsrinih13*";
$dbname = "trombinoscope_db";

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
