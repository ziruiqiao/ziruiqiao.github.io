<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Searched Artifact</title>

</head>
<body>
<h1>Searched Artifact</h1>
<h2>Author: Zirui Qiao</h2>
<?php
require './formulaBase.php';
$set = $_POST["set"];
$star = $_POST["star"];
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$sql = "SELECT * from artifacts where 
            (set_name = \"{$set}\" and star_rating = \"{$star}\");";
$artifact_boss = "SELECT distinct bosses.b_name, bImage, country from bosses_artifacts, artifacts, bosses 
            where (set_name = \"{$set}\" AND star_rating = \"{$star}\" AND artifacts.a_id = bosses_artifacts.a_id
            AND bosses_artifacts.b_name = bosses.b_name) ORDER BY bosses.b_name ASC;";
$artifact_domain = "SELECT distinct domains.domain, d_type, country from domains_artifacts, artifacts, domains 
            where (set_name = \"{$set}\" AND star_rating = \"{$star}\" AND artifacts.a_id = domains_artifacts.a_id
            AND domains_artifacts.domain = domains.domain) ORDER BY domains.domain ASC;";
$ret1 = $db->query($artifact_boss);
$ret2 = $db->query($artifact_domain);
$ret = $db->query($sql);
$num = 0;
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    if ($num == 0) {
        echo "<p></p><h2>".$set."</h2><p></p>";
    }
    $part = $row['part'];
    $img = $row['aImage'];
    echo "<div class='box".$num."'><img src=".$img ." width=70 height=70/></div>>";
    echo "<style type='text/css'>
        .box".$num." {
                width: 70px;
                background-color: ".getColor($star).";
            } 
        </style>";
    echo $part;
    $num += 1;
}
echo "<h3>Can be Obtained from: </h3><ul>";
    if ($star == 1) {
        echo "<p>initial artifact, can be gained nowhere</p>";
    } else {
        searchBosses($ret1);
        searchDomains($ret2, false);
    }
    echo "</ul>";
$db->close();
?>
</body>
</html>


