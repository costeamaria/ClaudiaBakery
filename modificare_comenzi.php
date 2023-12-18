<?php
include("conectare1.php");
$error='';
if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id']))
        {
            $id=$_POST['id'];
            $id_produs = htmlentities($_POST['id_produs'], ENT_QUOTES);
            $id_client = htmlentities($_POST['id_client'], ENT_QUOTES);
            $stare = htmlentities($_POST['stare_comanda'], ENT_QUOTES);


            if (  $id_produs == ''|| $id_client=='' || $stare == '')
            {
                $error = 'ERROR: Campuri goale!';
            }else {
                if ($stmt = $mysqli->prepare("UPDATE comenzi SET  id_produs=?, id_client=?, stare_comanda=? WHERE id_comanda='".$id."'")) {
                    $stmt->bind_param("iiis", $id_produs, $id_client, $stare);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        }
    else
    {echo "id incorect!";} }}?>

<!DOCTYPE HTML PUBLIC "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
    <link href="style_admin.css" type="text/css" rel="stylesheet" />
    </head>
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
                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                    <p>ID: <?php 
                        if ($result = $mysqli->query("SELECT * FROM comenzi where id_comanda='".$_GET['id']."'"))
                        {
                        if ($result->num_rows > 0)
                        {$row = $result->fetch_object();?>
                    </p>
                    <strong>ID produs: </strong> <input type="text" name="id_produs" value="<?php echo$row->id_produs; ?>"/><br/>
                    <strong>ID client: </strong> <input type="text" name="id_client" value="<?php echo$row->id_client; ?>"/><br/>>
                    <strong>Stare comanda: </strong> <input type="text" name="stare_comanda" value="<?php echo$row->stare_comanda;}}}?>"/><br/>
                    <br/>
                    <input type="submit" name="submit" value="Submit"/>
                    <a href="vizualizare_comenzi.php">Comenzi</a>
                </div>
            </form>
        </div>
    </body>
</html>