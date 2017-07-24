<?php
$mosBase = getenv("mosBASE");
if(!$mosBase) { die("Environment not properly set! (mosBASE)"); }

$slsConfig = getenv("pehmoConfig");
if(!$slsConfig) { die("Environment not properly set! (pehmoConfig)"); }
require("$mosBase/util/config.php");

$conf = new mosBase\config();
$conf->init($slsConfig);

$dbconf = $conf->get("Database");
try {
    $pdo = new mosBase\database($dbconf["dsn"], $dbconf["user"], $dbconf["password"]);  
}
catch(PDOException $e) {
    die(sprintf("Database error: %s\n", $e->getMessage()));
}
require($conf->get("General")["vendor"]);

$log = new mosBase\log("DEBUG", $pdo);
$f3=require($conf->get("General")["f3"]);
$f3->set("conf", $conf);
$f3->set("db", $pdo);

$f3->set("log", $log);
$f3->route("GET /", function($f3) {
    $conf = $f3->get("conf");
    $db=$f3->get("db");
    $log=$f3->get("log");
    $loader = new Twig_Loader_Filesystem($conf->get("Twig")["twigTemplates"]);
    $twig = new Twig_Environment($loader);
    $basepath = $conf->get("General")["basepath"];
    require_once("$basepath/view/language.php");
    $p = new pehmo($db, $log);
    $sivu = new vEtusivu($twig, $t, $conf,$p);    
    $sivu->nayta("etusivu.html");    
});
$f3->map("/nallet", nallet);
$f3->map("/kissat", kissat);
$f3->run();
?>