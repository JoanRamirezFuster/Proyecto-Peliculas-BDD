<?php
session_start();
// Comprovar si l'usuari ha iniciat sessió
if (!isset($_SESSION['username'])) {
    // Si l'usuari no ha iniciat sessió, redirigir-lo a la pàgina de login
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE HTML>
<html>

<body>
  <?php
  //Feim els includes per a que els formularis tenguin el menu, la conexió a la base de dades i els estils
  include 'menu.php';
  include "conexiobdd.php";
  include "ClaseCine.php";
  include "ClasePelicula.php";
  include "ClasePeliculaCine.php";
  include "estils.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
      $cartellera = new Pelicula();
      $id_pelicula = $_POST['id'];
      $cartellera->eliminar($servername, $username, $password, $id_pelicula);
      echo "Pelicula con id=" . $id_pelicula . " eliminada";
    } else {
      $cartallera = new Pelicula();
      $data_estrena = test_input($_POST["data"]);
      $consulta = $cartallera->consultaTots($servername, $username, $password, $_POST['data_estrena'], $_POST['Titol'], $_POST['id']);
      echo "<table>";
      echo "<tr><th>Titol</th><th>Data estrena</th><th>Elimina</th><th>Modifica</th></tr>";
      foreach ($consulta as $fila) {
        echo "<tr>";
        echo "<td>" . $fila['Titol'] . "</td>";
        echo "<td>" . $fila['data_estrena'] . "</td>";
        echo "<td><form method='POST' action='" . $_SERVER['PHP_SELF'] . "'><input type='hidden' name='id' value='" . $fila['id'] . "'><input type='hidden' name='action' value='delete'><button id='boton-eliminar' type='submit'>Eliminar</button></form></td>";
        echo "<td><form method='GET' action='Formulari8-ModificarCartallera.php'><input type='hidden' name='id' value='" . $fila['id'] . "'><button id='boton-modificar' type='submit'>Modificar</button></form></td>";
        echo "</tr>";
      }
      echo "</table>";
    }
  } else {
    echo "<tr><td colspan='3'>No s'han trobat resultats</td></tr>";
  }
  echo "</table>";

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <!-- Cream el formulari -->
  <div class="intro">
    <h1>Benvingut!</h1>
    <p>Benvingut al formulari de cerca cartallera, per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
      Curs 22/23 i el grup IFC31B.</p>
    <br><br>
    <p>En aquesta pàgina podrás emplanar el seté formulari, "Cerca Cartallera", on podrás cercar la cartallera d'un cine i d'una data especifica i després, podrás o be borrar la cartallera o be modificar-la</p>
    <img src="https://canalhollywood.es/wp-content/uploads/2016/12/SoloEnCasa_Navidad.gif" alt="">
  </div>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p><span class="error">* = Obligatori</span></p>
    <h1>Formulari 7 - Cerca Cartallera</h1>
    <br><br>
    <?php
    echo "Data *:";
    echo "<select name='data'>";
    echo "<option value='' selected>Selecciona la data:</option>";
    $Pelicula2 = new Pelicula();
    $resultat = $Pelicula2->consultaTots("db", "root", "iesmanacor");
    $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
    foreach ($arrayValues as $row) {
      $selected = ($_POST['data'] == $row['data_estrena']) ? "selected" : "";
      echo "<option value='" . $row['Titol'] . "'$selected>" .  $row['data_estrena'] . "</option>";
    }
    echo "</select>";
    ?>
    <br><br>
    <?php
    echo "Cine *:";
    echo "<select name='cine'>";
    $Cine2 = new Cine();
    $resultat = $Cine2->consultaTots("db", "root", "iesmanacor");
    $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
    foreach ($arrayValues as $row) {
      $selected = "";
      if (isset($_POST['cine']) && $_POST['cine'] == $row['idCine']) {
        $selected = "selected";
      }
      echo "<option value='" . $row['idCine'] . "' " . $selected . ">" .  $row['Nom'] . "</option>";
    }
    echo "</select>";
    ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Enviar">
    <br>
    <input type="reset" name="reset" value="Resetejar" onclick="location.href = '<?php echo $_SERVER['PHP_SELF']; ?>'">

  </form>
</body>

<!-- Feim l'include del footer -->
<?php
include "footer.php"
?>

</html>