<?php
$itemValue = intval($_POST["whichValue"]);

$doc = new DOMDocument();
$doc->load('games.xml');

$co = $doc->getElementsByTagName("game")->item($itemValue);
$skad = $doc->getElementsByTagName("root")->item(0);
$skad->removeChild($co);

echo $doc->saveXML();
$doc->save("games.xml");

header("Location: main.php");
exit();
