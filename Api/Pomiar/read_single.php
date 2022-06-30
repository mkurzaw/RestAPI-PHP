<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Config/Database.php';
  include_once '../../Model/Pomiar.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Pomiar($db);

  // Get ID
  $post->id = isset($_GET['Id_pomiaru']) ? $_GET['ID_pomiaru'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    
    'ID_pomiaru' => $post->ID_pomiaru,
    'Godzina_pomiaru' => $post->Godzina_pomiaru,
    'Temperatura' => $post->Temperatura,
    'Wilg_gleby' => $post->Wilg_gleby,
    'Wilg_powietrza' => $post->Wilg_powietrza,
    'Id_rosliny' => $post->Id_rosliny,
    'nazwa_rosliny' => $post->nazwa_rosliny
  );

  // Make JSON
  print_r(json_encode($post_arr));