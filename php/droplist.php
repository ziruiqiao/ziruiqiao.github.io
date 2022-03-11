<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title> Drop List </title>

</head>

<body>s
<h1>Drop List</h1>
<h2>Author: Zirui Qiao</h2>
<form action="searchedDrop.php" method="post">
    Drop Name: <input type="text" name="d_name"/>
    <input type="submit" value = "Search Drop" />
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
  SELECT * from drops;
EOF;
$ret = $db->query($sql);
searchDrops($ret);
$db->close();

?>
</body>
</html>


