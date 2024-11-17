<?php
// Kontrollo nëse sesioni është aktiv
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Krijo lidhjen me bazën e të dhënave
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pprojekti";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
