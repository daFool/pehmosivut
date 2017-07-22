<?php
($mosbase = getenv("mosBASE")) || die("Environment not properly set mosBASE");
($config = getenv("pehmoConfig")) || die("Environment not properly set pehmoConfig");

require ("$mosbase/util/config.php");
$c = new mosBase \ config();
$c->init($config);
$dc = $c->get("Database");
try {
    $pdo = new mosBase\database($dc["dsn"], $dc["user"], $dc["password"]);
    $log = new mosBase\log("DEBUG", $pdo);
    $words = file($c->get("General")["words"]);
    if(!$words) {
        die("Sanatiedosto $words ei auennut.\n");
    }
    $lines = count($words);
    $hits = array();
    for($i=0;$i<20;$i++) {
        do {
            $n = rand(0, $lines);
        } while (isset($hits[$n]));
        $hits[$n]=True;
        $s = "select substr(encode(:n, 'hex'),0,12) as koodi;";
        $st = mosBase\util::pdoPrepare($s, $pdo);
        mosBase\util::pdoExecute($st, array("n"=>$words[$n]));
        $d = array("koodi"=>$st->fetch(PDO::FETCH_ASSOC)["koodi"],
                   "nimi"=>sprintf("Ropenalle%02d",$i+1),
                   "kuvaus"=>sprintf("Ropecon-nalle numero %02d",$i+1));
        $s = "insert into pehmo (koodi, nimi, kuvaus) values (:koodi, :nimi, :kuvaus);";
        $st = mosBase\util::pdoPrepare($s, $pdo);
        mosBase\util::pdoExecute($st, $d);
    }
  
}
catch(\PDOException $e) {
    $m = sprintf("Tietokantavirhe: %s\n", $e->getMessage());
    die($m);
}
?>