<?php 
  class Pomiar {
    // DB stuff
    private $conn;
    private $table = 'pomiar';

    // Post Properties
    public $ID_pomiaru;
    public $Id_rosliny;
    public $nazwa_rosliny;
    public $Temperatura;
    public $Wilg_powietrza;
    public $Wilg_gleby;
    public $Godzina_pomiaru;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT r.nazwa as nazwa_rosliny, p.ID_pomiaru, p.Godzina_pomiaru, p.Id_rosliny ,p.Temperatura,p.Wilg_powietrza, p.Wilg_gleby
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                roslina r ON p.Id_rosliny=r.ID_roslina
                                ORDER BY
                                 p.Godzina_pomiaru DESC
                                 LIMIT 0,1';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT r.nazwa as nazwa_rosliny,p.Godzina_pomiaru, p.ID_pomiaru, p.Id_rosliny, p.Temperatura, p.Wilg_powietrza, p.Wilg_gleby
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      roslina r ON p.Id_rosliny = r.ID_roslina
                                    WHERE
                                      p.Id_rosliny = ?
                                    ORDER BY
                                      p.Godzina_pomiaru DESC
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->Id_rosliny);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->Temperatura = $row['Temperatura'];
          $this->Wilg_powietrza = $row['Wilg_powietrza'];
          $this->Wilg_gleby = $row['Wilg_gleby'];
          $this->Id_rosliny = $row['Id_rosliny'];
          $this->nazwa_rosliny = $row['nazwa_rosliny'];
    }
    public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . ' SET Temperatura = :Temperatura, Wilg_powietrza = :Wilg_powietrza, Wilg_gleby = :Wilg_gleby, Id_rosliny = :Id_rosliny';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->Temperatura = htmlspecialchars(strip_tags($this->Temperatura));
      $this->Wilg_powietrza = htmlspecialchars(strip_tags($this->Wilg_powietrza));
      $this->Wilg_gleby = htmlspecialchars(strip_tags($this->Wilg_gleby));
      $this->Id_rosliny = htmlspecialchars(strip_tags($this->Id_rosliny));

      // Bind data
      $stmt->bindParam(':Temperatura', $this->Temperatura);
      $stmt->bindParam(':Wilg_powietrza', $this->Wilg_powietrza);
      $stmt->bindParam(':Wilg_gleby', $this->Wilg_gleby);
      $stmt->bindParam(':Id_rosliny', $this->Id_rosliny);

      // Execute query
      if($stmt->execute()) {
        return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

  }