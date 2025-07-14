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

function getNom($id)
{
    $connect = dbconnect();
    $req = "SELECT nom FROM emprunts_membre WHERE id_membre = '$id'";
    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else 
    {
        $nom;
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $nom = $row['nom'];
        }
        return $nom;
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
    $nomCategorie = mysqli_real_escape_string($connect, $nomCategorie);

    $req = "SELECT * FROM vue_objets_emprunt WHERE nom_categorie = '$nomCategorie' ORDER BY nom_objet";
    $result = mysqli_query($connect, $req);

    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }

    $emprunts = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $emprunts[] = [
            'id_objet' => $row['id_objet'], 
            'nom_objet' => $row['nom_objet'],
            'nom_categorie' => $row['nom_categorie'],
            'proprietaire' => $row['proprietaire'],
            'date_retour' => $row['date_retour']
        ];
    }

    return $emprunts;
}

function getIDCategorie($nom_categorie)
{
    $connect = dbconnect();
    $req = "SELECT id_categorie FROM emprunts_categorie_objet WHERE nom_categorie = '$nom_categorie';";
    $result = mysqli_query($connect,$req);
    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }
    else 
    {
        $id;
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $id = $row['id_categorie'];
        }
        return $id;
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

function getPhoto($id)
{
    $connect = dbconnect();
    $req = "SELECT image_profil FROM emprunts_membre WHERE id_membre = $id";
    $res = mysqli_query($connect, $req);
    if ($res && $row = mysqli_fetch_assoc($res)) 
    {
        return $row['image_profil'];
    }
    return null;
}

function getFicheObjet($id)
{
    $connect = dbconnect();
    $id = intval($id);

    $req = "SELECT o.nom_objet, c.nom_categorie, m.nom AS proprietaire
            FROM emprunts_objet o
            JOIN emprunts_categorie_objet c ON o.id_categorie = c.id_categorie
            JOIN emprunts_membre m ON o.id_membre = m.id_membre
            WHERE o.id_objet = $id";

    $res = mysqli_query($connect, $req);
    return mysqli_fetch_assoc($res);
}

function getImagesObjet($id)
{
    $connect = dbconnect();
    $id = intval($id);

    $req = "SELECT nom_image FROM emprunts_images_objet WHERE id_objet = $id";
    $res = mysqli_query($connect, $req);
    $images = [];

    while ($row = mysqli_fetch_assoc($res)) 
    {
        $images[] = '../assets/upload/'.$row['nom_image'];
    }

    return $images;
}

function getHistoriqueEmprunts($id)
{
    $connect = dbconnect();
    $id = intval($id);

    $req = "SELECT e.date_emprunt, e.date_retour, m.nom AS emprunteur
            FROM emprunts_emprunt e
            JOIN emprunts_membre m ON e.id_membre = m.id_membre
            WHERE e.id_objet = $id
            ORDER BY e.date_emprunt DESC";

    $res = mysqli_query($connect, $req);
    $hist = [];

    while ($row = mysqli_fetch_assoc($res)) 
    {
        $hist[] = $row;
    }

    return $hist;
}



?>