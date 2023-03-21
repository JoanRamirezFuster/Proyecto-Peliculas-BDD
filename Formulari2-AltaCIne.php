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
    include "ClaseCiutat.php";
    include "estils.php";

    //Definim les variables per a que estiguin buides
    $nameErr = $ciutatErr = "";
    $name = $id = $ciutat = "";

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

        if (empty($_POST["ciutat"])) {
            $Ciutat1Err = "La ciutat es obligatoria";
        } else {
            $ciutat = test_input($_POST["ciutat"]);
        }

        if (
            $nameErr != "" or $ciutatErr != ""
        ) //Hi ha errors
        {
            $ciutat = test_input($_POST["ciutat"]);
            $name = test_input($_POST["name"]);
        } else  //Les dades són correctes
        {
            $client = new Cine();
            $client->inserir($servername, $username, $password, $name, $ciutat);
            $name = "";
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
        <p>Benvingut al segon formulari de la base de dades "Pelicules", per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
            Curs 22/23 i el grup IFC31B.</p>
        <br><br>
        <p>En aquesta pàgina podrás emplanar el segon formulari, "Alta Cine", on et demanaré que posis el nom del cine i que elegesquis d'una llista la ciutat que vols implementar a dins de la base de dades</p>
        <img src="https://media.tenor.com/4F9nzIdYOVsAAAAC/wassup-scream.gif" alt="">
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* = Obligatori</span></p>
        <h1>Formulari2 - Alta Cine</h1>
        Nom *: <input type="text" name="name" placeholder="Multicines Manacor" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
        <br><br>
        <?php
        echo "Ciutat *:";
        echo "<select name='ciutat'>";
        $Ciutat2 = new Ciutat();
        $resultat = $Ciutat2->consultaTots("db", "root", "iesmanacor");
        $arrayValues = $resultat->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrayValues as $row) {
            echo "<option value='" . $row['idCiutat'] . "'>" .  $row['Nom'] . "</option>";
        }
        echo "</select>";
        ?>
        <span class="error"><?php echo $ciutatErr; ?></span>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Enviar">
        <br>
        <input type="reset" name="reset" value="Resetejar">
    </form>

    <!-- Feim l'include del footer -->
    <?php
    include "footer.php"
    ?>