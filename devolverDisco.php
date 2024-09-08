<?php
$db = new mysqli("localhost", "root", "", "discoteca");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$idDisco = intval($_GET['idDisco']);

$query = "UPDATE disco SET Emprestado = 0 WHERE IdDisco={$idDisco}";
$resultado = $db->query($query);
$query = "UPDATE emprestimo SET Devolvido = 1 WHERE IdEmp=$_GET[idEmprestimo]";
$resultado = $db->query($query);

$currentDate = date('Y-m-d h:i:s');
$query = "INSERT INTO devolucao (Data, IdEmp) VALUES ('$currentDate', '$_GET[idEmprestimo]')";
$resultado = $db->query($query);

header('Location: discos.php');
