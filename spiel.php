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
}

class Datenbank {
    private $pdo;

    public function __construct($host, $user, $pass, $dbname) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $user, $pass);
           // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Verbindung fehlgeschlagen: " . $e->getMessage());
        }
    }

    public function savePlayer(Spieler $spieler) {
        $sql = "INSERT INTO Player (name, lebenspunkte, angriffswert, erstellungsdatum)
                VALUES (:name, :lp, :aw, :datum)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $spieler->getName(),
            ':lp' => $spieler->getLebenspunkte(),
            ':aw' => $spieler->getAngriffswert(),
            ':datum' => $spieler->getErstellungsDatum()->format('Y-m-d')
        ]);
        return $this->pdo->lastInsertId();
    }

    public function saveFight($spieler1_id, $spieler2_id, $gewinner, $arena, $runden) {
        $sql = "INSERT INTO Fight (spieler1_id, spieler2_id, gewinner, arena, runden, kampfdatum)
                VALUES (:s1, :s2, :gewinner, :arena, :runden, NOW())";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':s1' => $spieler1_id,
            ':s2' => $spieler2_id,
            ':gewinner' => $gewinner,
            ':arena' => $arena,
            ':runden' => $runden
        ]);
    }
    
    }

?>