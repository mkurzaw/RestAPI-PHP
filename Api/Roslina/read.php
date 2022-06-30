<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Config/Database.php';
  include_once '../../Model/Roslina.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate roslina object
  $roslina = new Roslina($db);

  // roslina read query
  $result = $roslina->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'ID_roslina' => $ID_roslina,
            'nazwa' => $nazwa,
            'gatunek' => $gatunek,
            'min_temperatura' => $min_temperatura,
            'max_temperatura' => $max_temperatura,
            'min_wilgotnosc_gleby' => $min_wilgotnosc_gleby,
            'max_wilgotnosc_gleby'=> $max_wilgotnosc_gleby,
            'min_wilgotnosc_powietrza' => $min_wilgotnosc_powietrza,
            'max_wilgotnosc_powietrza' => $max_wilgotnosc_powietrza
          );

          // Push to "data"
          array_push($cat_arr['data'], $cat_item);
        }

        // Turn to JSON & output
        echo json_encode($cat_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Found')
        );
  }
?>