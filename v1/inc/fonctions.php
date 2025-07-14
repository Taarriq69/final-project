<?php
require 'connection.php';
ini_set('display_errors', 1);

function getAllDeparments() 
{
    $connect = dbconnect();
    $query = "SELECT * FROM departments";
    $result = mysqli_query($connect, $query);
    
    if (!$result) 
    {
        die('Erreur de la requête : ' . mysqli_error($connect));
    }
    
    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $departments[] = $row;
    }
    
    mysqli_free_result($result);
    return $departments;
}

function getEmployeesByDept($dept_no, $limit = 20, $offset = 0) 
{
    $connect = dbconnect();

    $dept_no = mysqli_real_escape_string($connect, $dept_no);
    $limit = (int)$limit;
    $offset = (int)$offset;

    $sql = "
        SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date
        FROM employees e
        INNER JOIN dept_emp de ON e.emp_no = de.emp_no
        WHERE de.dept_no = '$dept_no' AND de.to_date = '9999-01-01'
        ORDER BY e.last_name, e.first_name
        LIMIT $limit OFFSET $offset
    ";

    $result = mysqli_query($connect, $sql);

    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }

    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $employees[] = $row;
    }

    mysqli_free_result($result);

    return $employees;
}

function getEmployeesCountByDept($dept_no) 
{
    $connect = dbconnect();

    $dept_no = mysqli_real_escape_string($connect, $dept_no);

    $sql = "SELECT COUNT(*) as total FROM dept_emp WHERE dept_no = '$dept_no' AND to_date = '9999-01-01'";

    $result = mysqli_query($connect, $sql);

    if (!$result) 
    {
        die('Erreur de requête : ' . mysqli_error($connect));
    }

    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return (int)$row['total'];
}

function getDepartmentName($dept_no) 
{
    $connect = dbconnect();
    $dept_no = mysqli_real_escape_string($connect, $dept_no);

    $sql = "SELECT dept_name FROM departments WHERE dept_no = '$dept_no'";
    $result = mysqli_query($connect, $sql);

    if ($row = mysqli_fetch_assoc($result)) 
    {
        return $row['dept_name'];
    }

    return null;
}

function getManager($dept)
{
    $connect = dbconnect();
    $req = "SELECT dm.emp_no, dm.dept_no,e.first_name
    FROM dept_manager dm
    JOIN employees e ON dm.emp_no = e.emp_no
    WHERE dm.dept_no = '$dept' AND dm.to_date = '9999-01-01';";
    $result = mysqli_query($connect,$req);
    if (!$result) 
    {
        die('Erreur de requete : ' . mysqli_error($connect));
    }
    $manager = [];
    while($row = mysqli_fetch_assoc($result))
    {
        $manager[] = $row;
    }
    mysqli_free_result($result);
    return $manager;

}

function getAllDepartments()
{
    $connect = dbconnect();
    $sql = "SELECT * FROM departments ORDER BY dept_name";
    $result = mysqli_query($connect, $sql);

    if (!$result) {
        die("Erreur lors de la récupération des départements : " . mysqli_error($connect));
    }

    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }

    mysqli_free_result($result);
    return $departments;
}

function getEmployeeById($emp_no)
{
    $connect = dbconnect();
    $emp_no = mysqli_real_escape_string($connect, $emp_no);

    $sql = "SELECT * FROM employees WHERE emp_no = '$emp_no'";
    $result = mysqli_query($connect, $sql);

    if (!$result || mysqli_num_rows($result) === 0) 
    {
        return null;
    }

    $employe = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $employe;
}

function getSalaryHistory($emp_no)
{
    $connect = dbconnect();
    $emp_no = mysqli_real_escape_string($connect, $emp_no);

    $sql = "SELECT salary, from_date, to_date FROM salaries WHERE emp_no = '$emp_no' ORDER BY from_date DESC";
    $result = mysqli_query($connect, $sql);

    $salaries = [];
    if ($result) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $salaries[] = $row;
        }
        mysqli_free_result($result);
    }

    return $salaries;
}

function getTitleHistory($emp_no)
{
    $connect = dbconnect();
    $emp_no = mysqli_real_escape_string($connect, $emp_no);

    $sql = "SELECT title, from_date, to_date FROM titles WHERE emp_no = '$emp_no' ORDER BY from_date DESC";
    $result = mysqli_query($connect, $sql);

    $titles = [];
    if ($result) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $titles[] = $row;
        }
        mysqli_free_result($result);
    }

    return $titles;
}
function rechercher($department,$nom,$age_min,$age_max){
    $connect = dbconnect();
    $req = "SELECT * FROM employees WHERE 1=1";

    if ($department !="") {
        $req .=" AND emp_no IN (SELECT emp_no FROM dept_emp WHERE dept_no = '$department' AND NOT to_date = '9999-01-01') ";
    }
    if ($nom !="") {
        $req .= " AND (first_name LIKE '%$nom%' OR last_name LIKE '%$nom%') ";
    }
    if ($age_min !="") {
        $req .= " AND birth_date <= DATE_SUB(CURDATE(), INTERVAL $age_min YEAR) ";
    }
    if ($age_max !="") {
        $req .= "AND birth_date >= DATE_SUB(CURDATE(), INTERVAL $age_max YEAR) ";
    }

    $result = mysqli_query($connect, $req);
    if (!$result) 
    {
        return 0;
    }
    $resultats = [];
    while ($row = mysqli_fetch_assoc($result))
    {
        $resultats[] = $row;
    }

    return $resultats;
}
?>