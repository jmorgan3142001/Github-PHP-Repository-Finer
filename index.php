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

//retrieves from the database to search for a name searched by the user
if($_REQUEST['name_search']){
    $mysqli = DBConnect();
    $sql = 'select * from repos order by id';
    $query_data = $mysqli->query($sql);
    if($query_data == false) die('DB Error: '.$mysqli->error);
}

//gives the user the option to search directly for a repository by rank
$rank_placeholder = 'Search by Repository Rank';
if($_REQUEST['rank_search'] and ($_REQUEST['rank_search'] < 1 or $_REQUEST['rank_search'] > 100)){
    $rank_placeholder = 'Value must be an integer between 1 and 100.';
}
echo '
    <form action="index.php" method="POST"> 
        <div class="input-group mb-3 w-25 mx-auto float-left">
            <div class="input-group-prepend">
                <button class="btn btn-secondary" type="submit" value="submit">Search</button>
            </div>
            <input type="text" class="form-control text-right" placeholder="'.$rank_placeholder.'" aria-label="search_rank" aria-describedby="basic-addon1" name="rank_search">
        </div>
    </form>
';

//gives the user the option to search directly for a repository by name
$name_placeholder = 'Search by Repository Name';
if($_REQUEST['name_search']){
    while ($row = $query_data->fetch_assoc()) {
        if(strtoupper($row['name']) == strtoupper($_REQUEST['name_search'])){
            echo "<script>window.location.replace('detail.php/?id=".$row['id']."');</script>"; //redirects user the the detail page of a repository when it is found
        }
    }
    $name_placeholder = $_REQUEST['name_search'].' - Not Found.';
}

echo '
    <form action="index.php" method="POST">
        <div class="input-group mb-3 w-25 mx-auto float-right">
            <input type="text" placeholder="'.$name_placeholder.'" class="form-control" aria-label="search_name" aria-describedby="basic-addon2" name="name_search">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit" value="submit">Search</button>
            </div>
        </div>
    </form>
';

echo "<h1 class='bg-dark text-light w-50 m-3 p-3 mx-auto text-center rounded'>Top <b><u>100</u></b> Public PHP Github Repositories</h2>";
echo "<h5 class='mx-auto w-25 border border-dark p-1 m-3 text-center'>Click <a href='db_refresh.php'><u>HERE</u></a> to refresh the database</h5>";

//Retrieves all of the data from the repos table
$mysqli = DBConnect();
$sql = 'select * from repos order by id';
$query_data = $mysqli->query($sql);
if($query_data == false) die('DB Error: '.$mysqli->error);

echo "<table border='1' class='table table-striped table-sm w-25 mx-auto'>";
echo "<thead class='thead-dark'><tr><th scope='col'>Rank</th><th scope='col'>Name</th><th scope='col'>&nbsp# of Stars&nbsp</th></tr></thead>";
while ($row = $query_data->fetch_assoc()) {
    if($row['id']+1 != $_REQUEST['rank_search']){
        echo "<tr><th scope='row' id='".($row['id']+1)."'>".($row['id']+1)."</th><td><a href='detail.php/?id=".$row['id']."'>".$row['name']."</a></td><td>".$row['stars']."</td></tr>";
    } else {
        //Hightlights the index searched for by rank search 
        echo "<tr class='bg-dark'><th scope='row' class='text-light' id='".($row['id']+1)."'>".($row['id']+1)."</th><td><a href='detail.php/?id=".$row['id']."'>".$row['name']."</a></td><td class='text-light'>".$row['stars']."</td></tr>";
    }
}
echo "</table>";

//redirects user to the rank they searched
if($_REQUEST['rank_search'] and ($_REQUEST['rank_search'] > 0 or $_REQUEST['rank_search'] < 101)){
    echo "<script>window.location.replace('#".$_REQUEST['rank_search']."');</script>";
}

$mysqli->close();

?>
