<?php
//5)	Dans le fichier Controller.php, créez la class Controller. Son constructeur prend en paramètre un objet Model pour l’attribuer à sa propriété model, ainsi qu’un objet View pour l’attribuer à sa propriété view. De plus, elle possède une méthode :
//- render() : appelle la view et lui demande de lancer sa méthode displayAll().

class Controller
{
    // ATTRIBUTS
    private Model $model;
    private View $view;

    // CONSTRUCTEUR
    public function __construct(Model $newModel, View $newView)
    {
        $this->model = $newModel;
        $this->view = $newView;
    }

    // GETTERS ET SETTERS
    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $newModel): Controller
    {
        $this->model = $newModel;
        return $this;
    }

    public function getView(): View
    {
        return $this->view;
    }

    public function setView(View $newView): Controller
    {
        $this->view = $newView;
        return $this;
    }

    // MÉTHODE D'AFFICHAGE
    public function render(): void
    {
        $this->getView()->displayAll();
    }
}