<?php session_start();

/**
 * Permet de rechercher une valeur partielle dans un tableau
 * @return bool
 */

function array_partial_search( $array, $keyword ):bool {
    foreach ( $array as $string ) {
        if ( strpos( $string, $keyword ) !== false ) {
            $check = true;
        } else { 
            $check = false;
        }
    }
    return $check;
}

if (isset($_POST['confirm'])) {
    if (!is_dir('hotels/' . $_SESSION['login'] . '/')) {
        mkdir('hotels/' . $_SESSION['login'] . '/', 0777, true);
    }

    $path = 'hotels/' . $_SESSION['login'] . '/';
    $files = scandir($path);
    $files = array_diff(scandir($path), array('.', '..'));
    var_dump(array_partial_search($files, 'homePhoto'));
    

    $temp = explode(".", $_FILES['homePhoto']['name']);
    $newfilename = 'homePhoto' . '.' . end($temp);

    $uploaddir = 'hotels/' . $_SESSION["login"] . '/';
    $uploadfile = $uploaddir . $newfilename;

    echo '<pre>';
    if (move_uploaded_file($_FILES['homePhoto']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }

    echo 'Here is some more debugging info:';
    print_r($_FILES);

    print "</pre>";
}
