<?php

$doc = new DOMDocument();
$doc->load('games.xml');

if (isset($_POST['forEdit'])) {
    $forEdit = intval($_POST['forEdit']);
} else {
    $forEdit = -1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>XML - Filip Mazur 3p1</title>
</head>

<body>
    <div style="display:flex; align-items: center; justify-content: center; height:100px">
        <a href="main.php" style=" padding: 10px; margin-right: 10px;">Pozycje</a>
        <a href="main1.php" style="background-color: lightgray; padding: 10px;">Podgląd</a>
        <a href="exportExcel.php" style=" padding: 10px;">Exportuj dane do pliku Xlsx</a>
    </div>
    <table>
        <tr>

            <th>Nazwa gry</th>
            <th>Miniaturka</th>
            <th>Autor</th>
            <th>Czasopismo</th>


        </tr>
        <?php
        $games = $doc->getElementsByTagName('game');
        $i = 0;
        foreach ($games as $game) {

            $title = $game->getElementsByTagName('title')->item(0)->textContent;
            $picture = $game->getElementsByTagName('picture')->item(0)->textContent;
            $author = $game->getElementsByTagName('author')->item(0)->textContent;
            $magazine = $game->getElementsByTagName('magazine')->item(0)->textContent;



            echo "
                <tr>
                    <td>{$title}</td>
                    <td><img src='pictures/{$picture}' style='width: 70px; height: 100px;'></td>
                    <td>{$author}</td>
                    <td>{$magazine}</td>
                </tr>
                ";

            $i++;
        }

        ?>

    </table>




</body>

</html>