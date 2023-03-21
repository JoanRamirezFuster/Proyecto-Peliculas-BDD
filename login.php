<?php
session_start();
ob_start();

if (isset($_SESSION['username'])) {
    header("Location: menu.php");
    exit;
}

include 'menu.php';
include "conexiobdd.php";
include "estils.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connectar a la base de dades
    $servername = "db";
    $dbusername = "root";
    $dbpassword = "iesmanacor";
    $dbname = "Pelicules";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Comprovar si les dades d'autenticació són correctes
    $query = "SELECT * FROM usuaris WHERE nom_usuari = '$username' AND contrasenya = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Si les dades d'autenticació són correctes, crear una sessió per a l'usuari
        $_SESSION['username'] = $username;
        header("Location: menu.php");
        exit;
    } else {
        // Si les dades d'autenticació no són correctes, mostrar un missatge d'error
        $error_message = "El nom d'usuari o la contrasenya no són correctes.";
    }

    $conn->close();
}
?>

<body>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post">
        <h1>Inici de sessió</h1>
        <label for="username">Nom d'usuari:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Iniciar sessió">
    </form>
</body>

</html>