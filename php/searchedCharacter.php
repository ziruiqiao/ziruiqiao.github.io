<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Searched Character</title>

</head>
<body>
<h1>Searched Character</h1>
<h2>Author: Zirui Qiao</h2>
<?php
require './formulaBase.php';
$cName = $_POST["c_name"];
$cImg = "";
$cStar = "";
$ct_id = "";
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$sql = "SELECT * FROM characters where c_name = \"{$cName}\";";
$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    $cImg = $row['cImage'];
    $cStar = $row['star_rating'];
    $t_name = $row['t_name'];
    echo "<img src=".$cImg." width=200 height=200/>";
    echo "<h4>".$cName."</h4>";
    echo "<p>".$cStar." Star</p><ul>";
}
$character_talent = "SELECT * from talent_levelup_material where t_name = \"{$t_name}\"";
$character_drop = "SELECT * from character_need_drops, drops where (c_name = 
        \"{$cName}\" AND character_need_drops.d_name = drops.d_name);";
$ret1 = $db->query($character_talent);
$ret2 = $db->query($character_drop);
searchTalents($ret1, true);
echo "<li><h3>Need: </h3></li><ul>";
searchDrops($ret2);
echo "</ul>";
$db->close();
    ?>
</body>
</html>

