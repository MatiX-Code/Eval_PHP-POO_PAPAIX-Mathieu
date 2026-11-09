<?php
//2)	Dans le fichier ViewHome.php : créez la classe ViewHome.
//- méthode displayMain() : effectue un echo de la partie HTML correspondant au <main>. Son but est d’avoir un formulaire d’ajout de joueur (pseudo, score, et un menu déroulant pour les teams Chaque Option de ce Select associe un nom d’équipe de la base de données à la valeur de son id. Pour les besoins de l’exercice, faite cela en dur dans le HTML, sans utiliser de requête à la BDD :
//        + value : 1, affiche Aucune
//        + value : 2, affiche TeamRocket
//        + value : 3, affiche DreamTeam

//Il y aura aussi un message de confirmation ou d’erreur pour ce formulaire. De plus, ce <main> affiche aussi la liste de tous les joueurs (pseudo, score, team)

//- méthode displayAll() : effectue le lancement de chaque display dans le bon ordre : displayHeader(), displayMain(), displayFooter()

class ViewHome extends View
{
    private ?string $message = '';
    private ?array $datas = [];

    // Getters et Setters
    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $newMessage): ViewHome
    {
        $this->message = $newMessage;
        return $this;
    }

    public function getDatas(): array
    {
        return $this->datas;
    }

    public function setDatas(array $newDatas): ViewHome
    {
        $this->datas = $newDatas;
        return $this;
    }

    // Méthodes d'affichage
    public function displayMain(): ViewHome
    {
        echo '<main>
        <section>
            <h2>Ajouter un joueur</h2>
            <form action="" method="POST">
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" required> >

                <label for="score">Score :</label>
                <input type="number" name="score" id="score" placeholder="Votre score" required >

                <label for="team">Équipe :</label>
                <select name="team" id="team">
                    <option value="1">Aucune</option>
                    <option value="2">TeamRocket</option>
                    <option value="3">DreamTeam</option>
                </select>

                <input type="submit" name="submit" value="Ajouter">
            </form>
            <p>' . $this->getMessage() . '</p>
        </section>

        <section>
            <h2>Liste des joueurs</h2>
            <ul>';

        foreach ($this->getDatas() as $player) {
            echo '<li>' . $player['pseudo'] . ' - Score : ' . $player['score'] . ' - Team : ' . $player['team'] . '</li>';
        }

        echo '</ul>
        </section>
    </main>';

        return $this;
    }

    public function displayAll(): void
    {
        $this->displayHeader();
        $this->displayMain();
        $this->displayFooter();
    }
}