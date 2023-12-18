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
<h1>Inregistrarile din tabela Clineti Claudia</h1>
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
if ($result = $mysqli->query("SELECT * FROM clienti ORDER BY id_client "))
{ // Afisare inregistrari pe ecran
    if ($result->num_rows > 0)
    {
// afisarea inregistrarilor intr-o table
        echo "<table border='8' cellpadding='10' bgcolor='gray'>";
// antetul tabelului
        echo "<tr><th>ID Client</th><th>Client Username</th><th>Parola</th><th>Email</th><th>Telefon</th><th>Nume</th><th>Prenume</th>";
        while ($row = $result->fetch_object())
        {
// definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>" . $row->id_client . "</td>";
            echo "<td>" . $row->client_username . "</td>";
            echo "<td>" . $row->client_parola . "</td>";
            echo "<td>" . $row->email . "</td>";
            echo "<td>" . $row->telefon . "</td>";
            echo "<td>" . $row->nume . "</td>";
            echo "<td>" . $row->prenume . "</td>";
            echo "<td><a href='modificare_clienti.php?id=" . $row->id_client . "'>Modificare</a></td>";
            echo "<td><a href='stergere_clienti.php?id=" .$row->id_client . "'>Stergere</a></td>";
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
<a href="inserare_clienti.php">Adaugarea unei noi inregistrari</a></br>
<a href="vizualizare_produs.php">Vizualizare produse</a></br>
<a href="vizualizare_comenzi.php">Vizualizare comenzi</a></br>
<a href="home_crud.php">Acasa</a>
</div>
</body>
</html>