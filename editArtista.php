<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
    $query = "UPDATE artista SET Nome = '$_POST[Nome]' WHERE idArtista = $_POST[IdArtista]";
    $resultado = $db->query($query);
    header('location:artistas.php');
