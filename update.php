<?php
require_once"config.php";
require_once"querybuilder.php";
$db=new QueryBuilder($db_config);
if($_GET['page']=="up") {
$id=$_GET['id'];
$login=$_POST['login'];
$pass=$_POST['pass'];
$email=$_POST['email'];
if($login!="" && $pass!="" && $email!="") {
$db->update("users", array("login", "pass", "email"), array($login, $pass, $email))->where("id=".$id);
$db->execute();
header("Location: user_list.php");
}
}
$id=$_GET['id'];
$db->select("*")->from("users")->where("id=".$id);
$result=$db->execute();
?>
<html>
<head>
<title>�������������� ������������ 
<?php
echo($result[0]["login"]);
?>
</title>
</head>
<body>
<?php
include("menu.php");
?>
<h3>�������������� ������������</h3>
ID: <?php
echo($result[0]["id"]);
?>
<br>
<form action="update.php?page=up&id=
<?php
echo($result[0]["id"]);
?>
" method="post">
�����: <br>
<input type="text" name="login" value="
<?php
echo($result[0]["login"]);
?>
"><br>
������: <br>
<input type="text" name="pass" value="
<?php
echo($result[0]["pass"]);
?>
"><br>
Email: <br>
<input type="text" name="email" value="
<?php
echo($result[0]["email"]);
?>
"><br>
<input type="submit" value="OK">
</form>
</body>
</html>
