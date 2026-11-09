<?php
//4)	Dans le fichier ModelPlayer.php, créez la classe ModelPlayer. Elle possède des méthodes qui envoie des requêtes à la BDD au sein de Try…Catch. Dans chaque cas, le Catch attrape l’exception et affiche le message d’erreur grâce à die() :
//- findAll() : requête pour récupérer tous les players avec toutes leurs informations (id, pseudo, score, team). Elle retourne un tableau contenant des tableaux associatifs.

//- findByPseudo() : requête pour récupérer qu’un seul player grâce à son pseudo. Elle retourne un tableau associatif.

//- add() : requête pour enregistrer un player en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team).

//- delete() : requête pour supprimer un player en connaissant son id.

//- update() requête pour mettre à jour les données d’un player existant grâce à son id, en connaissant son pseudo, son score et l’id de sa team (la clé étrangère id_team).

class ModelPlayer extends Model
{
    // ATTRIBUTS
    private int $id;
    private string $pseudo;
    private int $score;
    private string $team;
    private int $idTeam;

    // GETTERS ET SETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $newId): ModelPlayer
    {
        $this->id = $newId;
        return $this;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $newPseudo): ModelPlayer
    {
        $this->pseudo = $newPseudo;
        return $this;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $newScore): ModelPlayer
    {
        $this->score = $newScore;
        return $this;
    }

    public function getTeam(): string
    {
        return $this->team;
    }

    public function setTeam(string $newTeam): ModelPlayer
    {
        $this->team = $newTeam;
        return $this;
    }

    public function getIdTeam(): int
    {
        return $this->idTeam;
    }

    public function setIdTeam(int $newIdTeam): ModelPlayer
    {
        $this->idTeam = $newIdTeam;
        return $this;
    }

    // MÉTHODES BDD (CRUD)
    public function findAll(): array
    {
        try {
            $req = $this->getBdd()->prepare('SELECT p.id_player, p.pseudo, p.score, t.team FROM player p INNER JOIN team t ON p.id_team = t.id_team;');

            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findByPseudo(): array | bool
    {
        try {
            $req = $this->getBdd()->prepare('SELECT p.id_player, p.pseudo, p.score, p.id_team, t.team FROM player p 
            INNER JOIN team t ON p.id_team = t.id_team;
            WHERE p.pseudo = ?');

            $pseudo = $this->getPseudo();
            $req->bindParam(1, $pseudo, PDO::PARAM_STR);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function add(): void
    {
        try {
            $req = $this->getBdd()->prepare('INSERT INTO player (pseudo, score, id_team) 
            VALUES (?, ?, ?)');

            $pseudo = $this->getPseudo();
            $score = $this->getScore();
            $idTeam = $this->getIdTeam();

            $req->bindParam(1, $pseudo, PDO::PARAM_STR);
            $req->bindParam(2, $score, PDO::PARAM_INT);
            $req->bindParam(3, $idTeam, PDO::PARAM_INT);
            $req->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete(): void
    {
        try {
            $req = $this->getBdd()->prepare('DELETE FROM player 
                WHERE id_player = ?');

            $id = $this->getId();
            $req->bindParam(1, $id, PDO::PARAM_INT);
            $req->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update(): void
    {
        try {
            $req = $this->getBdd()->prepare('UPDATE player 
                SET pseudo = ?, score = ?, id_team = ? 
                WHERE id_player = ?');

            $pseudo = $this->getPseudo();
            $score = $this->getScore();
            $idTeam = $this->getIdTeam();
            $id = $this->getId();

            $req->bindParam(1, $pseudo, PDO::PARAM_STR);
            $req->bindParam(2, $score, PDO::PARAM_INT);
            $req->bindParam(3, $idTeam, PDO::PARAM_INT);
            $req->bindParam(4, $id, PDO::PARAM_INT);
            $req->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}