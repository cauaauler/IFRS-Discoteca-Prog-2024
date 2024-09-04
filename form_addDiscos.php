<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adicinar disco</title>
</head>
<body>
    <form action="addDiscos.php" method="post">
        <label for="Titulo">Título:</label> <input type="text" id="Titulo" name='Titulo' required>
        <br>
        <label for="Ano">Ano:</label> <input type="text" id="Ano" name='Ano' required>
        <br>
        <label for="Artista">Artista:</label> <input type="text" id="Artista" name='Artista' required>
        <br>
        
        <form action="processa.php" method="post" id="container" enctype="multipart/form-data">
        <label for="v1">Selecione o arquivo:</label>
        <input type="file" name="arquivo" id="v1" required  accept="image/*">
        <button type="submit" name="botao"> Upload</button>
    </form>
        <input type="submit" value="adicinar" name="botao">
    </form>
</body>
</html>