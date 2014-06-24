<?php

header('Content-type: application/json');

include('dbopen.php');

$sql = "SELECT * FROM produto WHERE status = '1' ORDER BY descricao";

$result = mysql_query($sql) or die("Query error: " . mysql_error());

$records = array();

while ($row = mysql_fetch_assoc($result))
{
    $records[] = $row;
}

include('dbclose.php');

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
