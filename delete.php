<?php
require_once"config.php";
require_once"querybuilder.php";
$db=new QueryBuilder($db_config);
$id=$_GET['id'];
$db->delete()->from("users")->where("id=".$id);
$db->execute();
header("Location: user_list.php");
?>
