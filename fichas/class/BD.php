<?php


class BD {
    
    private $host = "172.31.2.215";
    private $port = "3306";
    private $user = "sge";
    private $pass= "Doremi0411";
    private $db = "familiadoremi";
    private $exec;
    private $rs;
    private $retorno = array();
    private $con;
    
    
    function query($qry) {

        $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
        mysqli_set_charset($this->con, 'utf8mb4');
        $this->exec=mysqli_query($this->con, $qry);
        $this->retorno = array();
        
        switch (substr(strtoupper($qry),0,3)) {
            
            case "SEL":
                while ($obj=mysqli_fetch_assoc($this->exec)) {
                     array_push($this->retorno,$obj);
                }
                $this->retorno=json_encode($this->retorno);
                break;
            case "UPD":
                $this->retorno=mysqli_affected_rows($this->con);
                 break;
            case "DEL":
                $this->retorno=mysqli_affected_rows($this->con);
                 break;
            case "INS":
                $this->retorno=mysqli_insert_id($this->con);
                 break;
            case "REP":
                $af=mysqli_affected_rows($this->con);
                $li=mysqli_insert_id($this->con);
                $this->retorno=$af>$li?$af:$li;
                break;
        }

        mysqli_close($this->con);
        return $this->retorno;
    }
    
}