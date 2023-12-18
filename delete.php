<?php
include("conectare1.php");
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    $id = $_GET['id'];
    if ($stmt = $mysqli->prepare("DELETE FROM produse WHERE id = ? "))
    $stmt->bind_param("i",$id);
    $stmt->close();
}
$mysqli->close();
?>