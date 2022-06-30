<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Config/Database.php';
  include_once '../../Model/Roslina.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog roslina object
  $roslina = new Roslina($db);

  // Get ID
  $roslina->ID_roslina = isset($_GET['ID_roslina']) ? $_GET['ID_roslina'] : die();

  // Get post
  $roslina->read_single();

  // Create array
  $roslina_arr = array(
    'ID_roslina' => $roslina->ID_roslina,
    'nazwa' => $roslina->nazwa,
    'gatunek' => $roslina->gatunek,
    'min_temperatura' => $roslina->min_temperatura,
    'max_temperatura' => $roslina->max_temperatura,
    'min_wilgotnosc_gleby' => $roslina->min_wilgotnosc_gleby,
    'max_wilgotnosc_gleby'=> $roslina->min_wilgotnosc_gleby,
    'min_wilgotnosc_powietrza' => $roslina->min_wilgotnosc_powietrza,
    'max_wilgotnosc_powietrza' => $roslina->max_wilgotnosc_powietrza
  );

  // Make JSON
  print_r(json_encode($roslina_arr));