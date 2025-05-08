<?php
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