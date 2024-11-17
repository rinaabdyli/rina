<?php
session_start(); // Nis sesionin
session_unset(); // Fshin të gjitha variablat e sesionit
session_destroy(); // Zhbën sesionin
header("Location: index.php"); // Ridrejton përdoruesin në faqen kryesore
exit();
?>
