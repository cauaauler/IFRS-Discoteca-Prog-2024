<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$anoAtual = date('Y');

// Verifique as validações de entrada
if ($_POST['Ano'] > $anoAtual || $_POST['Ano'] < 1850) {
    echo "Adicione um ano válido para o disco";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
} else if (strlen($_POST['Titulo']) > 50 || strlen($_POST['Titulo']) == 0) {
    echo "O título precisa ter entre 1 e 50 caracteres";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
} else {
    // Inserir dados na tabela disco (sem a foto)
    $query = "INSERT INTO disco (Titulo, Ano, idArtista) VALUES ('$_POST[Titulo]', $_POST[Ano], '$_POST[Artista]')";
    $resultado = $db->query($query);

    if ($resultado) {
        $idDisco = $db->insert_id;
        $target_dir = "uploads/";

        if ($_FILES['arquivo']['error'] == 0) {
            $imageFileType = strtolower(pathinfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION));
            $extensoesPermitidas = ["jpg", "jpeg", "png", "gif", "bmp", "webp"];
            $check = getimagesize($_FILES["arquivo"]["tmp_name"]);

            // Checar se o arquivo é uma imagem válida e se a extensão é permitida
            if ($check === false || !in_array($imageFileType, $extensoesPermitidas)) {
                echo "O arquivo não é uma imagem ou a extensão é inválida.";
                echo "<a href='discos.php'>Voltar</a>";
                exit();
            }

            // Define o novo nome para o arquivo
            $novoNomeArquivo = $idDisco . "_" . preg_replace("/[^a-zA-Z0-9]/", "_", $_POST['Titulo']) . "." . $imageFileType;
            $target_file = $target_dir . $novoNomeArquivo;

            // Caso a pasta não exista, cria ela
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
                // Atualiza o registro com o caminho da foto
                $query = "UPDATE disco SET FotoCapa='$target_file' WHERE idDisco=$idDisco";
                $resultado = $db->query($query);
                if ($resultado) {
                    header('Location: discos.php');
                    exit();
                } else {
                    echo "Houve um erro ao atualizar o registro do disco.";
                    echo "<a href='discos.php'>Voltar</a>";
                    exit();
                }
            } else {
                echo "Houve um erro ao enviar o arquivo.";
                echo "<a href='discos.php'>Voltar</a>";
                exit();
            }
        } else {
            echo "Nenhum arquivo foi enviado ou houve um erro no envio.";
            echo "<a href='discos.php'>Voltar</a>";
            exit();
        }
    } else {
        echo "Houve um erro ao adicionar o disco.";
        echo "<a href='discos.php'>Voltar</a>";
        exit();
    }
}
