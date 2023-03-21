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
    include "ClasePeliculaGenere.php";
    include "ClasePelicula.php";
    include "ClaseGenere.php";
    include "estils.php";


    //Feim el control d'errors
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $peligenere1 = new PeliculaGenere();
            $peligenere1->inserir($servername, $username, $password, $_POST['genere'], $_POST['peli']);
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
        <p>Benvingut al quart formulari de la base de dades "Pelicules", per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
            Curs 22/23 i el grup IFC31B.</p>
        <br><br>
        <p>En aquesta pàgina podrás emplanar el quart formulari, "Alta Pelicula Genere", on et demanaré que posis el nom del genere i que elegesquis d'una llista la pelicula que vols implementar a dins de la base de dades</p>
        <img src="https://i.pinimg.com/originals/20/6d/9c/206d9c0b3524cef34a346a92180f0204.gif" alt="">
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* = Obligatori</span></p>
        <h1>Formulari4 - Alta Pelicula Genere</h1>
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
        </select>
        <br><br>
        <?php
        echo "Genere *:";
        echo "<select name='genere'>";
        $Genere2 = new Genere();
        $resultat = $Genere2->consultaTots("db", "root", "iesmanacor");
        $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrayValues as $row) {
            echo "<option value='" . $row['id'] . "'>" .  $row['Nom'] . "</option>";
        }
        echo "</select>";
        ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Enviar">
        <br>
        <input type="reset" name="reset" value="Resetejar">
    </form>
</body>

<!-- Feim l'include del footer -->
<?php
include "footer.php"
?>

</html>