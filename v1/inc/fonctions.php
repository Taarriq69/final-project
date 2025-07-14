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

?>