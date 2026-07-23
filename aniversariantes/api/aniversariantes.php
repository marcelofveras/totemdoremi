<?php
header('Content-Type: application/json');
require_once('../../fichas/class/BD.php');

$mes = $_GET['mes'] ?? date('n');
$bd = new BD();

$sql = "SELECT p.CPF as cpf, p.nome, t.Etapa as turma, p.`DATA DE NASCIMENTO` as data_nascimento
FROM pessoa p
LEFT JOIN contrato c ON c.`CPF DO ALUNO` = p.CPF
LEFT JOIN turmas t ON t.`Código` = c.TURMA
WHERE MONTH(p.`DATA DE NASCIMENTO`) = '$mes'
AND  c.`SITUAÇÃO` = 'Cursando'
ORDER BY p.nome";

$resultado = $bd->query($sql);
echo is_string($resultado) ? $resultado : json_encode($resultado);
