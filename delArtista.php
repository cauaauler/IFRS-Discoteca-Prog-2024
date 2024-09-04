<?php
    if(isset($_GET)){
        $db = new mysqli("localhost", "root", "", "discoteca");
        $idArtista = intval($_GET['IdArtista']);
        $query = "delete FROM artista where IdArtista={$idArtista}";
        $resultado = $db -> query($query);
        header("location:artistas.php"); 

    }
    else{
        echo"tu fez caca  ravi";
    }
?>