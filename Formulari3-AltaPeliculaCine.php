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
    include "ClasePeliculaCine.php";
    include "ClaseCine.php";
    include "ClasePelicula.php";
    include "estils.php";

    //Feim el control d'errors
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pelicine1 = new PeliculaCine();
        $pelicine1->inserir($servername, $username, $password, $_POST['datae'], $_POST['cine'], $_POST['peli']);
    }

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
        <p>Benvingut al tercer formulari de la base de dades "Pelicules", per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
            Curs 22/23 i el grup IFC31B.</p>
        <br><br>
        <p>En aquesta pàgina podrás emplanar el tercer formulari, "Alta Pelicula Cine", on et demanaré que posis la data, el nom de la ciutat i que elegesquis d'una llista la pelicula que vols implementar a dins de la base de dades</p>
        <img src="https://media.tenor.com/gmhe9WWjZtcAAAAC/shining-movie.gif" alt="">
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* = Obligatori</span></p>
        <h1>Formulari3 - Alta Pelicula Cine</h1>
        Data*: <input type="date" name="datae" value="<?php echo $data; ?>">
        <span class="error"><?php echo $dataeErr; ?></span>
        <br><br>
        <?php
        echo "Cine *:";
        echo "<select  name='cine'>";
        $Cine2 = new Cine();
        $resultat = $Cine2->consultaTots("db", "root", "iesmanacor");
        $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrayValues as $row) {
            echo "<option value='" . $row['idCine'] . "'>" .  $row['Nom'] . "</option>";
        }
        echo "</select>";
        ?>
        <span class="error"><?php echo $Ciutat1Err; ?></span>
        </select>
        <br><br>
        <?php
        echo "Pelicula *:";
        echo "<select  name='peli'>";
        $Pelicula2 = new Pelicula();
        $resultat = $Pelicula2->consultaTots("db", "root", "iesmanacor");
        $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrayValues as $row) {
            echo "<option value='" . $row['id'] . "'>" .  $row['Titol'] . "</option>";
        }
        echo "</select>";
        ?>
        <span class="error"><?php echo $Pelicula1Err; ?></span>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Enviar">
        <br>
        <input type="reset" name="reset" value="Resetejar">
    </form>
    </form>
</body>

<!-- Feim l'include del footer -->
<?php
include "footer.php"
?>

</html>