<?php

/* 
 * Get All Location From The Database
 */
require 'header.php';
require 'crud.php';

$location = AllLoc();

echo json_encode($location);

