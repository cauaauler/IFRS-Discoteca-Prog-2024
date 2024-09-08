<?php
$db = new mysqli("localhost", "root", "", "discoteca");

if ($db->connect_error) {
    die("Falha na conexão: " . $db->connect_error);
}

date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date('Y-m-d H:i:s');

if (isset($_POST['Nome']) && isset($_POST['Email']) && isset($_POST['DevPrevista']) && isset($_POST['IdDisco'])) {    // Validando os dados do formulário
    if (strlen($_POST['Nome']) > 50 || strlen($_POST['Nome']) == 0) {
        echo "O nome do cliente precisa ter entre 1 e 50 caracteres";
        echo "</br>";
        echo "<a href='discos.php'>Voltar</a>";
    } elseif (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido.";
        echo "</br>";
        echo "<a href='discos.php'>Voltar</a>";
    } elseif ($_POST['DevPrevista'] < $dataAtual) {
        echo "A devolução não pode ocorrer antes do empréstimo";
        echo "</br>";
        echo "<a href='discos.php'>Voltar</a>";
    } else {
        $query = "INSERT INTO emprestimo (Nome, Email, DevolucaoPrevista, IdDisco) VALUES ('$_POST[Nome]', '$_POST[Email]', '$_POST[DevPrevista]', '$_POST[IdDisco]')";
        $db->query($query);

        $query = "UPDATE disco SET Emprestado = 1 WHERE IdDisco = $_POST[IdDisco]";
        $db->query($query);

        header("Location: discos.php");
    }
} else {

    echo "Dados do formulário não enviados corretamente.";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
}

// Fechar a conexão com o banco de dados
$db->close();
