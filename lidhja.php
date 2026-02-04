<?php
$emriserverit = "localhost";
$emriperdorues = "root";
$fjalekalimi = "";
$database = "projekt";

// Lidhja me serverin dhe databazen
$lidhja = new mysqli($emriserverit, $emriperdorues, $fjalekalimi, $database);

// Testimi i lidhjes
if ($lidhja->connect_error) {
	die("Lidhja nuk mund te kryhet: " . $lidhja->connect_error);
}
?>