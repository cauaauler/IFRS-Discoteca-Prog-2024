<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
    $query = "insert INTO artista (Nome) VALUES ('{$_POST['Nome']}')";
    $resultado = $db->query($query);
    header('location:artistas.php');
?>