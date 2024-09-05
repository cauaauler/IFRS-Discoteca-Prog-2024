<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$anoAtual = date('Y');
if ($_POST['Ano'] > $anoAtual || $_POST['Ano'] < 1850) {
    echo "Adicione um ano válido para o disco";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
} else {
    $query = "UPDATE disco SET Titulo = '$_POST[Titulo]', Ano = $_POST[Ano], IdArtista = $_POST[Artista] WHERE IdDisco = $_POST[idDisco]";
    $resultado = $db->query($query);
    header('location:discos.php');
}
