<?php
require_once '../inc/fonctions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (checkmdp($email, $mdp)) 
    {
       $ID = getID($email);
       $_SESSION['id'] = $ID;
       header("location: ../pages/accueil.php");
       exit;
    } 
    else 
    {
        $message = "❌ Email ou mot de passe incorrect.";
    }
} 
else 
{
    $message = "❌ Requête invalide.";
}

header("Location: ../pages/login.php?message=" . urlencode($message));
exit;
?>
