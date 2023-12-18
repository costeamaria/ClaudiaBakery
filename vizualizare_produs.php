<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="style_admin.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="big-container">
    <div class="txt-1">
<h1>Inregistrarile din tabela Produse Claudia</h1>
<header>
       <div class="logo">
          <img src="logo.jpg" alt="">
       </div>
</div>
</header>
<?php
// connectare bazadedate
include("conectare1.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM produse ORDER BY id "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o tabela
        echo "<table border='8' cellpadding='10' bgcolor='gray'>";
// antetul tabelului
        echo "<tr><th>ID</th><th>Nume produs</th><th>Imagine</th><th>Pret</th><th>Descriere produs</th><th>Categorie produs</th><th>Gramaj</th>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->nume . "</td>";
            echo "<td>" ."<img src ='$row->image' width='200' height='200'/>". "</td>";
            echo "<td>" . $row->pret . "</td>";
            echo "<td>" . $row->descriere . "</td>";
            echo "<td>" . $row->categorie_produs . "</td>";
            echo "<td>" . $row->gramaj . "</td>";
            echo "<td>" . $row->code . "</td>";
            echo "<td><a href='modificare_produse.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='stergere_produse.php?id=" .$row->id . "'>Stergere</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
    else
    {
        echo "Nu sunt inregistrari in tabela!";
    }
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error; }
// se inchide
$mysqli->close();
?>
<br>
<a href="inserare_produse.php">Adaugarea unei noi inregistrari</a></br>
<a href="vizualizare_comenzi.php">Vizualizare comenzi</a></br>
<a href="vizualizare_clienti.php">Vizualizare clienti</a></br>
<a href="home_crud.php">Acasa</a></br>
</div>
</body>
</html>