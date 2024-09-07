<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
    if (strlen($_POST['Nome']) > 30) {
    echo "O nome precisa ter menos de 30 caracteres";
    echo "</br>";
    echo "<a href='artistas.php'>Voltar</a>";
}else{
    $query = "UPDATE artista SET Nome = '$_POST[Nome]' WHERE idArtista = $_POST[IdArtista]";
    $resultado = $db->query($query);
    header('location:artistas.php');
}