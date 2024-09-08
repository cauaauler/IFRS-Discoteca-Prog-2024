<?php
    $db = new mysqli("localhost", "root", "", "discoteca");
if (strlen($_POST['Nome']) > 30 || strlen($_POST['Nome']) == 0) {
    echo "O nome precisa ter entre 1 e 30 caracteres";
    echo "</br>";
    echo "<a href='artistas.php'>Voltar</a>";
} else {
    $query = "insert INTO artista (Nome) VALUES ('$_POST[Nome]')";
    $resultado = $db->query($query);
    header('location:artistas.php');
}