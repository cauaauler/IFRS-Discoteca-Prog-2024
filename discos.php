<?php
    $db = new mysqli("localhost","root","", "discoteca");
    $query=  "select * from discos d join artista a on d.IdArtista = a.IdArtista";
    $resultado = $db->query($query);

    echo "<table border border-Style:dashed>";
    echo "<tr>
            <td>Título</td>
            <td>Ano</td>
            <td>Artista</td>
            <td>Foto Capa</td>
            <td>IdDisco</td>
            <td>fazer</td>
        </tr>";
    
    if($resultado ->num_rows==0){
        echo"não tem discos cadastrados";
    }else{
        foreach($resultado as $linha){
            echo "<tr>";
            echo "<td> {$linha['Titulo']}</td>";
            echo "<td> {$linha['Ano']}</td>";
            echo "<td> {$linha['Nome']}</td>";
            echo "<td> {$linha['FotoCapa']}</td>";
            echo "<td> {$linha['IdDisco']}</td>";
            //echo "<td> <a href='delArtista.php?idArtista={$linha['IdArtista']}>Eliminar</a>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "<br>";
    echo "<a href='form_addDiscos.php'>adicionar disco</a>";
    echo "<br>";
    echo "<a href='index.php'>Voltar</a>"
?>