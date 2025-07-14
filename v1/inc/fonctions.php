<?php
require 'connection.php';
ini_set('display_errors', 1);

function get_all_mail()
{
    $connect = dbconnect();
    $req = "SELECT email FROM emprunts_membre";
    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else 
    {
        $emails = [];
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $emails[] = $row['email'];
        }
        return $emails;
    }
}

function checkmdp($email,$mdp)
{
    $connect = dbconnect();
    $req = "SELECT mdp FROM emprunts_membre WHERE email = '$email'";
    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else 
    {
        $row = mysqli_fetch_assoc($result);
        if ($row['mdp'] == $mdp) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
}

function getID($email)
{
    $connect = dbconnect();
    $req = "SELECT id_membre FROM emprunts_membre WHERE email = '$email'";
    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else 
    {
        $id;
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $id = $row['id_membre'];
        }
        return $id;
    }
}


function getAllEmprunts($nomCategorie)
{
    $connect = dbconnect();
    $req = "SELECT * FROM vue_objets_emprunt WHERE nom_categorie = '$nomCategorie' ORDER BY nom_objet";
    $result = mysqli_query($connect, $req);
    if (!$result)
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else
    {
        $emprunts = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $emprunts[] = [
                'nom_objet' => $row['nom_objet'],
                'nom_categorie' => $row['nom_categorie'],
                'proprietaire' => $row['proprietaire'],
                'date_retour' => $row['date_retour']
            ];
        }
        return $emprunts;
    }
}
function getAllCategories()
{
    $connect = dbconnect();
    $req = "SELECT nom_categorie FROM emprunts_categorie_objet ORDER BY nom_categorie";
    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else 
    {
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $categories[] = $row['nom_categorie'];
        }
        return $categories;
    }
}
?>