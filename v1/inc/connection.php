<?php
function dbconnect()
{
    static $connect = null;
    if ($connect == null) 
    {
        $connect = mysqli_connect('localhost', 'root', '', 'employees');

        if (!$connect) 
        {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }
    }
    return $connect;    
}

?>