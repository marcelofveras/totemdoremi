<?php

class BD {

    private $host = "172.31.2.215";
    private $port = 3306;
    private $user = "sge";
    private $pass = "Doremi0411";
    private $db = "familiadoremi";
    private $exec;
    private $retorno = array();
    private $con;

    private function conectar()
    {
        if ($this->con instanceof mysqli) {
            if (@mysqli_ping($this->con)) {
                return true;
            }

            @mysqli_close($this->con);
            $this->con = null;
        }

        mysqli_report(MYSQLI_REPORT_OFF);

        $this->con = @mysqli_connect($this->host, $this->user, $this->pass, $this->db, $this->port);

        if (!$this->con) {
            error_log('BD connection failed: ' . mysqli_connect_error());
            return false;
        }

        @mysqli_set_charset($this->con, 'utf8mb4');
        return true;
    }

    function query($qry)
    {
        $tipo = substr(strtoupper($qry), 0, 3);

        if (!$this->conectar()) {
            return $tipo === 'SEL' ? '[]' : 0;
        }

        $this->exec = @mysqli_query($this->con, $qry);

        if ($this->exec === false) {
            error_log('BD query failed: ' . mysqli_error($this->con) . ' | SQL: ' . $qry);
            return $tipo === 'SEL' ? '[]' : 0;
        }

        $this->retorno = array();

        switch ($tipo) {
            case "SEL":
                while ($obj = @mysqli_fetch_assoc($this->exec)) {
                    array_push($this->retorno, $obj);
                }
                $this->retorno = json_encode($this->retorno);
                break;
            case "UPD":
                $this->retorno = @mysqli_affected_rows($this->con);
                break;
            case "DEL":
                $this->retorno = @mysqli_affected_rows($this->con);
                break;
            case "INS":
                $this->retorno = @mysqli_insert_id($this->con);
                break;
            case "REP":
                $af = @mysqli_affected_rows($this->con);
                $li = @mysqli_insert_id($this->con);
                $this->retorno = $af > $li ? $af : $li;
                break;
        }

        return $this->retorno;
    }

    function __destruct()
    {
        if ($this->con instanceof mysqli) {
            @mysqli_close($this->con);
            $this->con = null;
        }
    }

}