<html>
<?php
class Pelicula
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
      echo "Connection failed2: " . $e->getMessage();
    }
    return $conn;
  }

  //Feim la funció per a poder inserir coses a dins de les taules
  public function inserir($servername, $username, $password, $titol, $data_estrena, $durada)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {
      $conn = new PDO("mysql:host=$servername;dbname=Pelicules", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch (PDOException $e) {
      echo "Connection failed2: " . $e->getMessage();
    }
    try {
      $sql = "INSERT INTO Pelicula (Titol, data_estrena, durada) VALUES ('$titol', '$data_estrena', '$durada')";
      // use exec() because no results are returned
      $conn->exec($sql);
      $last_id = $conn->lastInsertId();
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  //Feim la funció per a fer els selects
  public function consultaTots($servername, $username, $password)
  {
    $conn = $this->connectar_bd($servername, $username, $password);

    try {
      $stmt = $conn->prepare("SELECT * FROM Pelicula");
      $result = $stmt->execute();
      $conn = null;
      return ($stmt);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  //Funció per a modificar les dades
  function modificar($servername, $username, $password, $id, $titol, $datae, $durada)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {

      $sql = "UPDATE Pelicula SET Titol='$titol', data_estrena='$datae', durada='$durada' WHERE id='$id'";

      // Prepare statement
      $stmt = $conn->prepare($sql);

      // execute the query
      $stmt->execute();
      $conn = null;
      // echo a message to say the UPDATE succeeded
      return $stmt->rowCount();
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
  }

  //Feim la funció per a fer el delete
  function eliminar($servername, $username, $password, $id)
  {
    $conn = $this->connectar_bd($servername, $username, $password);
    try {

      // sql to delete a record
      $sql = "DELETE FROM Pelicula WHERE id='$id'";

      // use exec() because no results are returned
      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
  }
}
?>