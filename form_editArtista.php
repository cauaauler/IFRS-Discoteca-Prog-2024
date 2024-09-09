<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar artista</title>
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
    <form action="editArtista.php" method="post">
        <label for="Nome">Nome:</label>
        <?php
        $db = new mysqli("localhost", "root", "", "discoteca");
        $idArtista = $_GET['idArtista'];
        $query = "SELECT Nome FROM Artista WHERE IdArtista = '$idArtista'";
        $resultado = $db->query($query);
        $artista = $resultado->fetch_assoc();
        echo "<input type='text' id='Nome' name='Nome' required value={$artista['Nome']}>";
        echo "<input type='text' id='IdArtista' name='IdArtista' required value={$idArtista} hidden>";
        ?>
        <br>

        <input type="submit" value="editar" name="botao">

    </form>
</body>

</html>