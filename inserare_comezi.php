<?php
include("conectare1.php");
$error='';
if (isset($_POST['submit']))
{
$id = NULL;
$id_produs= htmlentities($_POST['id_produs'], ENT_QUOTES);
$id_client = htmlentities($_POST['id_client'], ENT_QUOTES);
$data_comenzii = htmlentities($_POST['data_comenzii'], ENT_QUOTES);
$stare_comanda = htmlentities($_POST['stare_comanda'], ENT_QUOTES);
if ($id_produs== ''||$id_client ==''||$data_comenzii ==''||$stare_comanda =='')
{
$error = 'ERROR: Campuri goale!';
} else {
if ($stmt = $mysqli->prepare("INSERT into comenzi (id_produs, id_client, data_comenzii, stare_comanda) VALUES ( ?, ?, ?, ?)"))
{
$stmt->bind_param("iids", $id_produs, $id_client, $data_comenzii, $stare_comanda);
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
<head> <title><?php echo "Inserare comanda"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="style_admin.css" type="text/css" rel="stylesheet" />
</head> <body>
</head> 
<body>
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
<strong>Produs Id: </strong> <input type="text" name="id_produs" value=""/><br/>
<strong>Client Id: </strong> <input type="text" name="id_client" value=""/><br/>
<strong>Data introducere comanda: </strong> <input type="text" name="data_comenzii" value=""/><br/>
<strong>Stare comanda: </strong> <input type="text" name="stare_comanda" value=""/><br/>
</br>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_comenzi.php">Vizualizare comenzi</a>
</div>
</form>
</div>
</body>
</html>