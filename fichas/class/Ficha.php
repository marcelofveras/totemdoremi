<?php
require_once ("BD.php");

class Ficha extends BD
{

    private function urlExiste($url)
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'HEAD',
                'timeout' => 3,
                'ignore_errors' => true
            ]
        ]);

        $headers = @get_headers($url, 1, $context);

        if ($headers === false || !isset($headers[0])) {
            return false;
        }

        return strpos((string)$headers[0], '200') !== false;
    }

    private function receitaDisponivel($cpf)
    {
        $cpfLimpo = preg_replace('/[^0-9]/', '', (string)$cpf);

        if ($cpfLimpo === '') {
            return [
                "exists" => false,
                "url" => null,
                "fileName" => null
            ];
        }

        $baseUrl = "https://vpn.doremieducacao.com.br/familiadoremi/receitas/";
        $extensoesPermitidas = ["png", "pdf", "jpg"];

        foreach ($extensoesPermitidas as $ext) {

            $fileName = $cpfLimpo . "." . $ext;
            $fullUrl = $baseUrl . $fileName;

            if ($this->urlExiste($fullUrl)) {
                return [
                    "exists" => true,
                    "url" => $fullUrl,
                    "fileName" => $fileName
                ];
            }
        }

        return [
            "exists" => false,
            "url" => null,
            "fileName" => null
        ];
    }

    private function listaDoencas($dadosFichaMedica)
    {
        if (!$dadosFichaMedica) {
            return [];
        }

        $mapaDoencas = [
            "SARAMPO" => "Sarampo",
            "RUBEOLA" => "Rubeola",
            "COQUELUCHE" => "Coqueluche",
            "CATAPORA" => "Catapora",
            "CAXUMBA" => "Caxumba",
            "BRONQUITE" => "Bronquite",
            "DIABETES" => "Diabetes",
            "COVID" => "Covid"
        ];

        $doencas = [];

        foreach ($mapaDoencas as $campo => $nomeDoenca) {

            if (isset($dadosFichaMedica[$campo]) && (int)$dadosFichaMedica[$campo] === 1) {
                $doencas[] = $nomeDoenca;
            }
        }

        $outras = trim((string)($dadosFichaMedica["QUAISOUTRAS"] ?? ""));

        if ($outras !== "") {
            $doencas[] = "Outras: " . $outras;
        }

        return $doencas;
    }

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
                                                        t.Etapa as turma,
                                                        tur.`Descrição` as turno,
                                          c.`NÚMERO CONTRATO` as contrato                                     
                                       FROM turmas t
                                       JOIN contrato c on c.TURMA=t.`Código`
                                       JOIN pessoa p on p.`CPF`=c.`CPF DO ALUNO`
                                       JOIN pessoa pai on pai.`CPF`=p.`CPF DO PAI`
                                       JOIN pessoa mae on mae.`CPF`=p.`CPF DA MÃE`
                                                    JOIN turnos tur on tur.`Código`=t.Turno
                                       WHERE t.`Etapa`='$turma' AND c.`SITUAÇÃO`='Cursando'
                                       ORDER BY firstname" ;

        $alunos = json_decode((string)$this->query($sql), true);

        foreach ($alunos as &$aluno) {

            $sql="SELECT
                    p.cpf,
                    p.nome,
                    a.parentesco
                  from autorizados a
                  join pessoa p on a.cpf=p.cpf
                  where a.contrato=".$aluno["contrato"]." and a.datainicio<=now() and (a.datafim is null or a.datafim>=now())";
                
            $aluno['autorizados']=$this->query($sql);

            $sqlFichaMedica = "SELECT
                                fm.SARAMPO,
                                fm.RUBEOLA,
                                fm.COQUELUCHE,
                                fm.CATAPORA,
                                fm.CAXUMBA,
                                fm.BRONQUITE,
                                fm.DIABETES,
                                fm.COVID,
                                                                fm.QUAISALERGIAS,
                                fm.QUAISOUTRAS
                              FROM `ficha médica` fm
                              WHERE fm.`CPF ALUNO`='" . $aluno["cpf"] . "'
                              LIMIT 1";

            $dadosFichaMedica = json_decode((string)$this->query($sqlFichaMedica), true);
            $registroFichaMedica = $dadosFichaMedica[0] ?? null;

            $aluno['doencas'] = $this->listaDoencas($registroFichaMedica);
            $aluno['alergias'] = trim((string)($registroFichaMedica['QUAISALERGIAS'] ?? ''));
            $aluno['receita'] = $this->receitaDisponivel($aluno['cpf']);
        }

        return $alunos;

    }
}