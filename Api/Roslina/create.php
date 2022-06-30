<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Model/Roslina.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $Roslina = new Roslina($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $Roslina->gatunek = $data->gatunek;
  $Roslina->nazwa = $data->nazwa;
  $Roslina->min_temperatura = $data->min_temperatura;
  $Roslina->max_temperatura = $data->max_temperatura;
  $Roslina->min_wilgotnosc_gleby = $data->min_wilgotnosc_gleby;
  $Roslina->max_wilgotnosc_gleby = $data->max_wilgotnosc_gleby;
  $Roslina->min_wilgotnosc_powietrza = $data->min_wilgotnosc_powietrza;
  $Roslina->max_wilgotnosc_powietrza = $data->max_wilgotnosc_powietrza;
  // Create Roslina
  if($Roslina->create()) {
    echo json_encode(
      array('message' => 'Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Not Created')
    );
  }