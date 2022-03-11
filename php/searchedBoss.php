<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Searched Domain</title>

</head>
<body>
<h1>Searched Domain</h1>
<h2>Author: Zirui Qiao</h2>
<?php
require './formulaBase.php';
$name = $_POST["b_name"];
$img = "";
$country = "";
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$boss_drop = "SELECT * from bosses_drops, drops where 
            (b_name = \"{$name}\" and bosses_drops.d_name = drops.d_name);";
$boss_artifact = "SELECT * from bosses_artifacts, artifacts where 
            (b_name = \"{$name}\" and bosses_artifacts.a_id = artifacts.a_id);";
$sql = "SELECT * FROM bosses where b_name = \"{$name}\";";
$ret = $db->query($sql);
$ret1 = $db->query($boss_drop);
$ret2 = $db->query($boss_artifact);
while ($row = $ret->fetchArray()) {
    $img = $row['bImage'];
    $country = $row['country'];
}
echo "<img src=".$img." width=200 height=200/>";
echo "<h4>".$name."</h4>";
echo "<p>In country: ".$country."</p>";
echo "<h3>Drops: </h3><ul>";
searchDrops($ret1);
searchArtifacts($ret2);
echo "</ul>";
$db->close();
?>
</body>
</html>

