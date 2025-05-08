<?php  
class Kampf {
    public $runden = 0;
    public $arena;
    public $arenaType;

    public function __construct($arena = "Arena", $arenaType = "Feuer") {
        $this->arena = $arena;
        $this->arenaType = $arenaType;
    }

    public function kaempfe($s1, $s2) {
        echo "<div class='result'><h2>Kampf in der Arena: {$this->arena} (Typ: {$this->arenaTyp})</h2>";
       // if ($s1->getType() === $this->arenaType){
       //     $s1_lp = $s1_lp * 1.10;
      //      $s1_aw = $s1_aw * 1.20;
       //     }   
       
      //  if ($s2->getType() === $this->arenaType){
        //    $s1_lp = $s1_lp * 1.10;
       //     $s1_aw = $s1_aw * 1.20;
        //    } 
        
        while (!$s1->istBesiegt() && !$s2->istBesiegt()) {
            $this->runden++;
            echo "<h3>Runde {$this->runden}</h3>";

            $s2->erleideSchaden($s1->getAngriffswert());
            echo "{$s1->getName()} greift an!<br>";
            $s2->zeigeStatus();

            if ($s2->istBesiegt()) break;

            $s1->erleideSchaden($s2->getAngriffswert());
            echo "{$s2->getName()} kontert!<br>";
            $s1->zeigeStatus();
        }

        $sieger = $s1->istBesiegt() ? $s2->getName() : $s1->getName();
        echo "<h2>🏆 Sieger: $sieger</h2></div>";
        return $sieger;
}}
?>