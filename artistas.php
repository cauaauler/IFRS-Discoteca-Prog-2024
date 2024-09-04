<?php 
    $db = new mysqli("localhost","root","", "discoteca");
    $query=  "select * from artista";
    $resultado = $db->query($query);

    echo "<table border border-Style:dashed>";
    echo "<tr> 
            <td>Nome</td>
            <td>ID</td>
            <td>fazer</td>
        </tr>";
    
    if($resultado ->num_rows==0){
        echo"não tem artistas cadastrados";
    }else{
        foreach($resultado as $linha){
            echo "<tr>";
            echo "<td> {$linha['Nome']}</td>";
            echo "<td> {$linha['IdArtista']}</td>";
            //echo "<td> <a href='delArtista.php?idArtista={$linha['IdArtista']}>Eliminar</a>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "<br>";
    echo "<a href='form_addArtista.php'>adicionar artista</a>";
    echo "<br>";
    echo "<a href='index.php'>Voltar</a>"
?>