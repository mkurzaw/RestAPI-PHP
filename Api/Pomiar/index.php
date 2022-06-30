

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontola_roslin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connection Success!<br><br>";
$PlantID = $_GET["ID"];
$SoilHumidity = $_GET["SoilHumidity"];
$AirHumidity = $_GET["AirHumidity"];
$Temperature = $_GET["Temperature"];


$query = "INSERT INTO pomiar (ID_rosliny, Wilg_gleby, Wilg_powietrza, Temperatura) VALUES ('$PlantID','$SoilHumidity', '$AirHumidity', '$Temperature')";
$result = $conn->query($query);

echo "Insertion Success!<br>";
$conn->close();
?>
