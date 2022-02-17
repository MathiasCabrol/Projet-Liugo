<?php session_start();

/**
 * Permet de rechercher une valeur partielle dans un tableau
 * @return bool
 */

function array_partial_search($array, $keyword): bool
{
    foreach ($array as $string) {
        if (strpos($string, $keyword) !== false) {
            $check = $string;
        } else {
            $check = false;
        }
    }
    return $check;
}

/**
 * Fonction qui permet de retourner le nom du fichier contenant le parmètre de recherche dans le dossier du client
 * @return string
 */

function returnFile($array, $keyword)
{
    foreach ($array as $string) {
        if (strpos($string, $keyword) !== false) {
            $file = $string;
        }
    }
    return $file;
}

/**
 * Fonction permettant d'enregistrer le fichier en paramètre dans le dossier de l'utilisateur connecté
 * @return string
 */

function fileRegistration($fileName): string
{
    $temp = explode(".", $_FILES[$fileName]['name']);
    $newfilename = $fileName . '.' . end($temp);
    $uploaddir = 'hotels/' . $_SESSION["login"] . '/';
    $uploadfile = $uploaddir . $newfilename;
    echo '<pre>';
    if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $uploadfile)) {
        $result =  "File is valid, and was successfully uploaded.\n";
    } else {
        $result =  "Possible file upload attack!\n";
    }
    echo 'Here is some more debugging info:';
    print_r($_FILES);
    print "</pre>";
    return $result;
}

function registrationChecks($array, $file)
{
    if (!array_partial_search($array, $file)) {
        fileRegistration($file);
    } else {
        $oldFile = returnFile($array, $file);
        unlink('hotels/' . $_SESSION["login"] . '/' . $oldFile);
        fileRegistration($file);
    }
}


$filesArray = array(
    'homePhoto' => 'Merci d\'insérer une photo d\'accueil',
    'activityPhoto' => 'Merci d\'insérer une photo pour la section activités',
    'servicePhoto' => 'Merci d\'insérer une photo pour la section service'
);


if (isset($_POST['confirm'])) {
    if (!is_dir('hotels/' . $_SESSION['login'] . '/')) {
        mkdir('hotels/' . $_SESSION['login'] . '/', 0777, true);
    }
    $path = 'hotels/' . $_SESSION['login'] . '/';
    $files = scandir($path);
    $files = array_diff(scandir($path), array('.', '..'));
    foreach ($filesArray as $fileName => $errorMessage) {
        if (!$_FILES[$fileName]['error']) {
            registrationChecks($files, $fileName);
        } else {
            $errorList[$fileName] = $errorMessage;
        }
    }
}
