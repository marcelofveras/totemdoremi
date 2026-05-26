<?php
require_once ("BD.php");

class Ficha extends BD
{

    function turma($turma)
    {
        $sql ="SELECT DISTINCT
                                          p.nome,
                                          SUBSTRING_INDEX(TRIM(p.nome), ' ', 1) AS firstname,
                                          SUBSTRING_INDEX(TRIM(p.nome), ' ', -1) AS lastname,
                                          p.cpf,
                                          pai.cpf as cpf_pai,
                                          pai.nome as nome_pai,
                                          pai.celular as telefone_pai,
                                          mae.cpf as cpf_mae,
                                          mae.nome as nome_mae,
                                          mae.celular as telefone_mae,
                                          c.`NÚMERO CONTRATO` as contrato                                     
                                       FROM turmas t
                                       JOIN contrato c on c.TURMA=t.`Código`
                                       JOIN pessoa p on p.`CPF`=c.`CPF DO ALUNO`
                                       JOIN pessoa pai on pai.`CPF`=p.`CPF DO PAI`
                                       JOIN pessoa mae on mae.`CPF`=p.`CPF DA MÃE`
                                       WHERE t.`Etapa`='$turma' AND c.`SITUAÇÃO`='Cursando'
                                       ORDER BY firstname" ;

        $alunos = json_decode($this->query($sql), true);

        foreach ($alunos as &$aluno) {

            $sql="SELECT
                    p.cpf,
                    p.nome,
                    a.parentesco
                  from autorizados a
                  join pessoa p on a.cpf=p.cpf
                  where a.contrato=".$aluno["contrato"]." and a.datainicio<=now() and (a.datafim is null or a.datafim>=now())";
                
            $aluno['autorizados']=$this->query($sql);
        }

        return $alunos;

    }
}