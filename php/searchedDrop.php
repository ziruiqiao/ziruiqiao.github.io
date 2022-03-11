<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Searched Drop</title>

</head>
<body>
<h1>Searched Drop</h1>
<h2>Author: Zirui Qiao</h2>
<?php
require './formulaBase.php';
$Name = $_POST["d_name"];
$Img = "";
$Star = "";
$Type = "";
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$drop_domain = "SELECT * from domains_drops, domains where (d_name = \"{$Name}\" 
        AND domains_drops.domain = domains.domain);";
$drop_boss = "SELECT * from bosses_drops, bosses where (d_name = \"{$Name}\"
        AND bosses_drops.b_name = bosses.b_name);";
$drop_character = "SELECT * from character_need_drops, characters where (d_name = 
        \"{$Name}\" AND character_need_drops.c_name = characters.c_name);";
$sql = "SELECT * FROM drops where d_name = \"{$Name}\";";
$ret = $db->query($sql);
$ret1 = $db->query($drop_domain);
$ret2 = $db->query($drop_boss);
$ret3 = $db->query($drop_character);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $Img = $row['dImage'];
    $Star = $row['star_rating'];
    $Type = $row['type'];
    echo "<img src=".$Img." width=200 height=200/>";
    echo "<h4>".$Name."</h4>";
    echo "<p>".$Star." Star</p>";
}
echo "<h3>Can be Obtained from: </h3><ul>";
if ($Type == "on map") {
    echo "<li><h4>On Map</h4></li>";
} else if ($Type == "monster drop") {
    echo "<li><h4>Common Monster Drop</h4></li>";
}
if ($Type != "on map" && $Type != "monster drop") {
    $ret = $db->query($drop_domain);
    if ($Type != "domain") {
        echo "<li>";
        searchBosses($ret2);
    } else {
        echo "<li>";
        searchDomains($ret1, false);
    }
    echo "</li>";
    if ($Type == "common") {
        echo "<li>";
        searchDomains($ret1, false);
        echo "</li>";
    }
}
echo "</ul><h3>Needed by Characters: </h3>";
searchCharacters($ret3);
$db->close();
?>
</body>
</html>