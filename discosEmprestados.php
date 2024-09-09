<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos</title>
    <link rel="stylesheet" href="discos.css">


</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Página Inicial</a></li>
            <li style="float:right; color: white;">
            </li>
        </ul>
    </nav>

</body>

</html>

<?php
$db = new mysqli("localhost", "root", "", "discoteca");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'Nome';

$colunas_validas = ['Nome', 'Data', 'DevolucaoPrevista'];
if (!in_array($ordenar, $colunas_validas)) {
    $ordenar = 'DevolucaoPrevista'; // valor padrão
}

$query = "SELECT * FROM emprestimo e
JOIN disco d ON d.IdDisco = e.IdDisco
ORDER BY $ordenar ASC";
$resultado = $db->query($query);

echo "<table border='1' style='border-style:dashed;'>";
echo "<tr>
        <td>Título</td>
        <td>Foto Capa</td>
        <td>Nome do Cliente</td>
        <td>Email</td>
        <td>Data do Empréstimo</td>
        <td>Data da Devolução Prevista</td>
    </tr>";

if ($resultado->num_rows == 0) {
    echo "<tr><td colspan='7'>Não há discos emprestados</td></tr>";
} else {
    while ($linha = $resultado->fetch_assoc()) {

        if ($linha['Devolvido'] == 0) {
            echo "<tr>";
            echo "<td>{$linha['Titulo']}</td>";
            echo "<td><img src='{$linha['FotoCapa']}' alt='Foto da Capa' style='width:100px;'></td>";
            echo "<td>{$linha['Nome']}</td>";
            echo "<td>{$linha['Email']}</td>";
            echo "<td>" . date('d-m-Y', strtotime($linha['Data'])) . "</td>";
            echo "<td>" . date('d-m-Y', strtotime($linha['DevolucaoPrevista'])) . "</td>";
            echo "</tr>";
        }
    }
}

echo "</table>";
echo "<br>";

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
            <option value="Nome" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Nome' ? 'selected' : '' ?>>Nome</option>
            <option value="Data" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Data' ? 'selected' : '' ?>>Data</option>
            <option value="DevolucaoPrevista" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'DevolucaoPrevista' ? 'selected' : '' ?>>Devolução</option>
        </select>
    </form>
</body>

</html>