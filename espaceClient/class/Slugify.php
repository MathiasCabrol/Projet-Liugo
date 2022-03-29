<?php

class Slug {

    public function slugify($string, $delimiter = '-') {
        //On définit l'ancienne locale par défaut
        $oldLocale = setlocale(LC_ALL, '0');
        //On parmètre la locale américaine
        setlocale(LC_ALL, 'en_US.UTF-8');
        //Conversion en ascii
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        //Suppression des caractères
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        //Transformation en lettres minuscules
        $clean = strtolower($clean);
        //Remplacement des carctères spéciaux par le $delimiter définit en paramètre
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        //Supprime les caractères invisibles
        $clean = trim($clean, $delimiter);
        //On définit l'ancienne locale
        setlocale(LC_ALL, $oldLocale);
        //Retourne la chaine de caractères convertie
        return $clean;
    }
}