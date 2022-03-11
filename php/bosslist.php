<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title> Boss List </title>

</head>

<body>
<h1>Boss List</h1>
<h2>Author: Zirui Qiao</h2>
<form action="searchedBoss.php" method="post">
    Boss Name: <input type="text" name="b_name"/>
    <input type="submit" value= "Search Boss" />
</form>
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
  SELECT * from bosses;
EOF;
$ret = $db->query($sql);
searchBosses($ret);
$db->close();

?>
</body>
</html>


