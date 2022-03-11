<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title> Domain List </title>

</head>

<body>
<h1>Domain List</h1>
<h2>Author: Zirui Qiao</h2>
<form action="searchedDomain.php" method="post">
    Domain Name: <input type="text" name="D_name"/>
    <input type="submit" value= "Search Domain" />
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
  SELECT * from domains;
EOF;
$ret = $db->query($sql);
searchDomains($ret, false);
$db->close();

?>
</body>
</html>


