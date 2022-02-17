<?php 
class Files {

    private $login;
    private $file;
    private $filesArray;

    /**
 * Permet de rechercher une valeur partielle dans un tableau
 * @return bool
 */
public function array_partial_search($keyword): bool
{
    foreach ($this->filesArray as $string) {
        if (strpos($string, $keyword) == 0) {
            $check = true;
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
public function returnFile($keyword)
{
    foreach ($this->filesArray as $string) {
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
private function fileRegistration($fileName): string
{
    $temp = explode(".", $_FILES[$fileName]['name']);
    $newfilename = $fileName . '.' . end($temp);
    $uploaddir = 'hotels/' . $this->login . '/';
    $uploadfile = $uploaddir . $newfilename;
    if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $uploadfile)) {
        $result =  "File is valid, and was successfully uploaded.\n";
    } else {
        $result =  "Possible file upload attack!\n";
    }
    return $result;
}


/**
 * Fonction englobante de toutes les autres méthodes de la classe
 */
public function registrationChecks($file)
{
    if(!empty($this->filesArray)) {
        if (!$this->array_partial_search($file)) {
            $this->fileRegistration($file);
        } else {
            $oldFile = $this->returnFile($file);
            unlink('hotels/' . $this->login . '/' . $oldFile);
            $this->fileRegistration($file);
        }
    }

    $this->fileRegistration($file);
}

public function setLogin($newLogin):void {
    $this->login = $newLogin;
}

public function setFile($newFile):void {
    $this->file = $newFile;
}

public function setFilesArray($newFilesArray):void {
    $this->filesArray = $newFilesArray;
}
}