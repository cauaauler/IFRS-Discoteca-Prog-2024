<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>adicinar artista</title>
</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Página Inicial</a></li>
            <li style="float:right; color: white;">
            </li>
        </ul>
    </nav>
    <form action="addArtista.php" method="post">
        <label for="Nome">Nome:</label>
        <input type="text" id="Nome" name='Nome' required>
        <br>
        <input type="submit" value="adicionar" name="botao">
    </form>

</body>

</html>