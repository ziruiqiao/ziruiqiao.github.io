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
$domain = $_POST["D_name"];
$type = "";
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$domain_talent = "SELECT * from talent_levelup_material_domain where 
        (domain = \"{$domain}\") ORDER BY t_name ASC;";
$domain_artifact = "SELECT * from domains_artifacts, artifacts where (domains_artifacts.domain = 
        \"{$domain}\" AND artifacts.a_id = domains_artifacts.a_id)
        ORDER BY artifacts.set_name ASC;";
$domain_drop = "SELECT * FROM domains_drops, drops where (domain = \"{$domain}\" AND 
            domains_drops.d_name = drops.d_name);";
$sql = "SELECT * from domains, countries where 
            (domains.domain = \"{$domain}\" and country = country_id);";
$ret = $db->query($sql);
$ret1 = $db->query($domain_talent);
$ret2 = $db->query($domain_artifact);
$ret3 = $db->query($domain_drop);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $type = $row['d_type'];
    echo "<p></p><h2>".$domain."</h2><p></p>";
    echo "<h3>In country: </h3>";
    echo "<p>".$row['country_name']."</p>";
}
echo "<h3>Drops: </h3><ul>";
if($type == "talent") {
    echo "<li>";
    searchTalents($ret1, false);
} else {
    echo "<li>";
    searchArtifacts($ret2);
}
echo "</li>";
if($type == "boss") {
    echo "<li>";
    searchDrops($ret3);
    echo "</li>";
}
echo "</ul>";
$db->close();
?>
</body>
</html>

