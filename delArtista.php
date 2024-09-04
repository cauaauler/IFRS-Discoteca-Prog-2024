<?php
    if(isset($_GET)){
        $db = new mysqli("localhost", "discoteca", "", "root");
        $querry = "Delete from artista where IdArtista={$_GET['Idartista']}";
        $resultado = $db -> query($querry);
        header("location:artistas.php");
    }
?>