<?php
ini_set('display_errors', 0);

require_once(__DIR__ . "/getID3-master/getid3/getid3.php");
const CSS_URL = "css/style.min.css";

$getID3 = new getID3;
$getID3->encoding = "UTF-8";

$fileName = "";
$nowPlaying = "";

$arratWithSongsInfo = [];
$ThisFileInfo = [];
$arrayForCheck = [];
$countedFiles = 1;

if ($handle = opendir('music/')) {
    while (false !== ($fileName = readdir($handle))) {
        if ($fileName != "." && $fileName != "..") {
            $ThisFileInfo = $getID3->analyze("music/" . $fileName);
            array_push($arratWithSongsInfo, $ThisFileInfo);
            $countedFiles++;
        }
    }
    array_unshift($arratWithSongsInfo, 0);
    closedir($handle);
}

for ($i = 0; $i < $countedFiles; $i++) {
    array_push($arrayForCheck, $i);
}

$i = 1;
while ($i < $countedFiles) {
    if ($_POST["id"] == $arrayForCheck[$i]) {
        $nowPlaying = $arratWithSongsInfo[$i]["filename"];
        break;
    }
    $i++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs</title>
    <link rel="stylesheet" href="<?= CSS_URL ?>">
    <link rel="stylesheet" href="plyr-master/dist/plyr.css">
    <link rel="icon" href="img\svg\headphones-ico.svg" type="image/svg+xml">
</head>

<body>
    <div class="now_play">
        Now playing:
        <?= $nowPlaying ?>
    </div>
    <audio controls autoplay id="player" src="music\<?= $nowPlaying ?>"></audio>
    <table class="music_table">
        <tr class="music_head">
            <td class="music_center">play</td>
            <td>name</td>
            <td class="music_center">duration</td>
        </tr>
        <?php for ($i = 1; $i < $countedFiles; $i++): ?>
            <tr>
                <td class="music_center">
                    <form action="index.php" method="post">
                        <input name="id" type="submit" value="<?= $i ?>">
                    </form>
                </td>
                <td>
                    <?= $arratWithSongsInfo[$i]["filename"]; ?>
                </td>
                <td class="music_center">
                    <?= $arratWithSongsInfo[$i]["playtime_string"]; ?>
                </td>
            </tr>
        <?php endfor; ?>
    </table>
    <script src="plyr-master/dist/plyr.min.js"></script>
    <script>
        const player = new Plyr("#player");
        var endSong = document.getElementById("player");
        endSong.onended = function() {
            alert("Песня закончилась");
        };
    </script>
</body>

</html>