<?php

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