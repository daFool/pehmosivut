<?php
class pehmo extends mosBase\malli {
    public function __construct(&$db, &$log) {
        $taulu = "pehmo";
        $hakukentat=array();
        $hakutaulu = "pehmo";
        
        parent::__construct($db, $log, $taulu, array("primary"=>array("id"), "koodi"=>array("koodi")));
    }
    
    public function nallet() {
        $s = "select nimi from pehmo where nimi like '%Ropenalle%';";
        $st = $this->pdoPrepare($s, $this->db);
        $this->pdoExecute($st, array());
        $nallet = $st->fetchAll(\PDO::FETCH_ASSOC);
        return $nallet;
    }
    
    public function kissat() {
        $s = "select nimi from pehmo where nimi not like '%Ropenalle%';";
        $st = $this->pdoPrepare($s, $this->db);
        $this->pdoExecute($st, array());
        $kissat = $st->fetchAll(\PDO::FETCH_ASSOC);
        return $kissat;
    }
}
?>