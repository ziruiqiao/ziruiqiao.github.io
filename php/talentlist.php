<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title> Talent Level UP MaterialList </title>

</head>

<body>
<h1>Talent Level UP Material List</h1>
<h2>Author: Zirui Qiao</h2>
<form action="searchedTalent.php" method="post">
    Talent Level Up Material Name: <input type="text" name="t_name"/>
    <input type = "submit" value = "Search Material" />
</form>s
<?php
require './formulaBase.php';
class SQLiteDB extends SQLite3
{
    function __construct()
    {
        $this->open('../Genshin.db');
    }
}
$db = new SQLiteDB();
$sql =<<<EOF
  SELECT * from talent_levelup_material;
EOF;
$ret = $db->query($sql);
searchTalents($ret, true);
$db->close();

?>
</body>
</html>


