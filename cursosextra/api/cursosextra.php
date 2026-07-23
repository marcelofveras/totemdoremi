<?php
header('Content-Type: application/json');
require_once('../../fichas/class/BD.php');

$codigo = $_GET['codigo'] ?? null;
$bd = new BD();

if ($codigo) {
    $sql = "SELECT p.CPF as cpf, p.nome, t.Etapa as turma, a.`Situação` as situacao FROM alunosextracur a JOIN contrato c ON c.`NÚMERO CONTRATO` = a.`NÚMERO CONTRATO` JOIN pessoa p ON p.CPF = c.`CPF DO ALUNO` LEFT JOIN turmas t ON t.`Código` = c.TURMA WHERE a.`CÓDIGOCURSO` = '$codigo' AND (a.TERMINO IS NULL OR a.TERMINO >= CURDATE()) ORDER BY p.nome";

    $resultado = $bd->query($sql);
    echo is_string($resultado) ? $resultado : json_encode($resultado);
    return;
}

$sql = "select c.`CÓDIGOCURSO` as codigo_curso, c.`Descrição` as descricao, c.`CPF PROFESSOR` as cpf_professor, p.nome as professor_nome from cursosextra c left join pessoa p on p.CPF = c.`CPF PROFESSOR` where c.`Situação` = 'Ativo' order by c.`Descrição`";

$resultado = $bd->query($sql);
echo is_string($resultado) ? $resultado : json_encode($resultado);
