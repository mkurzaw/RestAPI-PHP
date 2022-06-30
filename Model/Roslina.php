<?php
  class Roslina {
    // DB Stuff
    private $conn;
    private $table = 'roslina';

    // Properties
    public $ID_roslina;
    public $gatunek;
    public $nazwa;
    public $min_temperatura;
    public $max_temperatura;
    public $min_wilgotnosc_gleby;
    public $max_wilgotnosc_gleby;
    public $min_wilgotnosc_powietrza;
    public $max_wilgotnosc_powietrza;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        ID_roslina,
        gatunek,
        nazwa,
        min_temperatura,
        max_temperatura,
        min_wilgotnosc_gleby,
        max_wilgotnosc_gleby,
        min_wilgotnosc_powietrza,
        max_wilgotnosc_powietrza
      FROM
        ' . $this->table . '
      ORDER BY
       ID_roslina DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT
        ID_roslina,
        gatunek,
        nazwa,
        min_temperatura,
        max_temperatura,
        min_wilgotnosc_gleby,
        max_wilgotnosc_gleby,
        min_wilgotnosc_powietrza,
        max_wilgotnosc_powietrza
        FROM
          ' . $this->table . '
      WHERE ID_roslina = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID_roslina
      $stmt->bindParam(1, $this->ID_roslina);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->ID_roslina = $row['ID_roslina'];
      $this->gatunek = $row['gatunek'];
      $this->nazwa = $row['nazwa'];
      $this->min_temperatura = $row['min_temperatura'];
      $this->max_temperatura = $row['max_temperatura'];
      $this->min_wilgotnosc_gleby = $row['min_wilgotnosc_gleby'];
      $this->max_wilgotnosc_gleby = $row['max_wilgotnosc_gleby'];
      $this->min_wilgotnosc_powietrza = $row['min_wilgotnosc_powietrza'];
      $this->max_wilgotnosc_powietrza = $row['max_wilgotnosc_powietrza'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      gatunek = :gatunek,
    
      nazwa = :nazwa,
      min_temperatura = :min_temperatura,
      max_temperatura = :max_temperatura,
      min_wilgotnosc_gleby = :min_wilgotnosc_gleby,
      max_wilgotnosc_gleby = :max_wilgotnosc_gleby,
      min_wilgotnosc_powietrza = :min_wilgotnosc_powietrza,
      max_wilgotnosc_powietrza = :max_wilgotnosc_powietrza';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->gatunek = htmlspecialchars(strip_tags($this->gatunek));
  $this->nazwa = htmlspecialchars(strip_tags($this->nazwa));
  $this->min_temperatura = htmlspecialchars(strip_tags($this->min_temperatura));
  $this->max_temperatura = htmlspecialchars(strip_tags($this->max_temperatura));
  $this->min_wilgotnosc_gleby = htmlspecialchars(strip_tags($this->min_wilgotnosc_gleby));
  $this->max_wilgotnosc_gleby = htmlspecialchars(strip_tags($this->max_wilgotnosc_gleby));
  $this->min_wilgotnosc_powietrza = htmlspecialchars(strip_tags($this->min_wilgotnosc_powietrza));
  $this->max_wilgotnosc_powietrza = htmlspecialchars(strip_tags($this->max_wilgotnosc_powietrza));
  

  // Bind data
  $stmt-> bindParam(':gatunek', $this->gatunek);
  $stmt-> bindParam(':nazwa', $this->nazwa);
  $stmt-> bindParam(':min_temperatura', $this->min_temperatura);
  $stmt-> bindParam(':max_temperatura', $this->max_temperatura);
  $stmt-> bindParam(':min_wilgotnosc_gleby', $this->min_wilgotnosc_gleby);
  $stmt-> bindParam(':max_wilgotnosc_gleby', $this->max_wilgotnosc_gleby);
  $stmt-> bindParam(':min_wilgotnosc_powietrza', $this->min_wilgotnosc_powietrza);
  $stmt-> bindParam(':max_wilgotnosc_powietrza', $this->max_wilgotnosc_powietrza);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
    gatunek = :gatunek,
    
    nazwa = :nazwa,
    min_temperatura = :min_temperatura,
    max_temperatura = :max_temperatura,
    min_wilgotnosc_gleby = :min_wilgotnosc_gleby,
    max_wilgotnosc_gleby = :max_wilgotnosc_gleby,
    min_wilgotnosc_powietrza = :min_wilgotnosc_powietrza,
    max_wilgotnosc_powietrza = :max_wilgotnosc_powietrza
      WHERE
      ID_roslina = :ID_roslina';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->ID_roslina = htmlspecialchars(strip_tags($this->ID_roslina));
  $this->gatunek = htmlspecialchars(strip_tags($this->gatunek));
  $this->nazwa = htmlspecialchars(strip_tags($this->nazwa));
  $this->min_temperatura = htmlspecialchars(strip_tags($this->min_temperatura));
  $this->max_temperatura = htmlspecialchars(strip_tags($this->max_temperatura));
  $this->min_wilgotnosc_gleby = htmlspecialchars(strip_tags($this->min_wilgotnosc_gleby));
  $this->max_wilgotnosc_gleby = htmlspecialchars(strip_tags($this->max_wilgotnosc_gleby));
  $this->min_wilgotnosc_powietrza = htmlspecialchars(strip_tags($this->min_wilgotnosc_powietrza));
  $this->max_wilgotnosc_powietrza = htmlspecialchars(strip_tags($this->max_wilgotnosc_powietrza));

  // Bind data
  $stmt-> bindParam(':gatunek', $this->gatunek);
  $stmt-> bindParam(':nazwa', $this->nazwa);
  $stmt-> bindParam(':min_temperatura', $this->min_temperatura);
  $stmt-> bindParam(':max_temperatura', $this->max_temperatura);
  $stmt-> bindParam(':min_wilgotnosc_gleby', $this->min_wilgotnosc_gleby);
  $stmt-> bindParam(':max_wilgotnosc_gleby', $this->max_wilgotnosc_gleby);
  $stmt-> bindParam(':min_wilgotnosc_powietrza', $this->min_wilgotnosc_powietrza);
  $stmt-> bindParam(':max_wilgotnosc_powietrza', $this->max_wilgotnosc_powietrza);
  $stmt-> bindParam(':ID_roslina', $this->ID_roslina);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE ID_roslina = :ID_roslina';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->ID_roslina = htmlspecialchars(strip_tags($this->ID_roslina));

    // Bind Data
    $stmt-> bindParam(':ID_roslina', $this->ID_roslina);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
  ?>