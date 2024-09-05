<?php
if (isset($_GET['IdArtista'])) {
    $db = new mysqli("localhost", "root", "", "discoteca");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $idArtista = intval($_GET['IdArtista']);

    // Verificar se o artista é foreign key na tabela discos
    $deleteQuery = "
        DELETE FROM artista
        WHERE IdArtista = {$idArtista}
        AND NOT EXISTS (
            SELECT 1
            FROM disco
            WHERE IdArtista = {$idArtista}
        )
    ";

    $result = $db->query($deleteQuery);

    if ($result && $db->affected_rows > 0) {
        // Redirecione se a exclusão for bem-sucedida
        header("Location: artistas.php");
        exit();
    } else {
        // Caso o artista esteja sendo referenciado
        echo "Artista possui discos de sua autoria cadastrados, exclua os discos antes de excluir o artista.";
        echo "</br>";
        echo "<a href='artistas.php'>Voltar</a>";

    }

    $db->close();
}
