<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="discos.css">
    <title>adicinar artista</title>
</head>

<body>
    <form action="addArtista.php" method="post">
        <label for="Nome">Nome:</label>
        <input type="text" id="Nome" name='Nome' required>
        <br>
        <input type="submit" value="adicionar" name="botao">
    </form>
    <a href='artistas.php'>Voltar</a>

</body>

</html>