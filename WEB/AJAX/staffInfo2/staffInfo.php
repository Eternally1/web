<?php
//设置页面内容是html，编码格式是utf-8
// header("Content-type:text/plain;charset=utf-8");
//告诉服务器，传送的是JSON字符串
header("Content-type:text/json;charset=utf-8");
//header("Content-type:text/xml;charset=utf-8");
//header("Content-type:text/html;charset=utf-8");
//header("Content-type:text/javascript;charset=utf-8");
//定义一个多维数组，包括员工信息，每条员工信息为一个数组。
$staff = array
(
	array("name"=>"洪七","number"=>"101","sex"=>"男","job"=>"总经理"),
	array("name"=>"郭靖","number"=>"102","sex"=>"男","job"=>"产品开发师"),
	array("name"=>"黄蓉","number"=>"103","sex"=>"女","job"=>"产品经理"),
);

//判断如果是get请求，则进行搜索员工；如果是POST请求，则进行新建员工
//$_SERVER是一个超全局变量，在一个脚本的全部作用域中都可用，不用使用global关键字
//$_SERVER["REQUEST_METHOD"]返回访问页面使用的请求方法
if($_SERVER["REQUEST_METHOD"] == "GET"){
	search();
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
	create();
}

//通过员工编号搜索员工
function search(){
	//检查是否有员工编号参数
	//isset检测变量是否设置；empty判断值是否为空
	//超全局变量$_GET和$_POST用于手机表单数据
	if(!isset($_GET["number"]) || empty($_GET["number"])){
		echo '{"success":false,"msg":"参数错误"}';
		return;
	}
	//函数之外声明的变量拥有Global作用域，只能在函数以外进行访问。
	//global关键词用于访问函数内的全局变量
	global $staff;
	//获取number参数
	$number = $_GET["number"];
	$result ='{"success":false,"msg":"没有找到员工"}';

	//遍历$staff数组，查找key值为number的员工是否存在，如果存在，则修改返回结果
	foreach($staff as $value){
		if($value["number"] == $number){
			$result = '{"success":true,"msg":"找到员工：员工编号：,'.$value["number"].
					',员工姓名:'.$value["name"].
					',员工性别:'.$value["sex"].
					',员工职位'.$value["job"].'"}';
			break;
		}
	}
	echo $result;
}

//创建员工
function create(){
	//判断信息是否填写完全
	if(!isset($_POST["name"]) || empty($_POST["name"])
		||!isset($_POST["number"]) || empty($_POST["number"])
		||!isset($_POST["sex"]) || empty($_POST["sex"])
		||!isset($_POST["job"]) || empty($_POST["job"])){
		echo '{"success":false,"msg":"参数错误,员工信息不全"}';
		return;
	}
	//TODO:获取POST表单数据并保存到数据库

	//提示保存成功
	echo '{"success":true,"msg":"员工:'.$_POST["name"].'信息保存成功"}';
}

?>