<?php
$db = new mysqli("localhost", "root", "", "discoteca");
if (strlen($_POST['Nome']) > 30 || strlen($_POST['Nome']) == 0) {
    header('Location: error.php?erro=nome');
} else {
    $query = "insert INTO artista (Nome) VALUES ('$_POST[Nome]')";
    $resultado = $db->query($query);
    header('location:artistformAddArtista');
}