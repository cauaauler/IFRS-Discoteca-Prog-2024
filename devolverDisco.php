<?php
$db = new mysqli("localhost", "root", "", "discoteca");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$idDisco = intval($_GET['idDisco']);

$query = "UPDATE disco SET Emprestado = 0 WHERE IdDisco={$idDisco}";
$db->query($query);

$query = "SELECT idEmp FROM emprestimo
WHERE idDisco = {$idDisco} 
AND Devolvido = 0";
$resultado = $db->query($query);

while ($linha = $resultado->fetch_assoc()) {
    $currentDate = date('Y-m-d h:i:s');
    $query = "INSERT INTO devolucao (Data, IdEmp) VALUES ('$currentDate', '$linha[IdEmp]')";
    $db->query($query);
}


$query = "UPDATE emprestimo SET Devolvido = 1 WHERE IdDisco={$idDisco}";
$db->query($query);

$db->close();
header('Location: discos.php');
