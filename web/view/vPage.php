<?php
class vPage {
    
    private $twig;
    protected $variables;
    protected $baseurl;
    protected $basepath;
    protected $conf;
    
    /**
     * Sivupohja
     *
     * @param object $twig Twig-objekti
     * @param &array $t Tekstit
     * @param object $conf Konfiguraatio
     * */
    public function __construct($twig, &$t, $conf, &$pehmot) {       
        $this->twig = $twig;
        $v = array();
        $this->baseurl = $conf->get("General")["baseurl"];
        $this->basepath = $conf->get("General")["basepath"];
        $this->conf=$conf;    
        /**
         * Nallet
         * @var array $n
         * */
        $n = array();
        $na = $pehmot->nallet();
        $i=0;
        foreach($na as $nallukka) {
            $n[$i]["teksti"]=$nallukka["nimi"];
            $n[$i++]["url"]=sprintf("$baseurl/nallet?nalle=%s", $nallukka["nimi"]);
        }
        
        $k = array();
        $i=0;
        $ki = $pehmot->kissat();
        foreach($ki as $kisuli) {
            $k[$i]["teksti"]=$kisuli["nimi"];
            $k[$i++]["url"]=sprintf("$baseurl/kissat?kissa=%s", $kisuli["nimi"]);
        }
        
        $l = array("0"=>array("url"=>"$baseurl/controller/kieli?kieli=englanti", "teksti"=>$t["englanti"]),
                   "1"=>array("url"=>"$baseurl/controller/kieli?kieli=suomi", "teksti"=>$t["suomi"]));
        
        
        $tl= array("baseurl"=>$this->baseurl,
                                 "nallet"=>$n,
                                 "kissat"=>$k,
                                 "kielet"=>$l,
                                 "basepath"=>$this->basepath,
                                 "baseurl"=>$this->baseurl
                                 );
        $this->variables=array_merge($tl, $t);        
        
    }
    
    public function nayta($sivu) {
        $this->twig->loadTemplate($sivu);
        echo $this->twig->render($sivu, $this->variables);
    }
        
}
?>