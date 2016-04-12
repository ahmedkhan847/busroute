<?php
require 'header.php';
require 'crud.php';
$busloc1 = [];
$busloc2 = [];
$busnames = "";
$busroute = [];
$buscount = 0;
$location[0] = $_REQUEST["loc1"];
$location[1] = $_REQUEST["loc2"];
$location1 = [];
$location2 = [];
// Create connection
$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

 $busloc1 = GetBuses($location[0]);
 $busloc2 = GetBuses($location[1]);
 $busname = AlgoForBus($busloc1, $busloc2);
 


/*Find Similar Bus*/
function AlgoForBus($busloc1,$busloc2)
{
    
    $busname = array();
    $buscounts = 0;
    $countl = sizeof($busloc2);
    $route1 = true;
    $busnames = array();
    foreach ($busloc1 as $bus)
    {
        //for($count = 0; $count < $countl ; $count++)
       // {
            if(in_array($bus, $busloc2))                 //($bus == $busloc2[$count])
            {
                $busname["Bus".$buscounts] = array(
                  "busname" => FindBusName($bus),
                    "route" => GetBusLoc($bus)
                );
                $buscounts++;
                /*$busname[$buscount] = FindBusName($bus, $conn, $dbname);
                $buscount++;*/
                
            }
       // }
    }
    
    
  //  $busempty = empty($busroute);
    
    if(empty($busname))
    {
      $route1 = false;
      $busname =  AlgoForBuS2($busloc1, $busloc2);   
    }
    if($route1)
    {
        $busnames["oneway"] = $busname ;
    }
 else {
            $busnames["twoway"] = $busname;
    }
    
    return $busnames;
}

/*Find Similar Bus*/
function AlgoBus($busloc1,$busloc2)
{
    
    $busname = array();
    $buscounts = 0;
    $countl = sizeof($busloc2);
   
    
    foreach ($busloc1 as $bus)
    {
        //for($count = 0; $count < $countl ; $count++)
       // {
            if(in_array($bus, $busloc2))                 //($bus == $busloc2[$count])
            {
                $busname["Bus".$buscounts] = array(
                  "busname" => FindBusName($bus),
                    "route" => GetBusLoc($bus)
                );
                $buscounts++;
                /*$busname[$buscount] = FindBusName($bus, $conn, $dbname);
                $buscount++;*/
                
            }
       // }
    }
    
    
    return $busname;
}

function  AlgoForBuS2($busloc1,$busloc2)
{
        $busname = [];
        $buscounts = 0;
        $buses = array();
        $busnewloc1 = array();
        $busnewloc2 = array();
        $busnames1 = array();
        $busnames2 = array();
        $busnewcount1 = 0;
        $busnewcount2 = 0;
        $locations1 = FindBusLoc($busloc1);
        $locations2 = FindBusLoc($busloc2);
        
        
       
        foreach ($locations1 as $loc)
        {
            if(in_array($loc, $locations2))                 //($bus == $busloc2[$count])
            {
           //     echo $loc .'<br>';
                
               $buses[$buscounts] = GetBuses($loc); 
               $buscounts++; 
               /*$busname['Bus'.$buscounts] = array(
                  "busname" => FindBusName($loc)  
                );
                $buscounts++;*/
                //$busname[$buscount] = FindBusName($bus, $conn, $dbname);
                //$buscount++;
                
            }
        }
        
        foreach ($buses as $value) {
            $newroute = true;
           $busnames1 =  AlgoBus($busloc1, $value);
           $busnames2 = AlgoBus($busloc2, $value);
           if(!empty($busnames1))
           {
               $busnewloc1[$busnewcount1] = $busnames1;
               $busnewcount1++;
               
           }
           if(!empty($busnames2))
           {
               $busnewloc2[$busnewcount2] = $busnames2;
               $busnewcount2++;
           }
                       
           
           
        }
        
        
        return array_merge($busnewloc1,$busnewloc2);
}
echo json_encode($busname);
?> 
