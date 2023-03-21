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
  include "ClaseGenere.php";
  include "estils.php";

  //Definim les variables per a que estiguin buides
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";

  //Feim el control d'errors
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (
      $nameErr != "" or $emailErr != "" or $websiteErr != ""
      or $genderErr != ""
    ) //Hi ha errors
    {
      $gender = test_input($_POST["gender"]);
      $comment = test_input($_POST["comment"]);
      $website = test_input($_POST["website"]);
      $email = test_input($_POST["email"]);
      $name = test_input($_POST["name"]);
    } else  //Les dades són correctes
    {
      $client = new Genere();
      $client->inserir($servername, $username, $password, $name, $email, $website, $comment, $gender);
      $name = "";
      $email = "";
      $website = "";
      $comment = "";
      $gender = "";
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
    <p>Benvingut al sisé formulari de la base de dades "Pelicules", per a el treball "Projecte Pelicules", per a l'asignatura d'Implantació aplicacions web,
      Curs 22/23 i el grup IFC31B.</p>
    <br><br>
    <p>En aquesta pàgina podrás emplanar el cinqué formulari, "Alta Pelicula", on et demanaré que posis el nom del genere que vols implementar a dins de la base de dades</p>
    <img src="https://i0.wp.com/noescinetodoloquereluce.com/wp-content/uploads/2018/11/venom.gif?fit=780%2C439&ssl=1" alt="">
  </div>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p><span class="error">* = Obligatori</span></p>
    <h1>Formulari6 - Alta Genere</h1>
    Nom *: <input type="text" name="name" placeholder="Policiaca" value="<?php echo $name; ?>">
    <span class="error"><?php echo $nameErr; ?></span>
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