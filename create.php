<?php
$title = strip_tags($_POST["title"]);
$picture = strip_tags($_POST["picture"]);
$author = strip_tags($_POST["author"]);
$magazine = $_POST["magazine"];

$doc = new DOMDocument();
$doc->load('games.xml');

$co = $doc->createElement("game", "");
$gdzie = $doc->getElementsByTagName("root")->item(0);
$gdzie->appendChild($co);

$games = $doc->getElementsByTagName('game');

$i = 0;
foreach ($games as $game) {


    if ($i + 1 == count($games)) {

        $title1 = $doc->createElement("title", $title);
        $picture1 = $doc->createElement("picture", $picture);
        $author1 = $doc->createElement("author", $author);
        $magazine1 = $doc->createElement("magazine", $magazine);

        $game->appendChild($title1);
        $game->appendChild($picture1);
        $game->appendChild($author1);
        $game->appendChild($magazine1);
    }
    $i++;
}

echo $doc->saveXML();
$doc->save("games.xml");

header("Location: main.php");
exit();
