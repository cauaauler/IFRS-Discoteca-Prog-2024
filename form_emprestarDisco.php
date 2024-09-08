<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Disco</title>
</head>

<body>
    <form action="emprestarDisco.php" method="post">

        <!-- Para conseguir enviar o id para o emprestar -->
        <input type="hidden" id="IdDisco" name="IdDisco" value="<?php echo htmlspecialchars($_GET['idDisco'] ?? ''); ?>">

        <label for="Nome">Nome do cliente:</label>
        <input type="text" id="Nome" name="Nome" required>

        <label for="Email">Email do cliente:</label>
        <input type="email" id="Email" name="Email" required>

        <label for="DevPrevista">Devolução:</label>
        <input type="date" id="DevPrevista" name="DevPrevista">

        <input type="submit" value="Adicionar" name="Adicionar">
    </form>

    <a href='discos.php'>Voltar</a>

</body>

</html>