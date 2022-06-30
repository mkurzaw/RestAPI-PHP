<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Config/Database.php';
  include_once '../../Model/Pomiar.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Pomiar object
  $Pomiar = new Pomiar($db);

  // Blog Pomiar query
  $result = $Pomiar->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Pomiars
  if($num > 0) {
    // Pomiar array
    $Pomiars_arr = array();
    // $Pomiars_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Pomiar_item = array(
        'ID_pomiaru' => $ID_pomiaru,
        'Temperatura' => $Temperatura,
        'Wilg_gleby' => $Wilg_gleby,
        'Wilg_powietrza' => $Wilg_powietrza,
        'Id_rosliny' => $Id_rosliny,
        'nazwa_rosliny'=>$nazwa_rosliny
       // 'nazwa_rosliny' => $Pomiar->nazwa_rosliny
      );

      // Push to "data"
      array_push($Pomiars_arr, $Pomiar_item);
      // array_push($Pomiars_arr['data'], $Pomiar_item);
    }

    // Turn to JSON & output
    echo json_encode($Pomiars_arr);

  } else {
    // No Pomiars
    echo json_encode(
      array('message' => 'No Pomiars Found')
    );
  }
?>