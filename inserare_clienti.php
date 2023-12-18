<?php
include("conectare1.php");
$error='';
if (isset($_POST['submit']))
{
$client_username = htmlentities($_POST['username'], ENT_QUOTES);
$client_parola = htmlentities($_POST['parola'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
$prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
if ($client_username == '' ||$client_parola == ''||$email ==''||$telefon ==''||$nume ==''||$prenume='')
{
$error = 'ERROR: Campuri goale!';
} else {
if ($stmt = $mysqli->prepare("INSERT into clienti (client_username,client_parola, email, telefon, nume, prenume) VALUES (?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("ssssss", $client_username, $client_parola,$email,$telefon,$nume,$prenume);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Nu se poate executa insert.";
}
}
}
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare client"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="style_admin.css" type="text/css" rel="stylesheet" />
</head> <body>
<div class="modify-cl">
<h1><?php echo "Inserare inregistrare"; ?></h1>
<header>
       <div class="logo">
          <img src="logo.jpg" alt="">
       </div>
</header>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<strong>Username: </strong> <input type="text" name="username" value=""/><br/>
<strong>Parola: </strong> <input type="text" name="parola" value=""/><br/>
<strong>E-mail: </strong> <input type="text" name="email" value=""/><br/>
<strong>Telefon: </strong> <input type="text" name="telefon" value=""/><br/>
<strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
<strong>Prenume: </strong> <input type="text" name="prenume" value=""/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_clienti.php">La clienti</a>
</div>
</form>
</div>
</body>
</html>