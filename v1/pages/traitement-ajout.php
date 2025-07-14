<?php
require_once '../inc/fonctions.php';
session_start();
$id_membre = $_SESSION['id_membre'] ?? 1;

$connect = dbconnect();


$nom_objet = mysqli_real_escape_string($connect, $_POST['nom']);
$nom_categorie = mysqli_real_escape_string($connect, $_POST['categorie']);


$id_categorie = getIDCategorie($nom_categorie);


$req_objet = "
    INSERT INTO emprunts_objet (nom_objet, id_categorie, id_membre)
    VALUES ('$nom_objet', $id_categorie, $id_membre)
";
mysqli_query($connect, $req_objet);
$id_objet = mysqli_insert_id($connect);


foreach ($_FILES['images']['name'] as $index => $image_name) 
{
    $image_tmp = $_FILES['images']['tmp_name'][$index];
    $image_name = basename($image_name);
    $image_path ='../assets/upload/' . $image_name;



    move_uploaded_file($image_tmp, $image_path);


    $req_image = "
        INSERT INTO emprunts_images_objet (id_objet, nom_image)
        VALUES ($id_objet, '" . mysqli_real_escape_string($connect, $image_name) . "')
    ";
    mysqli_query($connect, $req_image);
}

header("Location: accueil.php?ajout=ok");
exit;
