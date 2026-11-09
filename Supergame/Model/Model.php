<?php
//3)	Dans le fichier Model.php, créez la classe Model. Son constructeur instancie un objet de connexion PDO.


class Model
{
    private PDO $bdd;

    // CONSTRUCTEUR
    public function __construct()
    {
        $this->bdd = new PDO(
            'mysql:host=localhost;dbname=supergame','root','',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    // GETTER
    public function getBdd(): PDO
    {
        return $this->bdd;
    }
}