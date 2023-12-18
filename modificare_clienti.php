<?php 
include("conectare1.php");

$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ 
    if (is_numeric($_POST['id']))
        { 
            $id = $_POST['id'];
            $username = htmlentities($_POST['username'], ENT_QUOTES);
            $parola = htmlentities($_POST['parola'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            

    if ( $username == '' ||$parola == ''||$email ==''||$telefon ==''||$nume ==''||$prenume =='')
        { 
        echo "<div> ERROR: Completati campurile obligatorii!</div>";
        }else
        {   
            if ($stmt = $mysqli->prepare("UPDATE clienti SET client_username=?, client_parola=?, email=?, telefon=?, nume=?, prenume=? WHERE id_client='".$id."'"))
            {
                $stmt->bind_param("ssssss", $username, $parola, $email, $telefon, $nume, $prenume);
                $stmt->execute();
                $stmt->close();
                    }
                    else
                    {echo "ERROR: nu se poate executa update.";}
            }
        }
        
        else
        {echo "id incorect!";} }}?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title> 
    <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> 
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<link href="style_admin.css" type="text/css" rel="stylesheet" />
<body>
    <div class="modify-cl">
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<header>
<div class="logo">
          <img src="logo.jpg" alt="">
       </div>
</header>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<?php if ($_GET['id'] != '') { ?>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
<p>ID: <?php echo $_GET['id'];
if ($result = $mysqli->query("SELECT * FROM clienti where id_client='".$_GET['id']."'"))
{
if ($result->num_rows > 0)
{ $row = $result->fetch_object();?></p>
<strong>Username: </strong> <input type="text" name="username" value="<?php echo$row->client_username; ?>"/><br/>
<strong>Parola: </strong> <input type="text" name="parola" value="<?php echo$row->client_parola; ?>"/><br/>
<strong>E-mail: </strong> <input type="text" name="email" value="<?php echo$row->email; ?>"/><br/>
<strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo$row->telefon; ?>"/><br/>
<strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume; ?>"/><br/>
<strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo$row->prenume;}}}?>"/><br/>
<br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_clienti.php">Vezi clienti</a>
</div>
</div>
</form>
</body>
 </html>