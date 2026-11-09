<?php
//2)	Au sein de votre éditeur de code, dans le fichier utils.php, créez une fonction sanitize(). Elle prend une $data en paramètre sous forme de chaîne de caractère, lui applique la fonction trim(), puis retourne $data.

function sanitize(string $data): string
{
    $data = trim($data);
    return $data;
}