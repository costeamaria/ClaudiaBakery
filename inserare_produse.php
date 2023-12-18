<?php
include("conectare1.php");
$error='';
if (isset($_POST['submit']))
{
$id = NULL;
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
$image = htmlentities($_POST['image'], ENT_QUOTES);
$pret = htmlentities($_POST['pret'], ENT_QUOTES);
$descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
$categorie_produs = htmlentities($_POST['categorie_produs'], ENT_QUOTES);
$gramaj = htmlentities($_POST['gramaj'], ENT_QUOTES);
$code = htmlentities($_POST['code'], ENT_QUOTES);
if ($nume == ''|| $image==''|| $pret==''||$descriere==''||$categorie_produs==''||$gramaj=='' ||$code=='')
{
$error = 'ERROR: Campuri goale!';
} else {
if ($stmt = $mysqli->prepare("INSERT into produse (nume,image, pret, descriere, categorie_produs, gramaj, code) VALUES (?, ?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("ssissss", $nume,$image,$pret,$descriere,$categorie_produs,$gramaj,$code);
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
<head> <title><?php echo "Inserare produse"; ?> </title>
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
        <strong>Nume produs: </strong>
        <select name="nume" <?php echo$row->nume; ?>>
                        <option value="1">Briose vegane</option>
                        <option value="2">Chifla</option>
                        <option value="3">Ciocolata de casa</option>
                        <option value="4">Cornulete cu susan</option>
                        <option value="5">Fursecuri cu nuca si magiun</option>
                        <option value="6">Fursecuri cu gen</option>
                        <option value="7">Cozonac cu mac</option>
                        <option value="8">Paine integrala</option>
                        <option value="9">Paine maia</option>
                        <option value="10">Paine neagra</option>
                        <option value="11">Placinta cu varza</option>
                        <option value="12">Prajitura cu cocos</option>
                        <option value="13">Dulceata de casa</option>
                        <option value="14">Tarta cu capsune</option>
                        <option value="15">Tarta cu mere</option>
                        <option value="16">Tarta cu visine</option>
                    </select>
                    <br/>
        <strong>Imagine: </strong> <input type="text" name="image" value=""/><br/>
        <strong>Pret: </strong> <input type="text" name="pret" value=""/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value="" value=""/><br/>
        <strong>Categorie produs: </strong> <input type="text" name="categorie_produs" value=""/><br/>
        <strong>Gramaj: </strong> <input type="text" name="gramaj" value=""/><br/>
        <strong>Code: </strong> <input type="text" name="code" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizare_produs.php">Inapoi</a>
    </div>
</form>
</body>
</html>