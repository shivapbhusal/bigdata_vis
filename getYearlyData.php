<?php
ini_set('display_errors', 1); 
    $username = "root"; 
    $password = "";   
    $host = "localhost";
    $database="bigdata";
    
    $fromyear=$_GET["myFromYear"];
    $toyear=$_GET["myToYear"];  
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "SELECT * FROM `yearly_data` WHERE (year<=$toyear)&&(year>=$fromyear)";

    $query = mysql_query($myquery);
    $table = array();
    $table['cols'] = array(
    
    array('label' => 'year', 'type' => 'string'),
    array('label' => 'max', 'type' => 'number'),
    array('label' => 'min', 'type' => 'number'),
    array('label' => 'avg', 'type' => 'number'),
    array('label' => 'median','type' => 'number'),


);
    $rows = array();
    while($r = mysql_fetch_assoc($query)) {
    $temp = array();
    $temp[] = array('v' => $r['year']);
    $temp[] = array('v' => $r['max']);
    $temp[] = array('v' => $r['min']);
    $temp[] = array('v' => $r['avg']);
    $temp[] = array('v' => $r['median']);
   
   
    
    $rows[] = array('c' => $temp);
}
// populate the table with rows of data
$table['rows'] = $rows;

// encode the table as JSON
$jsonTable = json_encode($table);

// set up header; first two prevent IE from caching queries
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

// return the JSON data

echo $jsonTable;

?>