<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Disco</title>
</head>

<body>
    <form action="addDisco.php" method="post" enctype="multipart/form-data">
        <label for="Titulo">Título:</label>
        <input type="text" id="Titulo" name="Titulo" required>

        <label for="Ano">Ano:</label>
        <input type="number" id="Ano" name="Ano" required>

        <label for="Artista">Artista:</label>
        <select name="Artista" id="Artista" required>
            <?php
            $db = new mysqli("localhost", "root", "", "discoteca");
            if ($db->connect_error) {
                die("Conexão falhou: " . $db->connect_error);
            }

            $query = "SELECT Nome, idArtista FROM artista";
            $nomes = $db->query($query);

            if ($nomes->num_rows > 0) {
                while ($artista = $nomes->fetch_assoc()) {
                    echo "<option value='{$artista['idArtista']}'>{$artista['Nome']}</option>";
                }
            } else {
                echo "<option value=\"\">Nenhum artista encontrado</option>";
            }

            $db->close();
            ?>
        </select>

        <label for="v1">Selecione o arquivo:</label>
        <input type="file" name="arquivo" id="v1" accept="image/*">

        <input type="submit" value="Adicionar" name="botao">
    </form>
</body>

</html>