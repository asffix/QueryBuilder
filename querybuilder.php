<?php
class QueryBuilder {
private $request;
private $type;
private $host;
private $name;
private $login;
private $pass;
private $operation;
public function __construct($arr) {
$this->type=$arr[0];
$this->login=$arr[1];
$this->pass=$arr[2];
$this->host=$arr[3];
$this->name=$arr[4];
if($this->type=="MySQL") {
$link=mysql_connect($this->host, $this->login, $this->pass) or die("Подключение невозможно! ".mysql_error());
mysql_select_db($this->name) or die("База данных ".$this->name." не существует!");
}
}
function insert($table, $names) {
$this->operation="insert";
$this->request.="INSERT INTO ".$table." (";
for($i=0; $i<count($names); $i++) {
if($i==count($names)-1) {
$this->request.=$names[$i];
break;
}
$this->request.=$names[$i].", ";
}
$this->request.=") ";
return $this;
}
function values($v) {
$this->request.="values(";
for($i=0; $i<count($v); $i++) {
if($i==count($v)-1) {
$this->request.="'".$v[$i]."'";
break;
}
$this->request.="'".$v[$i]."', ";
}
$this->request.=")";
return $this;
}
function get_request() {
return $this->request;
}
function select($names) {
$this->operation="select";
$this->request.="SELECT ";
for($i=0; $i<count($names); $i++) {
if($i==count($names)-1) {
$this->request.=$names[$i];
break;
}
$this->request.=$names[$i].", ";
}
$this->request.=" ";
return $this;
}
function from($table) {
$this->request.="FROM ".$table." ";
return $this;
}
function where($params) {
$this->request.=" WHERE ".$params." ";
return $this;
}
function limit($count, $count2=0) {
$this->request.=" LIMIT ".$count;
if($count2>0)
$this->request.=",".$count2." ";
else
$this->request.=" ";
return $this;
}
function update($table, $names, $values) {
$this->request.="UPDATE ".$table." SET ";
for($i=0; $i<count($names); $i++) {
if($i==count($names)-1) {
$this->request.=$names[$i]." = '".$values[$i]."' ";
break;
}
$this->request.=$names[$i]." = '".$values[$i]."', ";
}
return $this;
}
function delete() {
$this->request.="DELETE ";
return $this;
}
function order($sort, $desc=false) {
$this->request.=" ORDER BY ".$sort." ";
if($desc==true)
$this->request.="DESC ";
return $this;
}
function execute() {
if($this->type=="MySQL") {
if($this->request!="") {
$result=mysql_query($this->request) or die("Ошибка запроса! ".mysql_error());
$this->request="";
if($this->operation=="select") {
$stack=array();
while($result_assoc=mysql_fetch_array($result, MYSQL_ASSOC)) {
array_push($stack, $result_assoc);
}
return $stack;
}
}
}
}
}
?>
