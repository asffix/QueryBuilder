<?php
require_once"config.php";
require_once"querybuilder.php";
if($_GET['page']=="new") {
$login=$_POST["login"];
$pass=$_POST["pass"];
$email=$_POST["email"];
$db=new QueryBuilder($db_config);
$db->insert("users", array("login", "pass", "email"))->values(array($login, $pass, $email));
$result=$db->execute();
if($result==1)
echo("������������ ��������!");
}
?>
<html>
<head>
<title>���������� ������������</title>
</head>
<body>
<?php
include("menu.php");
?>
<h3>���������� ������������</h3>
<form action="add_user.php?page=new" method="post">
�����: <br>
<input type="text" name="login">
������: <br>
<input type="text" name="pass">
E-mail: <br>
<input type="text" name="email">
<input type="submit" value="��������">
</form>
</body>
</html>
