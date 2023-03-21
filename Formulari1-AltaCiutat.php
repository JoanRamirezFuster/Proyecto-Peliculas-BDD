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
    include "ClaseCiutat.php";
    include "estils.php";

    //Definim les variables per a que estiguin buides
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

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

        if (
            $nameErr != ""
        ) //Hi ha errors
        {
            $name = test_input($_POST["name"]);
        } else //Les dades són correctes
        {
            $client = new Ciutat();
            $client->inserir($servername, $username, $password, $name);
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
        <p>Benvingut al primer formulari de la base de dades "Pelicules", per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
            Curs 22/23 i el grup IFC31B.</p>
        <br><br>
        <p>En aquesta pàgina podrás emplanar el primer formulari, "Alta Ciutat", on et demanaré que posis el nom de la ciutat que vols implementar a dins de la base de dades</p>
        <img src="https://media.tenor.com/9O0URkk1kjYAAAAC/spongebob-squarepants-patrick-star.gif" alt="">
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* = Obligatori</span></p>
        <h1>Formulari1 - Alta Ciutat</h1>
        <br><br>
        Nom *: <input type="text" name="name" placeholder="Manacor" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Enviar">
        <br>
        <input type="reset" name="reset" value="Resetejar">
    </form>

    <!-- Feim l'include del footer -->
    <?php
    include "footer.php"
    ?>