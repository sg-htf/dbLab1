<?php
$emriserverit="localhost";
$emriperdorues="root";
$fjalekalimi="";
//Lidhja me serverin
$lidhja = new mysqli($emriserverit,$emriperdorues,$fjalekalimi);
//Testimi i lidhjes
if ($lidhja->connect_error)
{
	die ("Lidhja nuk mund te kryhet".$lidhja->connect_error);
}
echo "Lidhja u krye";
?>