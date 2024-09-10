<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$query =  "SELECT * FROM artista";
$resultado = $db->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="http://localhost/Discoteca-Prog-2024/site/certificado_ouro.png?v=2" type="image/png">
</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Página Inicial</a></li>
        </ul>
    </nav>

    <h1>Artistas</h1>

    <div class="artista">
        <div class="addForm">
            <form action="addArtista.php" method="post">
                <h2>Adicionar novo artista</h2>
                <label for="Nome">Nome:</label>
                <input type="text" id="Nome" name='Nome' required>
                <br>
                <input type="submit" value="Adicionar" name="botao">
            </form>
        </div>

        <?php
        echo "<table class='table'>";
        echo "<thead><tr> 
            <th>Nome</th>
            <th>Ações</th>
            </tr></thead><tbody>";

        if ($resultado->num_rows == 0) {
            echo "<tr><td colspan='2'>Não tem artistas cadastrados</td></tr>";
        } else {
            foreach ($resultado as $linha) {
                echo "<tr>";
                echo "<td> {$linha['Nome']}</td>";
                echo "<td> 
                            <a href='delArtista.php?IdArtista={$linha['IdArtista']}'>Eliminar</a> 
                            <a href='form_editArtista.php?IdArtista={$linha['IdArtista']}'>Editar</a>
                        </td>";
                echo "</tr>";
            }
        }

        echo "</tbody></table>";
        ?>
    </div>
</body>

</html>