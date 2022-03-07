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

public function deleteCategoryFile($id)
{
    $path = 'hotels/' . $_SESSION['login'] . '\/category/';
    $files = scandir($path);
    $files = array_splice($files, 2);
    $this->setFilesArray($files);
    $fileToDelete = $this->returnFile($id);
    return unlink($path . $fileToDelete);
}

public function registerCategoryFile($oldPath, $oldFileName, $id)
{
    $path = 'hotels/' . $_SESSION['login'] . '\/category/';
    $temp = explode(".", $oldFileName);
    return rename($oldPath, $path . 'categoryPhoto' . $id . '.' . end($temp));
}


/**
 * Fonction permettant d'enregistrer le fichier en paramètre dans le dossier de l'utilisateur connecté
 * @return string
 */
private function fileRegistration($fileName, $path): string
{
    $temp = explode(".", $_FILES[$fileName]['name']);
    $newfilename = $fileName . '.' . end($temp);
    // $uploaddir = 'hotels/' . $this->login . '/';
    $path .= $newfilename;
    if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $path)) {
        $result =  "Le fichier est valide et a été télécchargé.\n";
    } else {
        $result =  "POssiblement une attaque par fichier!\n";
    }
    return $result;
}

public function renameFile($fileName, $path, $id) {
    $temp = explode(".", $_FILES[$fileName]['name']);
    $newfilename = $fileName . $id . '.' . end($temp);
    return rename($path . $fileName . '.' . end($temp), $path . $newfilename);
}


/**
 * Fonction englobante de toutes les autres méthodes de la classe
 */
public function registrationChecks($file, $path)
{
    if(!empty($this->filesArray)) {
        if (!$this->array_partial_search($file)) {
            $this->fileRegistration($file, $path);
        } else {
            $oldFile = $this->returnFile($file);
            unlink($path . '/' . $oldFile);
            $this->fileRegistration($file, $path);
        }
    }

    $this->fileRegistration($file, $path);
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