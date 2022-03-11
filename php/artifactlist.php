<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title> Artifact List </title>

</head>

<body>
<h1>Artifact List</h1>
<h2>Author: Zirui Qiao</h2>
<form action="searchedArtifact.php" method="post">
    Artifact Set Name: <input type="text" name="set"/>
    Artifact Star: <input type="text" name="star"/>
    <input type="submit" value= "Search Artifact" />
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
  SELECT * from artifacts;
EOF;
$ret = $db->query($sql);
searchArtifacts($ret);
$db->close();

?>
</body>
</html>


