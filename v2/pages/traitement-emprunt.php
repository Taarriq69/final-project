<?php
require_once '../inc/fonctions.php';
session_start();

if (!isset($_SESSION['id']) || !isset($_POST['id_objet']) || !isset($_POST['date_retour'])) 
{
    die("Requête invalide.");
}

$id_objet = intval($_POST['id_objet']);
$id_membre = $_SESSION['id'];
$date_emprunt = date('Y-m-d');
$date_retour = $_POST['date_retour'];

if (strtotime($date_retour) <= strtotime($date_emprunt)) {
    die("La date de retour doit être postérieure à la date d'emprunt.");
}

$connect = dbconnect();

$req = "INSERT INTO emprunts_emprunt (id_objet, id_membre, date_emprunt, date_retour)
        VALUES ($id_objet, $id_membre, '$date_emprunt', '$date_retour')";

if (mysqli_query($connect, $req)) 
{
    header("Location: accueil.php?emprunt=ok");
    exit;
} 
else 
{
    die("Erreur SQL : " . mysqli_error($connect));
}
