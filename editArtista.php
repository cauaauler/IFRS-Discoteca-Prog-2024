<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
    if (strlen($_POST['Nome']) > 30) {
    header('Location: error.php?erro=nome');
}else{
    $query = "UPDATE artista SET Nome = '$_POST[Nome]' WHERE idArtista = $_POST[IdArtista]";
    $resultado = $db->query($query);
    header('location:artistas.php');
}