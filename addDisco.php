<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$anoAtual = date('Y'); {
    if ($_POST['Ano'] > $anoAtual || $_POST['Ano'] < 1850) {
        echo "Adicione um ano válido para o disco";
        echo "</br>";
        echo "<a href='discos.php'>Voltar</a>";
    } else {
        $query = "insert INTO disco (Titulo, Ano, idArtista) VALUES ('$_POST[Titulo]', $_POST[Ano], '$_POST[Artista]')";
        $resultado = $db->query($query);
        header('location:discos.php');
    }
}


