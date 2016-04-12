<?php
require 'config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function ConnectDB()
{
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysql_error());
    //mysql_select_db($dbname);
    //mysql_select_db(DB_DATABASE) or die(mysql_error());
    // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    return $conn;
}
function ConnectClose($conn)
{
    $conn -> close();
    
}


?>