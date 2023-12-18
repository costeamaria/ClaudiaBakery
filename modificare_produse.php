<?php
include("conectare1.php");
$error='';
if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id']))
        {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $image = htmlentities($_POST['image'], ENT_QUOTES);
            $pret = htmlentities($_POST['pret'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
            $categorie_produs = htmlentities($_POST['categorie_produs'], ENT_QUOTES);
            $gramaj = htmlentities($_POST['gramaj'], ENT_QUOTES);
            $code = htmlentities($_POST['code'], ENT_QUOTES);

            if ($nume == '' || $image == ''|| $pret == ''|| $descriere=='' || $categorie_produs == '' || $gramaj == '' || $code == '')
            {
                $error = 'ERROR: Campuri goale!';
            }else {
                if ($stmt = $mysqli->prepare("UPDATE produse SET nume=?, image=?, pret=?, descriere=?, categorie_produs=?, gramaj=?, code=? WHERE id='".$id."'")) {
                    $stmt->bind_param("ssissss",  $nume, $image, $pret, $descriere, $categorie_produs, $gramaj, $code);
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
                    <p>ID: <?php echo $_GET['id'];
                        if ($result = $mysqli->query("SELECT * FROM produse where id='".$_GET['id']."'"))
                        {
                        if ($result->num_rows > 0)
                        {$row = $result->fetch_object();?>
                    </p>
                    <strong>Nume produs: </strong> <input type="text" name="nume" value="<?php echo$row->nume; ?>"/><br/>
                    <strong>Imagine: </strong> <input type="text" name="image" value="<?php echo$row->image; ?>"/><br/>
                    <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret; ?>"/><br/>
                    <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere; ?>"/><br/>
                    <strong>Categorie produs: </strong> <input type="text" name="categorie_produs" value="<?php echo$row->categorie_produs; ?>"/><br/>
                    <strong>Gramaj: </strong> <input type="text" name="gramaj" value="<?php echo$row->gramaj;?>"/><br/>
                    <strong>Code: </strong> <input type="text" name="code" value="<?php echo$row->code;}}}?>"/><br/>
                    <br/>
                    <input type="submit" name="submit" value="Submit"/>
                    <a href="vizualizare_produs.php">Produse</a>
                </div>
            </form>
        </div>
    </body>
</html>