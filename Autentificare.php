<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'claudia1';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER,$DATABASE_PASS, $DATABASE_NAME);
       if ( mysqli_connect_errno() ) {
             exit('Failed to connect to MySQL: ' . mysqli_connect_error());}
         // Acum verificăm dacă datele din formularul de autentificare au fost trimise, isset () va verifica dacă datele există.
       if ( !isset($_POST['username'], $_POST['password']) ) {
             exit('Completati username si password !');}

if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
// Parametrii de legare (s = șir, i = int, b = blob etc.), în cazul nostru numele de utilizator este un șir, //așa că vom folosi „s”
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();
// Stocați rezultatul astfel încât să putem verifica dacă contul există în baza de date.
$stmt->store_result();
if ($stmt->num_rows > 0) {
$stmt->bind_result($id, $password);
$stmt->fetch();

// Contul există, acum verificăm parola.
if (password_verify($_POST['password'], $password)) {
// Creați sesiuni, astfel încât să știm că utilizatorul este conectat, acestea acționează practic ca cookie-//uri, dar rețin datele de pe server.
session_regenerate_id();
$_SESSION['loggedin'] = TRUE;
$_SESSION['nume'] = $_POST['username'];
$_SESSION['id'] = $id;
echo 'Bun venit! ' . $_SESSION['nume'] . '!';
header('Location: magazin_claudia.php');
} else {
// password incorrect
echo 'Parola incorecta!';
}
} else {
// username incorect
echo 'Username incorect!';
}
$stmt->close();
}
?>