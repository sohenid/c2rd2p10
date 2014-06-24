<?php

header('Content-type: application/json');

include('dbopen.php');

$data_update = addslashes($_GET['data_update']);

$id = addslashes($_GET['id']);

if (!$id)
{
    $sql = "SELECT * FROM produto ORDER BY id ASC";
}
else
{
    if (!$data_update)
    {
        $sql = sprintf("SELECT * FROM produto WHERE id <= '%s' AND data_update IS NOT NULL ORDER BY data_update ASC", $id);
    }
    else
    {
        $sql = sprintf("SELECT * FROM produto WHERE id <= '%s' AND data_update > '%s' ORDER BY data_update ASC", $id, $data_update);
    }
}

$result = mysql_query($sql) or die("Query error: " . mysql_error());

$records = array();

while ($row = mysql_fetch_assoc($result))
{
    $records[] = $row;
}

include('dbclose.php');

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
