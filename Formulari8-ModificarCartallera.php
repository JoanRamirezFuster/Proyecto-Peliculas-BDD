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

    // definir variables valors nulls
    $id = $titol = $datae = $durada = "";

    // una vegada enviat el formulari utilitza la fucio modificar amb els valors de les variables del formulari
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = test_input($_POST["id"]);
        $titol = test_input($_POST["titol"]);
        $datae = test_input($_POST["datae"]);
        $durada = test_input($_POST["durada"]);

        $peli1 = new Pelicula();
        $peli1->modificar($servername, $username, $password, $id, $titol, $datae, $durada);
        $id = "";
        $titol = "";
        $datae = "";
        $durada = "";
    }

    function test_input($id)
    {
        $id = trim($id);
        $id = stripslashes($id);
        $id = htmlspecialchars($id);
        return $id;
    }
    ?>

</html>
<div class="intro">
    <h1>Benvingut!</h1>
    <p>Benvingut al formulari de modificar cartallera, per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
        Curs 22/23 i el grup IFC31B.</p>
    <br><br>
    <p>En aquesta pàgina podrás emplanar el seté formulari, "Modificar Cartallera", on podrás eliminar la pelicula d'un cine i d'una data especifica</p>
    <img src="https://j.gifs.com/Z6MLOl.gif" alt="">
</div>

<!--Feim el formualari-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Formulari 8 - Modificar Cartellera</h2>
    Id de la pelicula a modificar: <input type="int" name="id" value="<?php echo $id; ?>">
    <br><br>
    Titol (Nou): <input type="text" name="titol" value="<?php echo $titol; ?>">
    <span class="error"><?php echo $nameErr; ?></span>
    <br><br>
    Data Estrena (Nou): <input type="date" name="datae" value="<?php echo $datae; ?>">
    <span class="error"><?php echo $dataeErr; ?></span>
    <br><br>
    Durada (En minuts) (Nou): <input type="text" name="durada" pattern="[0-9]{3}" value="<?php echo $durada; ?>">
    <span class="error"><?php echo $duradaErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Modifica">
</form>
</body>

<!-- Feim l'include del footer -->
<?php
include "footer.php"
?>

</html>