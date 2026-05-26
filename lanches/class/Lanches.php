<?php
require_once ("BD.php");

class Lanches extends BD
{

    function lanchesdodia($periodo)
    {
        $sql = "select 
                   p.CPF as cpf,
	               p.nome,
                   t.Etapa as turma,
                   l.Lanche
                from lanches l
                join contrato c on c.`NÚMERO CONTRATO`=l.Contrato
                join turmas t on t.`Código`=c.TURMA
                join pessoa p on p.CPF=c.`CPF DO ALUNO`
                where date(now()) between l.Inicio and l.`Término` and l.lanche='$periodo'
                group by p.CPF, p.nome, t.Etapa";

        return json_decode($this->query($sql), true);
    }
}

?>