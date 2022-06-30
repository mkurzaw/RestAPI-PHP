<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Wilg_glebyization, X-Requested-With');

  include_once '../../Config/Database.php';
  include_once '../../Model/Pomiar.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Pomiar($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->Temperatura = $data->Temperatura;
  $post->Wilg_powietrza = $data->Wilg_powietrza;
  $post->Wilg_gleby = $data->Wilg_gleby;
  $post->Id_rosliny = $data->Id_rosliny;

  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }