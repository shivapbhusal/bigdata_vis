<?php
ini_set('display_errors', 1); 
    $username = "root"; 
    $password = "";   
    $host = "localhost";
    $database="bigdata";
    
    $station=$_GET["station"];
    $stationtwo=$_GET["stationtwo"];  
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "SELECT  `year`, 

        sum(case when `station_id` = '$station' then `avg_temp` else 0 end) AS `$station`,
        sum(case when `station_id` = '$stationtwo' then `avg_temp` else 0 end) AS `$stationtwo`
        
    FROM   `station_info`
    GROUP BY `year`";

    $query = mysql_query($myquery);
    $table = array();
    $table['cols'] = array(
    
    array('label' => 'year', 'type' => 'string'),
    array('label' => $station, 'type' => 'number'),
    array('label' => $stationtwo, 'type' => 'number'),


);
    $rows = array();
    while($r = mysql_fetch_assoc($query)) {
    $temp = array();
    $temp[] = array('v' => $r['year']);
    $temp[] = array('v' => $r['A']);
    $temp[] = array('v' => $r['B']);
   
   
    
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