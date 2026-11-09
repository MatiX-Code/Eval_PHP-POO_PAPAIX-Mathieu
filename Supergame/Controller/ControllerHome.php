<?php
//6)	Dans le fichier ControllerHome.php, créez la class ControllerHome. Elle possède 2 méthodes :

//- displayPlayers() : Elle demande au model de récupérer la totalité des players, avant de fournir ces données à la view.

//- registerPlayer() fait plusieurs choses :
        //+ Vérifier que l’on reçoive bien le formulaire d’ajout de joueur
        //+ Mettre en place les sécurités d’usages concernant la réception de formulaire
        //+ Faire les vérification pour savoir si l’enregistrement a le droit de s’effectuer
        //+ Effectuer l’enregistrement
        //+ Quelque soit l’issu (succès ou erreur), fournir un message approprié à la view

class ControllerHome extends Controller
{
    public function displayPlayers(): ControllerHome
    {
        $datas = $this->getModel()->findAll();
        $this->getView()->setDatas($datas);

        return $this;
    }

    public function registerPlayer(): ControllerHome
    {
        // 1. Vérifier la réception du formulaire
        if (isset($_POST['submit'])) {

            // 2. Vérifier que les champs existent et ne sont pas vides
            if (
                isset($_POST['pseudo'], $_POST['score'], $_POST['team']) &&
                !empty($_POST['pseudo']) &&
                $_POST['score'] !== '' &&
                !empty($_POST['team'])
            ) {
                // 3. Sécurités d'usage : nettoyage complet des inputs
                $pseudo = htmlentities(strip_tags(stripslashes(sanitize($_POST['pseudo']))));
                $score  = htmlentities(strip_tags(stripslashes(sanitize($_POST['score']))));
                $idTeam = htmlentities(strip_tags(stripslashes(sanitize($_POST['team']))));

                // 4. Vérifier que le score et l'id de la team sont bien des entiers
                if (
                    filter_var($score, FILTER_VALIDATE_INT) !== false &&
                    filter_var($idTeam, FILTER_VALIDATE_INT) !== false
                ) {
                    // 5. Vérifier si le pseudo est disponible en BDD
                    $playerExists = $this->getModel()->findByPseudo($pseudo);

                    if (empty($playerExists)) {
                        // 6. Enregistrement du joueur
                        $this->getModel()
                             ->setPseudo($pseudo)
                             ->setScore((int) $score)
                             ->setIdTeam((int) $idTeam)
                             ->add();

                        $this->getView()->setMessage("Le joueur $pseudo a bien été enregistré !");
                    } else {
                        $this->getView()->setMessage("Erreur : le pseudo $pseudo existe déjà.");
                    }
                } else {
                    $this->getView()->setMessage("Erreur : le score et l'équipe doivent être des nombres entiers.");
                }
            } else {
                $this->getView()->setMessage("Erreur : veuillez remplir tous les champs.");
            }
        }

        return $this;
    }
}