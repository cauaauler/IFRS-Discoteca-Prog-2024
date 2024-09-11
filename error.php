<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Artista</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="http://localhost/Discoteca-Prog-2024/site/certificado_ouro.png?v=2" type="image/png">
</head>

<body>
    <div class="form">
        <?php
        $erro = $_GET['erro'];

        switch ($erro) {
            case 'existeEmprestimo':
                echo "<h1>Artista tem discos emprestados, não é possível excluir</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 'ano':
                echo "<h1>Adicione um ano válido para o disco</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 'nome':
                echo "<h1>O nome do artista precisa ter entre 1 e 30 caracteres</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 'titulo':
                echo "<h1><br>O título precisa ter entre 1 e 50 caracteres</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 1:
                echo "<h1>O arquivo não é uma imagem ou a extensão é inválida.</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 2:
                echo "<h1>Houve um erro ao atualizar o registro do disco.</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 3:
                echo "<h1>Houve um erro ao enviar o arquivo.</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 4:
                echo "<h1>Arquivo não é de um tipo de imagem válida.</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            case 5:
                echo "<h1>Selecione um arquivo para o disco.</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
            default:
                echo "<h1>Erro inesperado.</h1>";
                echo "</br>";
                echo "<a href='index.php' class='enviar'>Voltar</a>";
                break;
        }
        ?>
    </div>
</body>

</html>