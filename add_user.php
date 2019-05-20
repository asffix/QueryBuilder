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
echo("Пользователь добавлен!");
}
?>
<html>
<head>
<title>Добавление пользователя</title>
</head>
<body>
<?php
include("menu.php");
?>
<h3>Добавление пользователя</h3>
<form action="add_user.php?page=new" method="post">
Логин: <br>
<input type="text" name="login">
Пароль: <br>
<input type="text" name="pass">
E-mail: <br>
<input type="text" name="email">
<input type="submit" value="Добавить">
</form>
</body>
</html>
