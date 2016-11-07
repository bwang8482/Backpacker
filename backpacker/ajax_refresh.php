<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=engr-cpanel-mysql.engr.illinois.edu;dbname=backpack_user', 'backpack_zbc', '123456', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
 
$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$search_type = $_POST['search_type'];

if($search_type=='writer_username')
	$sql = "SELECT * FROM post WHERE writer_username LIKE (:keyword) ORDER BY date DESC LIMIT 0, 10";
else if($search_type=='post_title')
	$sql = "SELECT * FROM post WHERE title LIKE (:keyword) ORDER BY date DESC LIMIT 0, 10";
else if($search_type=='location')
	$sql = "SELECT * FROM post WHERE location LIKE (:keyword) ORDER BY date DESC LIMIT 0, 10";

$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$post_time = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['date']);

	if($search_type=='writer_username')
		$post_title = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['writer_username']);
	else if($search_type=='post_title')
		$post_title = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['title']);
	else if($search_type=='location')
		$post_title = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['location']);
	// add new option
	if($search_type=='writer_username')
    	echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['writer_username']).'\')">'.$post_title.'		'.'<i>'.$post_time.'</i>'.'</li>';
    else if($search_type=='post_title')
    	echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['title']).'\')">'.$post_title.'	 	 '.'<i>'.$post_time.'</i>'.'</li>';	
    else if($search_type=='location')
       	echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['location']).'\')">'.$post_title.'		'.'<i>'.$post_time.'</i>'.'</li>';

}
?>