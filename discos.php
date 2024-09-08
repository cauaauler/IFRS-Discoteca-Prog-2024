<?php
$db = new mysqli("localhost", "root", "", "discoteca");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'Titulo';

$colunas_validas = ['Titulo', 'Ano', 'Nome'];
if (!in_array($ordenar, $colunas_validas)) {
    $ordenar = 'Titulo'; // valor padrão
}

$query = "SELECT * FROM disco d 
JOIN artista a ON d.IdArtista = a.IdArtista 
ORDER BY $ordenar ASC";
$resultado = $db->query($query);

echo "<table border='1' style='border-style:dashed;'>";
echo "<tr>
        <td>Título</td>
        <td>Ano</td>
        <td>Artista</td>
        <td>Foto Capa</td>
        <td>Excluir</td>
        <td>Editar</td>
        <td>Emprestar</td>
        <td>Devolução</td>

    </tr>";

if ($resultado->num_rows == 0) {
    echo "<tr><td colspan='7'>Não há discos cadastrados</td></tr>";
} else {
    while ($linha = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$linha['Titulo']}</td>";
        echo "<td>{$linha['Ano']}</td>";
        echo "<td>{$linha['Nome']}</td>";
        echo "<td><img src='{$linha['FotoCapa']}' alt='Foto da Capa' style='width:100px;'></td>";

        if ($linha['Emprestado'] == 1) {
            echo "<td><span style='color: gray; text-decoration: none;'>Não é possível excluir</span></td>";
            echo "<td><span style='color: gray; text-decoration: none;'>Não é possível editar</span></td>";
            echo "<td><a href='discoEmprestado.php?idDisco={$linha['IdDisco']}'>Ver emprestimo</a></td>";
            // echo "<td><span style='color: gray; text-decoration: none;'>Emprestado</span></td>";
            echo "<td><a href='devolverDisco.php?idDisco={$linha['IdDisco']}'>Devolver</a></td>";

        } else {
            echo "<td><a href='delDisco.php?idDisco={$linha['IdDisco']}'>Excluir</a></td>";
            echo "<td><a href='form_editDisco.php?idDisco={$linha['IdDisco']}'>Editar</a></td>";
            echo "<td><a href='form_emprestarDisco.php?idDisco={$linha['IdDisco']}'>Emprestar</a></td>";
            echo "<td><span style='color: gray; text-decoration: none;'>Disponível</span></td>";

        }
        echo "</tr>";
    }
}

echo "</table>";
echo "<br>";
echo "<a href='form_addDisco.php'>Adicionar Disco</a>";
echo "<br>";
echo "<a href='discosEmprestados.php'>Discos Emprestados</a>";
echo "<br>";
echo "<a href='index.php'>Voltar</a>";

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="GET" action="">
        <label for="ordenar">Ordenar por:</label>
        <select name="ordenar" id="ordenar" onchange="this.form.submit()">
            <option value="Titulo" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Titulo' ? 'selected' : '' ?>>Título</option>
            <option value="Nome" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Nome' ? 'selected' : '' ?>>Artista</option>
            <option value="Ano" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Ano' ? 'selected' : '' ?>>Ano</option>
        </select>
    </form>
</body>

</html>