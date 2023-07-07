<?php

require 'DBConnect.php';

//Connect to the database and read the row at the specified GET id
$mysqli = DBConnect();
$sql = 'select * from repos where id = '.$_REQUEST['id'];
$query_data = $mysqli->query($sql);
if($query_data == false) die('DB Error: '.$mysqli->error);

$row = $query_data->fetch_assoc();

echo "<h2 align='center'>Details for the <u>".$row['name']."</u> Repository</h2>";

echo "<table border='1' align='center'>";
echo "<tr><td>Rank</td><td>".($row['id'] + 1)."</td></tr>";
echo "<tr><td>Name</td><td>".$row['name']."</td></tr>";
echo "<tr><td>URL</td><td><a target='_blank' href='".$row['url']."'>".$row['url']."</a></td></tr>";
echo "<tr><td>Date Created</td><td>".$row['created_date']."</td></tr>";
echo "<tr><td>Last Updated</td><td>".$row['last_push_date']."</td></tr>";
echo "<tr><td>Description</td><td>".$row['description']."</td></tr>";
echo "<tr><td>Star Count</td><td>".$row['stars']."</td></tr>";
echo "</table>";

echo "<h4 align='center'>Click <a href='javascript:history.back(-1)'>HERE</a> to return the the previous page</h4>";

$mysqli->close();

?>