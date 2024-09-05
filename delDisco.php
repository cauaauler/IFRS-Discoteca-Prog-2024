<?php
if (isset($_GET['idDisco'])) {
    $db = new mysqli("localhost", "root", "", "discoteca");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $idDisco = intval($_GET['idDisco']);

    // Verificar se o artista é foreign key na tabela discos
    $deleteQuery = "
        DELETE FROM disco
        WHERE idDisco = {$idDisco}
    ";

    $result = $db->query($deleteQuery);

    header("Location: discos.php");

    $db->close();
}
