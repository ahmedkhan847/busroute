<?php
include 'Connection.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$resulloc = '';
/*Get Locations*/
function GetLocId($name)
{
    $conn = ConnectDB();
    $lcoids = array();
    
    $locationid1 = "SELECT locs_id,lat,longe FROM tb_location where loc_name = '". $name . "'";
    //mysql_select_db($dbname);
    //mysql_select_db($dbname);
   $resultloc1 = $conn ->query($locationid1);
   if(!$resultloc1)
    {
       die('Could not get data: ' . mysql_error());


    }
    while($row = $resultloc1 -> fetch_assoc())
    {
            $lcoids = array(
                "id" => $row['locs_id'],
                "latitude" => $row['lat'],
                "longitude" => $row['longe']
                
            );
                    
     } 
     
     ConnectClose($conn);
   return $lcoids;
}

/*Find Busses On The Basis Of Location*/
function GetBusLoc($busloc)
{
    
    $conn = ConnectDB();
    $count = 0;
    $loc = [];
    
    //foreach ($busloc as $bus)
    //{
        $busid1 ="Select loc_id from tb_route where bus_id = '" . $busloc . "'";
        $result = $conn ->query($busid1) or die(mysql_error($conn));
        
    while($row = $result -> fetch_assoc())
    {
            $loc[$count] = $row['loc_id'];
            $count++;
   
    } 

    
   // }
    
    ConnectClose($conn);
    
    return $loc;
}

/*If no Busses Found*/
 function FindBusLoc($name)
{
     $conn = ConnectDB();
    $loc = [] ;
    $count = 0;
    
    
   // foreach ($name as $value) {
   foreach ($name as $value) {
     //   echo 'in 2nd foreach where value = '.$value;
    $sqlloc = "SELECT `loc_id` FROM `tb_route` WHERE `bus_id` = '" . $value . "'";
    //mysql_select_db($dbname);
   // echo $sqlloc;
   //ConnectDB();
    $resultloc = $conn ->query($sqlloc);
  //  echo 'connection done' . "\r\n";
    if(!$resultloc)
    {
       die('Could not get data: ' . mysql_error($conn));


    }
    while($row = $resultloc -> fetch_assoc())
    {
         //   echo 'fetching result' . "\n";
          //  echo $row['loc_id'] . "\n";
            if(!in_array($row['loc_id'], $loc))
            {
                $loc[$count] = $row['loc_id'];
                $count++;
            }
            
   
    }  
   }        
     
    //}
    ConnectClose($conn);
  
    return $loc;
}

/* Getting Busses From The IDs */
function GetBuses($name)
{
    $conn = ConnectDB();
    $bus = [] ;
    $count = 0;
    $busid1 ="Select bus_id from tb_route where loc_id = '" . $name . "'";
    //mysql_select_db($dbname);
   
    $resultbus1 = $conn ->query($busid1);
   if(!$resultbus1)
    {
       die('Could not get data: ' . mysql_error());


    }
    while($row = $resultbus1 -> fetch_assoc())
    {
            
            $bus[$count] = $row['bus_id'];
            $count++;
   
    } 
    ConnectClose($conn);
    return $bus;
}
function FindBusName($name)
{
    $conn = ConnectDB();
    $busname = "" ;
    $locationid1 = "SELECT bus_name FROM tb_bus where buses_id = ". $name . "";
    //mysql_select_db($dbname);
    
   
   $resultloc1 = $conn ->query($locationid1);
   if(!$resultloc1)
    {
       die('Could not get data: ' . mysql_error($conn));


    }
    while($row = $resultloc1 -> fetch_assoc())
    {
        //echo $row['bus_name'].'<br>';
            $busname = $row['bus_name'];
            
    } 
    ConnectClose($conn);
    return $busname;
}

function AllLoc()
{
    $conn = ConnectDB();
    $locations = [];
    $loca ="Select * from tb_location";
        $result = $conn ->query($loca) or die(mysql_error());
        
    while($row =$result -> fetch_assoc())
    {
            $loc[$row['locs_id']] = array(
                "name" => $row['loc_name'],
                "latitude" => $row['lat'],
                "longitude" => $row['longe']
                
            );
            
   
    } 
    ConnectClose($conn);
    return $loc;
}
?>