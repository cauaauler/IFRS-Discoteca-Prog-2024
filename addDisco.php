<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$anoAtual = date('Y');

// Verifique as validações de entrada
if ($_POST['Ano'] > $anoAtual || $_POST['Ano'] < 1850) {
    header('Location: error.php?erro=ano');
} else if (strlen($_POST['Titulo']) > 50 || strlen($_POST['Titulo']) == 0) {
    header('Location: error.php?erro=titulo');
} else {
    // Inserir dados na tabela disco (sem a foto)
    $query = "INSERT INTO disco (Titulo, Ano, idArtista) VALUES ('$_POST[Titulo]', $_POST[Ano], '$_POST[Artista]')";
    $resultado = $db->query($query);

    if ($resultado) {
        $idDisco = $db->insert_id;
        $target_dir = "uploads/";

        if ($_FILES['arquivo']['error'] == 0) {
            $imageFileType = strtolower(pathinfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION));
            $extensoesPermitidas = ["jpg", "jpeg", "png", "gif", "bmp", "webp", "avif"];
            $check = getimagesize($_FILES["arquivo"]["tmp_name"]);

            // Checar se o arquivo é uma imagem válida e se a extensão é permitida
            if ($check === false || !in_array($imageFileType, $extensoesPermitidas)) {
                header('Location: error.php?erro=1');
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
                    header('Location: index.php');
                    exit();
                } else {
                    header('Location: error.php?erro=2');

                    exit();
                }
            } else {
                header('Location: error.php?erro=3');
                exit();
            }
        } else {
            header('Location: error.php?erro=4');
            exit();
        }
    } else {
        header('Location: error.php?erro=5');
        exit();
    }
}
