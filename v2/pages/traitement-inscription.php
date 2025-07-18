<?php
require_once '../inc/fonctions.php';
ini_set('display_error',1);
$connect = dbconnect();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $nom =$_POST['nom'];
    $date_naissance = $_POST['date_naissance']; 
    $genre =$_POST['genre'];
    $email =$_POST['email'];
    $ville =$_POST['ville'];
    $mdp =$_POST['mdp'];

    if (in_array($email, get_all_mail())) 
    {
        $message = "L'email est déjà utilisé. Veuillez en choisir un autre.";
        header("Location: ../pages/inscription.php?message=" . urlencode($message));
        exit;
    }

    $req = "INSERT INTO emprunts_membre (nom, date_naissance, genre, email, ville, mdp) VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp')";

    $result = mysqli_query($connect, $req);

    if (!$result) 
    {
        $message = "Erreur lors de l'inscription : " . mysqli_error($connect);
        header("Location: ../pages/inscription.php?message=" . urlencode($message));
        exit;
    }
     else 
    {
        header("Location: ../pages/login.php");
        exit;
    }
}
?>
