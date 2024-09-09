<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Disco</title>
</head>

<body>
    <form action="addDisco.php" method="post" enctype="multipart/form-data">
        <label for="Titulo">Título:</label>
        <input type="text" id="Titulo" name="Titulo" required>

        <label for="Ano">Ano:</label>
        <input type="number" id="Ano" name="Ano" required>

        <label for="Artista">Artista:</label>
        <select name="Artista" id="Artista" required>
            <?php
            $db = new mysqli("localhost", "root", "", "discoteca");
            if ($db->connect_error) {
                die("Conexão falhou: " . $db->connect_error);
            }

            $query = "SELECT Nome, idArtista FROM artista";
            $nomes = $db->query($query);

            if ($nomes->num_rows > 0) {
                while ($artista = $nomes->fetch_assoc()) {
                    echo "<option value='{$artista['idArtista']}'>{$artista['Nome']}</option>";
                }
            } else {
                echo "<option value=\"\">Nenhum artista encontrado</option>";
            }

            $db->close();
            ?>
        </select>

        <label for="v1">Selecione o arquivo:</label>
        <input type="file" name="arquivo" id="v1" accept="image/*" required>
        <div id="imagePreview"></div>
        <input type="submit" value="Adicionar" name="Adicionar">
    </form>
    <a href='index.php'>Voltar</a>

    <script>
        // Adiciona um evento 'change' ao elemento de input com id 'v1'
document.getElementById('v1').addEventListener('change', function(event) {
    // Obtém o primeiro arquivo selecionado pelo usuário
    const file = event.target.files[0];
    
    // Verifica se um arquivo foi selecionado
    if (file) {
        // Cria um novo objeto FileReader para ler o conteúdo do arquivo
        const reader = new FileReader();
        
        // Define uma função a ser executada quando a leitura do arquivo for concluída
        reader.onload = function(e) {
            // Cria um novo elemento de imagem
            const img = document.createElement('img');
            
            // Define o atributo 'src' da imagem para o resultado da leitura do arquivo
            img.src = e.target.result;
            
            // Define a largura máxima da imagem (ajuste conforme necessário)
            img.style.maxWidth = '300px';
            
            // Limpa qualquer conteúdo anterior na div de pré-visualização
            document.getElementById('imagePreview').innerHTML = '';
            
            // Adiciona a nova imagem à div de pré-visualização
            document.getElementById('imagePreview').appendChild(img);
        };
        
        // Inicia a leitura do arquivo como uma URL de dados
        reader.readAsDataURL(file);
    }
});
    </script>
</body>

</html>