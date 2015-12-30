<?php
/*
    $connection = mysqli_connect("localhost","root","admin","brew_view") or die("Error " . mysqli_error($connection));

    //fetch department names from the department table
    $sql = "select name from dbtablebeer";
    $result = mysqli_query($connection, $sql) or die("Error " . mysqli_error($connection));

    $dname_list = array();
    while($row = mysqli_fetch_array($result))
    {
        $dname_list[] = $row['name'];
    }
    echo json_encode($dname_list);
    */
    
        //database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'admin';
    $dbName = 'brew_view';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    $sql = "SELECT name FROM dbtablebeer WHERE name LIKE '%".$searchTerm."%'";
    //get matched data from skills table
    $query = $db->query($sql);
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['name'];
    }
    
    //return json data
    echo json_encode($data);
?>