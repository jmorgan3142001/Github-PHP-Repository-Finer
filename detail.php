<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Repository Detail</title>
  </head>

<?php

require 'DBConnect.php';

$this_url = $_SERVER['SERVER_NAME'];

//Connect to the database and read the row at the specified GET id
$mysqli = DBConnect();
$sql = 'select * from repos where id = '.$_REQUEST['id'];
$query_data = $mysqli->query($sql);
if($query_data == false) die('DB Error: '.$mysqli->error);

$row = $query_data->fetch_assoc();

echo "<h1 class='bg-dark text-light w-50 m-3 p-3 mx-auto text-center rounded'>Details for the <b><u>".$row['name']."</u></b> Repository</h1>";

echo "<table border='1' class='table table-striped w-50 mx-auto'><thead class='thead-dark'><tr><th></th><th></th></tr></thead>";
echo "<tr><th scope='row'>Rank</th><td>".($row['id'] + 1)."</td></tr>";
echo "<tr><th scope='row'>Name</th><td>".$row['name']."</td></tr>";
echo "<tr><th scope='row'>URL</th><td><a target='_blank' href='".$row['url']."'>".$row['url']."</a></td></tr>";
echo "<tr><th scope='row'>Date Created</th><td>".$row['created_date']."</td></tr>";
echo "<tr><th scope='row'>Last Updated</th><td>".$row['last_push_date']."</td></tr>";
echo "<tr><th scope='row'>Description</th><td>".$row['description']."</td></tr>";
echo "<tr><th scope='row'>Star Count</th><td>".$row['stars']."</td></tr>";
if($_REQUEST['id'] < 1){
    echo "<tr><td></td><td class='text-right'><a href='/detail.php?id=".($_REQUEST['id']+1)."'>Next-></a></td></tr>";
} else if($_REQUEST['id'] > 98){
    echo "<tr><td><a href='/detail.php?id=".($_REQUEST['id']-1)."'><-Previous</a></td><td class='text-right'></td></tr>";
} else {
    echo "<tr><td><a href='/detail.php?id=".($_REQUEST['id']-1)."'><-Previous</a></td><td class='text-right'><a href='/detail.php?id=".($_REQUEST['id']+1)."'>Next-></a></td></tr>";
}
echo "</table>";

echo "<h4 class='mx-auto w-25 border border-dark p-3 m-3 text-center'>Click <a href='index.php'><u>HERE</u></a> to return the the home page</h4>";

$mysqli->close();

?>