<?php
if($argc!=2) {
    die("Usage: ${argv[0]} <infile>\n");
}

$in = file($argv[1]);
if($in===False) {
    die("File: ${argv[1]} didn't open.\n");
}

$cur=False;
$entry = array();
foreach($in as $nro=>$rivi) {
    if($nro==0)
        continue;
    @list($id, $nimi, $kuvaus, $notet, $video, $slide, $rooli, $paiva, $alkaa, $loppuu, $lokaatio)=explode(";",$rivi);
    if($cur==False) {
        $cur = $id;
        $entry=array();
        $items=array();
        $i=0;
    }
    if($cur!=$id || !isset($nimi)) {
        printf("%s\n",$entry[1]);        
        foreach($items as $item) {
            printf("%s %s %s %s %s\n", $item["rooli"], $item["paiva"], $item["alkaa"], $item["loppuu"], $item["lokaatio"]);
        }
        printf("%s\n",$entry[2]);
        $cur=$id;
        $entry=array();
        $items=array();
        $i=0;
        printf("\n");
    }    
    $entry = explode(";",$rivi);
    $items[$i]["rooli"]=$rooli;
    $items[$i]["paiva"]=$paiva;
    $items[$i]["alkaa"]=$alkaa;
    $items[$i]["loppuu"]=$loppuu;
    $items[$i++]["lokaatio"]=$lokaatio;
}
?>