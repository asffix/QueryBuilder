<?php
require_once"config.php";
require_once"querybuilder.php";
$db=new QueryBuilder($db_config);
$db->select("*")->from("users");
$result=$db->execute();
?>
<html>
<head>
<title>������ �������������</title>
</head>
<body>
<?php
include("menu.php");
?>
<h3>������ �������������</h3>
<table>
<tr><td>ID</td><td>�����</td><td>������</td><td>E-mail</td><td>Update</td><td>Delete</td></tr>
<?php
for($i=0; $i<count($result); $i++) {
?>
<tr>
<td>
<?php
echo($result[$i]["id"]);
?>
</td>
<td>
<?php
echo($result[$i]["login"]);
?>
</td>
<td>
<?php
echo($result[$i]["pass"]);
?>
</td>
<td>
<?php
echo($result[$i]["email"]);
?>
</td>
<td>
<a href="update.php?id=
<?php
echo($result[$i]["id"]);
?>
">�������������</a>
</td>
<td>
<a href="delete.php?id=
<?php
echo($result[$i]["id"]);
?>
">�������</a>
</td>
</tr>
<?php
}
?>
</table>
</body>
</html>
