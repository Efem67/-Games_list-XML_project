<?php
$title = strip_tags($_POST["title"]);
$picture = strip_tags($_POST["picture"]);
$author = strip_tags($_POST["author"]);
$magazine = $_POST["magazine"];
$itemValue = intval($_POST["whichValue"]);

$doc = new DOMDocument();
$doc->load('games.xml');

$games = $doc->getElementsByTagName('game');
$i = 0;
foreach ($games as $game) {


    if ($i == $itemValue) {
        $newTitle = $game->getElementsByTagName('title')->item(0);
        $newPicture = $game->getElementsByTagName('picture')->item(0);
        $newAuthor = $game->getElementsByTagName('author')->item(0);
        $newMagazine = $game->getElementsByTagName('magazine')->item(0);
        // echo $title->textContent . $picture . $author . $magazine;
    }
    $i++;
}

$newTitle->parentNode->replaceChild($doc->createElement("title", $title), $newTitle);
$newPicture->parentNode->replaceChild($doc->createElement("picture", $picture), $newPicture);
$newAuthor->parentNode->replaceChild($doc->createElement("author", $author), $newAuthor);
$newMagazine->parentNode->replaceChild($doc->createElement("magazine", $magazine), $newMagazine);


echo $doc->saveXML();
$doc->save("games.xml");

header("Location: main.php");
exit();
