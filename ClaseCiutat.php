<html>
<?php
class Ciutat
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
    public function inserir($servername, $username, $password, $nom)
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
            $sql = "INSERT INTO Ciutat (Nom) VALUES ('$nom')";
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
            $stmt = $conn->prepare("SELECT * FROM Ciutat");
            $result = $stmt->execute();
            $conn = null;
            return ($stmt);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Feim la funció per a l'update
    function modificar($servername, $username, $password, $id, $nom)
    {
        $conn = $this->connectar_bd($servername, $username, $password);
        try {

            $sql = "UPDATE Ciutat SET Nom='$nom'
    WHERE idCiutat ='$id'";

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
            $sql = "DELETE FROM Ciutat WHERE idCiutat ='$id'";

            // use exec() because no results are returned
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
    }
}
?>