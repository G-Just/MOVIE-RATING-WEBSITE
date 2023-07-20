<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700;800&family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Movie-rating-website</title>
    <link rel="icon" href="media/favicon-16x16.png">
</head>
<?php
$backgrounds = array();
foreach (array_values(array_diff(scandir("media/backgrounds"),array('.','..'))) as $background){
    array_push($backgrounds, $background);
}
session_start();
$url = "url(../media/backgrounds/".$backgrounds[array_rand($backgrounds, 1)];
echo "<body style=background-image:$url)>";



