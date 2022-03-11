<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title> Character List </title>

</head>

<body>
<h1>Character List</h1>
<h2>Author: Zirui Qiao</h2>
<form action="searchedCharacter.php" method="post">
    Character Name: <input type="text" name="c_name"/>
    <input type="submit" value = "Search Character" />
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
  SELECT * from characters;
EOF;
$ret = $db->query($sql);
searchCharacters($ret);
$db->close();

?>
</body>
</html>

