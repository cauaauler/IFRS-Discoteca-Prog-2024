<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar disco</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Página Inicial</a></li>
            <li style="float:right; color: white;">
            </li>
        </ul>
    </nav>
    <form action="editdisco.php" method="post" enctype="multipart/form-data">
        <label for="Nome">Nome:</label>
        <?php
        $db = new mysqli("localhost", "root", "", "discoteca");
        $idDisco = $_GET['idDisco'];
        $query = "SELECT * FROM disco WHERE idDisco = '$idDisco'";
        $resultado = $db->query($query);
        $disco = $resultado->fetch_assoc();

        echo "<input type='text' id='Titulo' name='Titulo' required value={$disco['Titulo']}>";
        echo "<label for='Ano'>Ano:</label>";
        echo "<input type='text' id='Ano' name='Ano' required value={$disco['Ano']}>";

        $query_artista = "SELECT Nome, idArtista FROM artista";
        $nomes = $db->query($query_artista);
        echo "<label for='Artista'>Artista:</label>";
        echo "<select name='Artista' id='Artista' required>";

        if ($nomes->num_rows > 0) {
            while ($artista = $nomes->fetch_assoc()) {
                echo "<option value='{$artista['idArtista']}'>{$artista['Nome']}</option>";
            }
        } else {
            echo "<option value=\"\">Nenhum artista encontrado</option>";
        }
        echo "</select>";

        echo "<input type='text' id='idDisco' name='idDisco' required value={$idDisco} hidden>";
        ?>
        <br>
        <input type='file' name='arquivo' id='v1' accept='image/*'>

        <input type="submit" value="editar" name="botao">

    </form>
</body>

</html>