<?php

header('Content-type: application/json');

include('dbopen.php');

$table = addslashes($_GET['table']);

if ($table)
{
    $sql = "SELECT MAX(id) id FROM {$table}";
    $result = mysql_query($sql) or die("Query error: " . mysql_error());
    $records = array();
    while ($row = mysql_fetch_assoc($result))
    {
        $records[] = $row;
    }
}

include('dbclose.php');

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';