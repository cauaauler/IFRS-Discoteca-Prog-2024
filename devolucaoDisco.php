<?php
    if(isset($_GET['IdDisco'])){
    $db = new mysqli("localhost", "root", "", "discoteca");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    //coloca em uma variavel separada o id do disco
    $idDisco = intval($_GET['IdDisco']);


    //pega os codigos de cada um
    $querry= "UPDATE disco set Emprestado = 0 where IdDisco={$idDisco}";
    $querry2= "UPDATE emprestimo set devolvido=1 where IdDisco={$idDisco}";

    //executa ambos os comandos
    $resultado=$db -> query($querry);
    $resultado=$db -> query($querry2);

    

    //aqui vai voltar para a lista de discos
    header('location:discos.php');
    $db->close();
}
    else(
        header("location:erroDev")
    )
?>