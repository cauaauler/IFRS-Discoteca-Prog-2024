<?php
$db = new mysqli("localhost", "root", "", "discoteca");

// Verifique a conexão
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$query = "SELECT * FROM disco d JOIN artista a ON d.IdArtista = a.IdArtista";
$resultado = $db->query($query);

echo "<table border='1' style='border-style:dashed;'>";
echo "<tr>
        <td>Título</td>
        <td>Ano</td>
        <td>Artista</td>
        <td>Foto Capa</td>
        <td>Fazer</td>
        <td>Fazer</td>
    </tr>";

if ($resultado->num_rows == 0) {
    echo "<tr><td colspan='5'>Não há discos cadastrados</td></tr>";
} else {
    while ($linha = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$linha['Titulo']}</td>";
        echo "<td>{$linha['Ano']}</td>";
        echo "<td>{$linha['Nome']}</td>";
        echo "<td><img src='{$linha['FotoCapa']}' alt='Foto da Capa' style='width:100px;'></td>";
        echo "<td><a href='delDisco.php?idDisco={$linha['IdDisco']}'>Eliminar</a></td>";
        echo "<td><a href='form_editDisco.php?idDisco={$linha['IdDisco']}'>Editar</a></td>";
        echo "</tr>";
    }
}

echo "</table>";
echo "<br>";
echo "<a href='form_addDisco.php'>Adicionar Disco</a>";
echo "<br>";
echo "<a href='index.php'>Voltar</a>";

$db->close();
?>
