<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $idDisco = intval($_GET['IdDisco']);

    $querry= "UPDATE disco set Emprestado = 0 where IdDisco={$idDisco}";
    $querry2= "UPDATE emprestimo set devolvido=1 where IdDisco={$idDisco}";
    $resultado=$db -> query($querry);
    $resultado=$db -> query($querry2);

    -
    header('location:discos.php')

?>