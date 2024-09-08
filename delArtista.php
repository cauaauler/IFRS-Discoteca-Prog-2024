<?php
if (isset($_GET['IdArtista'])) {
    $db = new mysqli("localhost", "root", "", "discoteca");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $idArtista = intval($_GET['IdArtista']);

    // Excluir registros da tabela emprestimo que referenciam discos do artista
    $query = "
        DELETE e
        FROM emprestimo e
        JOIN disco d ON e.IdDisco = d.IdDisco
        WHERE d.IdArtista = {$idArtista}
    ";
    $db->query($query);

    // Excluir os discos do artista
    $query = "
        DELETE FROM disco
        WHERE IdArtista = {$idArtista}
    ";
    $db->query($query);

    // Excluir o artista
    $query = "
        DELETE FROM artista
        WHERE IdArtista = {$idArtista}
    ";
    $db->query($query);

    header("Location: artistas.php");
    $db->close();
}
