<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

// Krijojme lidhjen me databazen
$conn = new mysqli($servername,$username,$password,$dbname);
// Testimi (kthim pergjigje)
if ($conn->connect_error)
{ 
die ("Lidhja deshtoi".$conn->connect_error);
}
echo "Lidhja u krye me sukses ";
// Afishojme personat qe ju fillon emri me E te renditur nga id-ja me e vogel tek me e madhja
$sql = "Select * from countries";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // shfaq rekordet per cdo rresht
  while($row = $result->fetch_assoc()) {
    echo "ID e shtetit:" . $row["COUNTRY_ID"].	" - Emri i Shtetit: " . $row["COUNTRY_NAME"]. " Id e zones: " . $row["REGION_ID"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>