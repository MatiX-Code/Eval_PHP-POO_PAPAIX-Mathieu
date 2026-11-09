<?php
//1)	Dans le fichier View.php : créez la classe View. Elle possède les méthodes :
//- displayHeader() : effectue un echo de la partie HTML correspondant au header de la page (balise DOCTYPE jusqu’à la balise de fermeture header), puis retourne l’objet $this.
//-displayFooter() : effectue un echo de la partie correspondant au footer de la page (balise ouvrante footer jusqu’à la balise de fermeture html), puis retourne l’objet $this.

class View
{
    public function displayHeader(): View
    {
        echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supergame</title>
</head>
<body>
    <header>
        <h1>Supergame</h1>
    </header>';

        return $this;
    }

    public function displayFooter(): View
    {
        echo '<footer>
        <p>Supergame - Evaluation PHP POO du 09/11/2026 ADRAR</p>
    </footer>
</body>
</html>';

        return $this;
    }
}