<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
    $query = "insert INTO disco (Titulo, Ano, idArtista) VALUES ('$_POST[Titulo]', $_POST[Ano], '$_POST[Artista]')";
    $resultado = $db->query($query);
    header('location:discos.php');
