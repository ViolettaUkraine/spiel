
<?php class Spieler{
    private $name;
    private $lebenspunkte;
    private $angriffswert;
    private $erstellungsDatum;
   
    public function __construct($name,$lebenspunkte,$angriffswert){ 
        $this->name =$name;
        $this->lebenspunkte =$lebenspunkte;
        $this->angriffswert =$angriffswert;
        $this->erstellungsDatum = new DateTime ();

    }

    function getName(){
        return $this->name;
    }
    function setName(){
        return $this->$name;
    }
    function setLebenspunkt(){
        return $this->$lebenspunkte;
    }
    function getLebenspunkt(){
        return $this->lebenspunkte;
    }
    function getAngriffswert(){
        return $this->angriffswert;
    }
    function setAngriffswert(){
        return $this->$angriffwert;
    }
    function getErstellungsDatum(){
        return $this -> getErstellungsDatum;
    }
    function setErstellungsDatum(){
        return $this->$erstellungsDatum;
    }
    function istBesiegt() {
        return $this->lebenspunkte <= 0;
    }

    function zeigeStatus(){
        echo "Name:" . $this->name."<br>";
        echo "Lebenspunkte:". $this->lebenspunkte. "<br>";
        echo "Angriffswert:".$this->angriffswert."<br>";
        echo "Erstellungsdatum:". $this->erstellungsDatum->format('Y-m-d')."<br>";
    }
    function hatGeburtstag(){
        $heute= new DateTime();
        $tage = $this->erstellungsDatum->diff($heute)->days;
        echo "Tage seit Erstellung: $tage<br>";

        if ($heute->format('m-d') == $this->erstellungsDatum->format('m-d')) {
            echo "Heute ist Geburtstag!<br>";
        } else {
            echo "Heute ist kein Geburtstag.<br>";
        }
    }
}

class Kampf{
    public $runden;
    public $arena;
    public function __construct($arenaName = "Standard Arena") {
        $this->runden = 0; // beginnt
        $this->arena = $arenaName;

        public function kampfe($spieler1,$spieler2){
            echo "<h2> Kampf in der Arena: {$this->arena}</h2>";// Solange keiner besiegt ist (! bedeutet „nicht“), geht der Kampf weiter.
            while(!$spieler1->istBesiegt() &6 !$spieler2->istBesiegt()){
                $this->runden++;
                echo "Runde{$this ->runden}"


            }


        }
    }
}
?>
    
