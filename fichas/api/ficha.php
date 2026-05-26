<?php

header('Content-Type: application/json');

require_once("../class/BD.php");
require_once("../class/Ficha.php");

$turma = $_GET["turma"] ?? "";

$ficha = new Ficha();

$rs=$ficha->turma($turma);

$retorno = [];

foreach($rs as $aluno){
   
    
    $retorno[] = [
        "id" => $aluno["cpf"],
        "firstName" => $aluno["firstname"],
        "lastName" => $aluno["lastname"],
        "fullName" => $aluno["nome"],
        "cpf" => $aluno["cpf"],
        "parents"=> array("pai"=>array("cpf"=>$aluno["cpf_pai"],"nome"=>$aluno["nome_pai"],"telefone"=>$aluno["telefone_pai"]),
                          "mae"=>array("cpf"=>$aluno["cpf_mae"],"nome"=>$aluno["nome_mae"],"telefone"=>$aluno["telefone_mae"])
        ),
        "authorized" => $aluno["autorizados"]
    ];
}

echo json_encode($retorno);