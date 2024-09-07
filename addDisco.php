<?php
$db = new mysqli("localhost", "root", "", "discoteca");
$anoAtual = date('Y');

if ($_POST['Ano'] > $anoAtual || $_POST['Ano'] < 1850) {
    echo "Adicione um ano válido para o disco";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
} else if (strlen($_POST['Titulo']) > 50) {
    echo "O título precisa ter menos de 50 caracteres";
    echo "</br>";
    echo "<a href='discos.php'>Voltar</a>";
} else {


    //Para mudar o nome do arquivo baseado no id do disco
    $idDisco = $db->insert_id;
    $target_dir = "uploads/";

    if ($_FILES['arquivo']['error'] == 0) {

        $imageFileType = strtolower(pathinfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION));
        $extensoesPermitidas = ["jpg", "jpeg", "png", "gif", "bmp", "webp"];
        $check = getimagesize($_FILES["arquivo"]["tmp_name"]);

        //checar se o arquivo é uma imagem válida
        if ($check == false && !in_array(
            $imageFileType,
            $extensoesPermitidas
        )) {
            echo "O arquivo não é uma imagem ou a extensão é inválida.";
            echo "<a href='discos.php'>Voltar</a>";
            exit();
        } else if ($_FILES["arquivo"]["error"] === 0) {

            // Define o novo nome para o arquivo, baseado no ID do disco e no título
            $novoNomeArquivo = $idDisco . "_" . preg_replace("/[^a-zA-Z0-9]/", "_", $_POST['Titulo']) . "." . $imageFileType;

            // Caminho completo do arquivo
            $target_file = $target_dir . $novoNomeArquivo;

            //Caso o arquivo não exista precisa criar
            if (!is_dir($target_dir)) {
                //0755 é as permissões, true é para permitir diretórios aninhados, se necessário
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
                $query = "INSERT INTO disco (Titulo, Ano, idArtista, FotoCapa) VALUES ('$_POST[Titulo]', $_POST[Ano], '$_POST[Artista]', '$target_file')";
                $resultado = $db->query($query);

                header('Location: discos.php');
                exit();
            } else {
                echo "Desculpe, houve um erro ao enviar o arquivo.";
                echo "<a href='discos.php'>Voltar</a>";
                exit();
            }
        }
    } else {
        echo "Nenhum arquivo foi enviado ou houve um erro no envio.";
        echo "<a href='discos.php'>Voltar</a>";
        exit();
    }
}
