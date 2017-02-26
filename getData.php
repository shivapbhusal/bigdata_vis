<?php
ini_set('display_errors', 1); 
    $username = "root"; 
    $password = "";   
    $host = "localhost";
    $database="bigdata";
    
    $station=$_GET["station"];  
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "SELECT  `year`, `avg_temp` FROM  station_info WHERE `station_id`='$station'";
    $query = mysql_query($myquery);
    $table = array();
    $table['cols'] = array(
    
    array('label' => 'year', 'type' => 'string'),
    array('label' => 'avg_temp', 'type' => 'number'),

);
    $rows = array();
    while($r = mysql_fetch_assoc($query)) {
    $temp = array();
    $temp[] = array('v' => $r['year']);
    $temp[] = array('v' => $r['avg_temp']);
   
    
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