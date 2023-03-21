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
    include "menu.php";
    include "conexiobdd.php";
    include "ClasePelicula.php";
    include "estils.php";

    //Definim les variables per a que estiguin buides
    $nameErr = $dataeErr = $duradaErr = "";
    $name = $datae = $durada = "";

    //Feim el control d'errors
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "El nom de la ciutat es obligatori";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Nomes es poden posar lletres i espais en blanc";
            }
        }

        if (empty($_POST["datae"])) {
            $dataeErr = "La data es obligatoria";
        } else {
            $datae = test_input($_POST["datae"]);
        }

        if (empty($_POST["durada"])) {
            $duradaErr = "La durada es obligatoria";
        } else {
            $durada = test_input($_POST["durada"]);
        }

        if (
            $nameErr != "" or $dataeErr != "" or $duradaErr != ""
        ) //Hi ha errors
        {
            $name = test_input($_POST["name"]);
            $data = test_input($_POST["datae"]);
            $durada = test_input($_POST["durada"]);
        } else  //Les dades són correctes
        {
            $peli1 = new Pelicula();
            $peli1->inserir($servername, $username, $password, $name, $datae, $durada);
            $titol = "";
            $data = "";
            $durada = "";
        }
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
        <p>Benvingut al cinqué formulari de la base de dades "Pelicules", per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
            Curs 22/23 i el grup IFC31B.</p>
        <br><br>
        <p>En aquesta pàgina podrás emplanar el cinqué formulari, "Alta Pelicula", on et demanaré que posis el nom de la pelicula i la seva data d'estrena que vols implementar a dins de la base de dades</p>
        <img src="http://cdn.shopify.com/s/files/1/1541/8579/files/giphy_6_large.gif?v=1585104496" alt="">
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* = Obligatori</span></p>
        <h1>Formulari5 - Alta Pelicula</h1>
        Títol *: <input type="text" name="name" placeholder="Spiderman 2" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
        <br><br>
        Data Estrena *: <input type="date" name="datae" value="<?php echo $data; ?>">
        <span class="error"><?php echo $dataeErr; ?></span>
        <br><br>
        Durada * (En minuts): <input type="text" name="durada" placeholder="153" pattern="[0-9]{3}" value="<?php echo $durada; ?>">
        <span class="error"><?php echo $duradaErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Enviar">
        <br>
        <input type="reset" name="reset" value="Resetejar">
    </form>
    </form>

    <!-- Feim l'include del footer -->
    <?php
    include "footer.php"
    ?>