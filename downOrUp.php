<?php
$itemValue = intval($_POST["whichValue"]);
$minusOrplus = intval($_POST["minusOrplus"]);

$upOrDown = $itemValue + $minusOrplus;


$doc = new DOMDocument();
$doc->load('games.xml');

$games = $doc->getElementsByTagName('game');
$i = 0;
foreach ($games as $game) {

    if ($i == $upOrDown) {
        $oldTitle = $game->getElementsByTagName('title')->item(0);
        $oldPicture = $game->getElementsByTagName('picture')->item(0);
        $oldAuthor = $game->getElementsByTagName('author')->item(0);
        $oldMagazine = $game->getElementsByTagName('magazine')->item(0);

        $tekscik = $oldTitle->textContent;
        $obrazek = $oldPicture->textContent;
        $tworca = $oldAuthor->textContent;
        $czasopismo = $oldMagazine->textContent;
        // echo $title->textContent . $picture . $author . $magazine;
    }

    if ($i == $itemValue) {
        $newTitle = $game->getElementsByTagName('title')->item(0);
        $newPicture = $game->getElementsByTagName('picture')->item(0);
        $newAuthor = $game->getElementsByTagName('author')->item(0);
        $newMagazine = $game->getElementsByTagName('magazine')->item(0);
        // echo $title->textContent . $picture . $author . $magazine;
    }
    $i++;
}

$oldTitle->parentNode->replaceChild($doc->createElement("title", $newTitle->textContent), $oldTitle);
$oldPicture->parentNode->replaceChild($doc->createElement("picture", $newPicture->textContent), $oldPicture);
$oldAuthor->parentNode->replaceChild($doc->createElement("author", $newAuthor->textContent), $oldAuthor);
$oldMagazine->parentNode->replaceChild($doc->createElement("magazine", $newMagazine->textContent), $oldMagazine);

$newTitle->parentNode->replaceChild($doc->createElement("title", $tekscik), $newTitle);
$newPicture->parentNode->replaceChild($doc->createElement("picture", $obrazek), $newPicture);
$newAuthor->parentNode->replaceChild($doc->createElement("author", $tworca), $newAuthor);
$newMagazine->parentNode->replaceChild($doc->createElement("magazine", $czasopismo), $newMagazine);



echo $doc->saveXML();
$doc->save("games.xml");

header("Location: main.php");
exit();
