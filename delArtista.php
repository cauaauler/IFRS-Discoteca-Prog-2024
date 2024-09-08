<?php
if (isset($_GET['IdArtista'])) {
    $db = new mysqli("localhost", "root", "", "discoteca");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $idArtista = intval($_GET['IdArtista']);

    // Verificar se o artista é foreign key na tabela discos
    $deleteDiscoQuery = "
        DELETE FROM disco
        WHERE IdArtista = {$idArtista}
    ";
    $deleteArtistaQuery = "
        DELETE FROM artista
        WHERE IdArtista = {$idArtista}
    ";

    $db->query($deleteDiscoQuery);
    $db->query($deleteArtistaQuery);

    header("Location: artistas.php");
    $db->close();
}
