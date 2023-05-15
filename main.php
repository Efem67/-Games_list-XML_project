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
  <a href="https://drive.google.com/drive/folders/1-H9PGo4nQO-r1acoaA7BSf5gCGE4D5rS?usp=sharing">Link do pobrania</a>
  <div style="display:flex; align-items: center; justify-content: center; height:100px">
    <a href="main.php" style="background-color: lightgray; padding: 10px; margin-right: 10px;">Pozycje</a>
    <a href="main1.php" style=" padding: 10px;">Podgląd</a>
    <a href="exportExcel.php" style=" padding: 10px;">Exportuj dane do pliku Xlsx</a>
  </div>
  <table>
    <tr>
      <th></th>
      <th>Nazwa gry</th>
      <th>Miniaturka</th>
      <th>Autor</th>
      <th>Czasopismo</th>
      <th></th>
      <th></th>
    </tr>
    <?php
    $games = $doc->getElementsByTagName('game');
    $i = 0;
    foreach ($games as $game) {

      $title = $game->getElementsByTagName('title')->item(0)->textContent;
      $picture = $game->getElementsByTagName('picture')->item(0)->textContent;
      $author = $game->getElementsByTagName('author')->item(0)->textContent;
      $magazine = $game->getElementsByTagName('magazine')->item(0)->textContent;

      if ($forEdit == $i) {
        echo "
        <tr>
          <td>
          </td>
          <form action='save.php' method='post'>
            <td>
              <input type='text' name='title' value='{$title}'>
            </td>
            <td>
              <input type='text' name='picture' value='{$picture}'>
            </td>
            <td>
              <input type='text' name='author' value='{$author}'>
            </td>
            <td>
              <input type='text' name='magazine' value='{$magazine}'>
            </td>
            <td colspan='3'>
                <input type='hidden' name='whichValue' value={$i}>
                <input type='submit' value='Zapisz' style='width: 100%;'>
            </td>
          </form>


        </tr>
      ";
      } else {

        echo "
          <tr>
            <td>
              <form action='main.php' method='post'>
                <input type='hidden' name='forEdit' value={$i}>
                <input type='submit' value='E'>
              </form>
            </td>
            <td>{$title}</td>
            <td>{$picture}</td>
            <td>{$author}</td>
            <td>{$magazine}</td>
            <td>
              <form action='delete.php' method='post'>
                <input type='hidden' name='whichValue' value={$i}>
                <input type='submit' value='Delete'>
              </form>
            </td>
            <td>" .
          ($i != 0 ?
            "<form action='downOrUp.php' method='post'>
                  <input type='hidden' name='minusOrplus' value=-1>
                  <input type='hidden' name='whichValue' value={$i}>
                  <input type='submit' value='Up'>
                  </form>"
            : "") . "

            </td>
            <td>
            " .
          ($i + 1 != count($games) ?
            "<form action='downOrUp.php' method='post'>
                  <input type='hidden' name='minusOrplus' value=1>
                  <input type='hidden' name='whichValue' value={$i}>
                  <input type='submit' value='Down'>
                </form>"
            : "") . "

            </td>
          </tr>
        ";
      }
      $i++;
    }

    ?>

    <tr>
      <td>
      </td>
      <form action='create.php' method='post'>
        <td>
          <input type='text' name='title' value=''>
        </td>
        <td>
          <input type='text' name='picture' value=''>
        </td>
        <td>
          <input type='text' name='author' value=''>
        </td>
        <td>
          <input type='text' name='magazine' value=''>
        </td>
        <td colspan='3'>
          <input type='submit' value='Dodaj' style='width: 100%;'>
        </td>
      </form>
    </tr>
  </table>




</body>

</html>