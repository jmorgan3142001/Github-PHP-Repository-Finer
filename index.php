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

echo "<h1 class='bg-dark text-light w-50 m-3 p-3 mx-auto text-center rounded'>Top <u>100</u> Public PHP Github Repositories</h2>";
echo "<h5 class='mx-auto w-25 border border-dark p-1 m-3 text-center'>Click <a href='".$url."/db_refresh.php'><u>HERE</u></a> to refresh the database</h5>";

//Retrieves all of the data from the repos table
$mysqli = DBConnect();
$sql = 'select * from repos order by id';
$query_data = $mysqli->query($sql);
if($query_data == false) die('DB Error: '.$mysqli->error);

echo "<table border='1' class='table table-striped table-sm w-25 mx-auto'>";
echo "<thead class='thead-dark'><tr><th scope='col'>Rank</th><th scope='col'>Name</th><th scope='col'>&nbsp# of Stars&nbsp</th></tr></thead>";
while ($row = $query_data->fetch_assoc()) {
    echo "<tr><th scope='row'>".($row['id']+1)."</th><td><a href='detail.php/?id=".$row['id']."'>".$row['name']."</a></td><td>".$row['stars']."</td></tr>";
}
echo "</table>";

$mysqli->close();

?>