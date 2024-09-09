<?php
if (isset($_GET['idDisco'])) {
    $db = new mysqli("localhost", "root", "", "discoteca");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $idDisco = intval($_GET['idDisco']);

    // Excluir registros da tabela devolucao que referenciam discos do artista
    $query = "
        DELETE de
        FROM devolucao de
        JOIN emprestimo e ON de.IdEmp = e.IdEmp
        JOIN disco d ON e.IdDisco = d.IdDisco
        WHERE d.IdDisco = {$idDisco}
    ";
    $db->query($query);

    // Excluir registros da tabela emprestimo que referenciam discos do artista
    $query = "
        DELETE e
        FROM emprestimo e
        JOIN disco d ON e.IdDisco = d.IdDisco
        WHERE d.IdDisco = {$idDisco}
    ";
    $db->query($query);
    // Verificar se o artista é foreign key na tabela discos
    $deleteQuery = "
        DELETE FROM disco
        WHERE idDisco = {$idDisco}
    ";

    $result = $db->query($deleteQuery);

    header("Location: index.php");

    $db->close();
}
