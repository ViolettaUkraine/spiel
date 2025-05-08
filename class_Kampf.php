<?php  
class Kampf {
    public $runden = 0;
    public $arena;

    public function __construct($arena = "Arena") {
        $this->arena = $arena;
    }

    public function kaempfe($s1, $s2) {
        echo "<div class='result'><h2>Kampf in der Arena: {$this->arena}</h2>";

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
    }
}?>