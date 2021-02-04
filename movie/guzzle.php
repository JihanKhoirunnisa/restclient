<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
    'query' => [
        'apikey' => 'db512ae2',
        's' => 'harry potter'
    ]

]);

$result = json_decode($response->getBody()->getContents(), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widht=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ei=edge">
    <title>Document</title>
</head>

<body>
    <?php foreach ($result['Seacrh'] as $movie) :  ?>
        <ul>
            <li>Title :<?= $movie['Title']; ?>/li>
            <li>Year : <?= $movie['Year']; ?></li>
            <li>
                <img src="<?= $movie['Poster']; ?>" width="80">
            </li>
        </ul>
    <?php endforeach ?>

</body>

</html>