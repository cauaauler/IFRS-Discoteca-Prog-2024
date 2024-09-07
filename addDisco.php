<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$anoAtual = date('Y');

if ($_POST['Ano'] > $anoAtual || $_POST['Ano'] < 1850) {
    echo "Adicione um ano válido para o disco";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
} else {
    // Realiza a inserção no banco de dados (sem a imagem por enquanto)
    $query = "INSERT INTO disco (Titulo, Ano, idArtista) VALUES ('$_POST[Titulo]', $_POST[Ano], '$_POST[Artista]')";
    $resultado = $db->query($query);

    // Obtém o ID gerado automaticamente pelo banco para a inserção
    $idDisco = $db->insert_id;

    // Diretório de upload
    $target_dir = "uploads/";

    // Verifica se um arquivo foi enviado sem erros
    if ($_FILES['arquivo']['error'] == 0) {
        // Pega a extensão do arquivo
        $imageFileType = strtolower(pathinfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION));

        // Define o novo nome para o arquivo, baseado no ID do disco e no título
        $novoNomeArquivo = $idDisco . "_" . preg_replace("/[^a-zA-Z0-9]/", "_", $_POST['Titulo']) . "." . $imageFileType;

        // Caminho completo do arquivo
        $target_file = $target_dir . $novoNomeArquivo;

        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
            echo "O arquivo " . htmlspecialchars($novoNomeArquivo) . " foi enviado com sucesso.";

            // Atualiza o registro no banco de dados com o caminho da imagem
            $queryUpdate = "UPDATE disco SET FotoCapa='$target_file' WHERE idDisco=$idDisco";
            $resultadoUpdate = $db->query($queryUpdate);

            header('Location: discos.php');
            exit(); // Sempre use exit após redirecionamento para evitar execução adicional do script
        } else {
            echo "Desculpe, houve um erro ao enviar o arquivo.";
        }

        echo "Caminho do arquivo salvo: {$target_file}";
    } else {
        echo "Nenhum arquivo foi enviado ou houve um erro no envio.";
    }
}
