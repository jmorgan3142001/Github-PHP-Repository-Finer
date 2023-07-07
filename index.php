<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>PHP Repository List</title>
  </head>

<?php

require 'DBConnect.php';

$url_request = explode("/", $_SERVER['REQUEST_URI']);
$url = $url_request[0];

echo "<h2 align='center'>Top 100 Public PHP Github Repositories</h2>";
echo "<h4 align='center'>Click <a href='".$url."/db_refresh.php'>HERE</a> to refresh the database</h4>";

//Retrieves all of the data from the repos table
$mysqli = DBConnect();
$sql = 'select * from repos order by id';
$query_data = $mysqli->query($sql);
if($query_data == false) die('DB Error: '.$mysqli->error);

echo "<table border='1' align='center'>";
echo "<tr><th></th><th>Name</th><th>&nbsp# of Stars&nbsp</th></tr>";
while ($row = $query_data->fetch_assoc()) {
    echo "<tr><td>".($row['id']+1)."</td><td><a href='".$url."detail.php/?id=".$row['id']."'>".$row['name']."</a></td><td align='center'>".$row['stars']."</td></tr>";
}
echo "</table>";

$mysqli->close();

?>