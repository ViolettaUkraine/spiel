<?php 
class Spieler {
    private $name;
    private $lebenspunkte;
    private $angriffswert;
    private $erstellungsDatum;

    public function __construct($name, $lebenspunkte, $angriffswert) {
        $this->name = $name;
        $this->lebenspunkte = $lebenspunkte;
        $this->angriffswert = $angriffswert;
        $this->erstellungsDatum = new DateTime();
    }

    public function getName() { return $this->name; }
    public function getLebenspunkte() { return $this->lebenspunkte; }
    public function getAngriffswert() { return $this->angriffswert; }
    public function getErstellungsDatum() { return $this->erstellungsDatum; }

    public function istBesiegt() {
        return $this->lebenspunkte <= 0;
    }

    public function erleideSchaden($schaden) {
        $this->lebenspunkte -= $schaden;
        if ($this->lebenspunkte < 0) $this->lebenspunkte = 0;
    }

    public function zeigeStatus() {
        echo "<div class='status-box'>";
        echo "<strong>Name:</strong> {$this->name}<br>";
        echo "<strong>Lebenspunkte:</strong> {$this->lebenspunkte}<br>";
        echo "<strong>Angriffswert:</strong> {$this->angriffswert}<br>";
        echo "<strong>Erstellt am:</strong> " . $this->erstellungsDatum->format('Y-m-d') . "<br>";
        echo "</div>";
    }

    public function hatGeburtstag() {
        $heute = new DateTime();
        $tage = $this->erstellungsDatum->diff($heute)->days;
        echo "<div class='birthday-box'>";
        echo "Tage seit Erstellung: $tage<br>";
        if ($heute->format('m-d') === $this->erstellungsDatum->format('m-d')) {
            echo "🎉 Heute ist Geburtstag!<br>";
        } else {
            echo "Heute ist kein Geburtstag.<br>";
        }
        echo "</div>";
    }
}
?>