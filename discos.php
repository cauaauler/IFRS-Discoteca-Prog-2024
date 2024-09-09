<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="discos.css">
</head>

<body>

    <body>
        <!-- Nav bar -->
        <nav>
            <ul class="navbar">
                <li><a href="index.php">Início</a></li>
                <li><a href="form_addDisco.php">Adicionar Disco</a></li>
                <li><a href="discosEmprestados.php">Discos Emprestados</a></li>
                <li style="float:right; color: white;">
                    <form method="GET" action="">
                        <label for="ordenar">Ordenar por:</label>
                        <select name="ordenar" id="ordenar" onchange="this.form.submit()">
                            <option value="Titulo" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Titulo' ? 'selected' : '' ?>>Título</option>
                            <option value="Nome" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Nome' ? 'selected' : '' ?>>Artista</option>
                            <option value="Ano" <?= isset($_GET['ordenar']) && $_GET['ordenar'] == 'Ano' ? 'selected' : '' ?>>Ano</option>
                        </select>
                    </form>
                </li>
            </ul>
        </nav>


        <br>
    </body>

</html>

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

if ($resultado->num_rows == 0) {
    echo "<p>Não há discos cadastrados</p>";
} else {
    echo "<div class='card-container'>";
    while ($linha = $resultado->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<h2>{$linha['Titulo']}</h2>";
        echo "<p><strong>Ano:</strong> {$linha['Ano']}</p>";
        echo "<p><strong>Artista:</strong> {$linha['Nome']}</p>";
        echo "<img src='{$linha['FotoCapa']}' alt='Foto da Capa' style='width:100px; height:auto;'>";

        if ($linha['Emprestado'] == 1) {
            echo "<p><span style='color: gray;'>Não é possível excluir ou editar</span></p>";
            echo "<a href='discoEmprestado.php?idDisco={$linha['IdDisco']}'>Ver emprestimo</a>";
            echo "<a href='devolverDisco.php?idDisco={$linha['IdDisco']}'>Devolver</a>";
        } else {
            echo "<a href='delDisco.php?idDisco={$linha['IdDisco']}'>Excluir</a>";
            echo "<a href='form_editDisco.php?idDisco={$linha['IdDisco']}'>Editar</a>";
            echo "<a href='form_emprestarDisco.php?idDisco={$linha['IdDisco']}'>Emprestar</a>";
            echo "<p><span style='color: gray;'>Disponível</span></p>";
        }
        echo "</div>"; // Fechando o card
    }
    echo "</div>"; // Fechando o card-container
}

$db->close();
