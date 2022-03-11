<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Searched Talent Material</title>

</head>
<body>
<h1>Searched Talent Material</h1>
<h2>Author: Zirui Qiao</h2>
<?php
require './formulaBase.php';
$tName = $_POST["t_name"];
$tImg = "";
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$talent_character = "SELECT * from characters where t_name = \"{$tName}\";";
$talent_domain = "SELECT * from talent_levelup_material_domain, domains where (
            t_name = \"{$tName}\" AND talent_levelup_material_domain.domain = domains.domain);";
$sql = "SELECT * FROM talent_levelup_material WHERE t_name = \"{$tName}\";";
$ret = $db->query($sql);
$ret1 = $db->query($talent_domain);
$ret2 = $db->query($talent_character);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $tImg = $row['tImage'];
    echo "<img src=".$tImg." width=200 height=200/>";
    echo "<h4>".$tName."</h4>";
}

echo "<ul>";
echo "<li><h3>Drop in: </h3></li>";
searchDomains($ret1, true);
echo "<li><h3>Use by: </h3></li>";
searchCharacters($ret2);
echo "</ul>";
$db->close();
?>
</body>
</html>
