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

?>