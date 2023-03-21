<html>
<?php
class PeliculaCine
{
  //Feim la funció per a poder connectar-mos a la base de dades
  public function connectar_bd($servername, $username, $password)
  {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=Pelicules", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
    } catch (PDOException $e) {
      //echo "Connection failed2: " . $e->getMessage();
    }
    return $conn;
  }

  //Feim la funció per a poder inserir coses a dins de les taules
  public function inserir($servername, $username, $password, $datae, $ciutat, $peli)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {
      $conn = new PDO("mysql:host=$servername;dbname=Pelicules", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
    } catch (PDOException $e) {
      //echo "Connection failed2: " . $e->getMessage();
    }
    try {
      $sql = "INSERT INTO Peli_cine (data_hora,Cine_idCine,Pelicula_id) VALUES ('$datae', $ciutat, $peli)";
      // use exec() because no results are returned
      $conn->exec($sql);
      $last_id = $conn->lastInsertId();
    } catch (PDOException $e) {
      //echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  //Feim la funció per a fer els selects
  public function consultaTots($servername, $username, $password)
  {
    $conn = $this->connectar_bd($servername, $username, $password);

    try {
      $stmt = $conn->prepare("SELECT * FROM Peli_cine");
      $result = $stmt->execute();
      $conn = null;
      return ($stmt);
    } catch (PDOException $e) {
      // echo "Error: " . $e->getMessage();
    }
  }

  public function consultacartallera($servername, $username, $password, $datae, $ciutat)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {
      $stmt = $conn->prepare("SELECT peli.Titol, Peli_cine.data_hora
      FROM Pelicula as peli
      INNER JOIN Peli_cine on peli.id = Peli_cine.Pelicula_id
      WHERE Peli_cine.Cine_idCine = :ciutat and date(Peli_cine.data_hora) = :datae");
      $stmt->bindParam(':ciutat', $ciutat);
      $stmt->bindParam(':datae', $datae);
      $stmt->execute();
      $conn = null;
      return ($stmt);
    } catch (PDOException $e) {
      //echo "Error: " . $e->getMessage();
    }
  }

  // Feim la funció per a l'update
  function modificar($servername, $username, $password, $id, $datae, $ciutat, $peli)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {

      $sql = "UPDATE Peli_Genere SET Titol='$datae'
    WHERE id='$id'";

      // Prepare statement
      $stmt = $conn->prepare($sql);

      // execute the query
      $stmt->execute();
      $conn = null;
      // echo a message to say the UPDATE succeeded
      return $stmt->rowCount();
    } catch (PDOException $e) {
      //echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
  }

  //Feim la funció per a eliminar dades
  function eliminar($servername, $username, $password, $cine)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {

      // sql to delete a record
      $sql = "DELETE FROM Peli_cine WHERE Cine_idCine ='$cine'";
      $conn = $this->connectar_bd($servername, $username, $password);
      try {
        // sql to delete a record
        $sql = "DELETE FROM Peli_cine WHERE id='$cine'";
        $sql = "";
        // use exec() because no results are returned
        $conn->exec($sql);
      } catch (PDOException $e) {
        //echo $sql . "<br>" . $e->getMessage();
      }
      // use exec() because no results are returned
      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
  }
}
?>