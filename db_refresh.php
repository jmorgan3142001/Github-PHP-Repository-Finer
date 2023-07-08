<?php

require 'vendor/autoload.php';
require 'DBConnect.php';

//open api connection

$token = 'YOUR_TOKEN_HERE';
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://api.github.com/',
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/vnd.github.v3+json',
    ],
    'verify' => false
]);

//request information on the top 100 PHP repositories by stars
$response = $client->request('GET', 'search/repositories', [
    'query' => [
        'q' => 'language:php',
        'sort' => 'stars',
        'order' => 'desc',
        'per_page' => 100 //accept the top 100 repositories at the time of API call
    ]
]);
$data = json_decode($response->getBody(), true);

//process response from Github API
if ($response->getStatusCode() == 200) {
    $modfunc = '';
} else {
    echo 'Error: ' . $response->getStatusCode();
    die();
}

$mysqli = DBConnect();

$sql = "delete from repos";
if($mysqli->query($sql)){}
else{
    echo 'DB Error: '.$mysqli->error;
}

//following opperation prepares and binds the values to an sql insert statement for each repository
$sql = "insert into repos values (?,?,?,?,?,?,?)";
$stmt = $mysqli->prepare($sql);
if($stmt == false) die('DB Error: ' . $mysqli->error);

for($i = 0; $i < 100; $i++){
    $name = $data['items'][$i]['name'];
    $url = $data['items'][$i]['html_url'];
    $created = substr($data['items'][$i]['created_at'],0,10);
    $updated = substr($data['items'][$i]['updated_at'],0,10);
    $description = $data['items'][$i]['description'];
    $stars = $data['items'][$i]['stargazers_count'];

    $stmt->bind_param('isssssi', $i, $name, $url, $created, $updated, $description, $stars);
    if($stmt->execute()){}
    else{
        echo 'DB Error: '.$mysqli->error;
    }
}

$stmt->close();
$mysqli->close();

//automatically redirects the user to the home page after the completion
echo "<script>window.location.replace('/index.php');</script>";

?>