<?php
require_once 'inc.global.php';

// DATA MANIPULATION:
// NOTES: If the $_POST variable is empty display the form to edit a user
// otherwise save the information in $_POST variable so as to edit the user and return to the user listing

$tpl = new TemplatePower( "./tpl/global.htm" );
$tpl->assignInclude( "body_block", "./tpl/user_edit.htm" );
$tpl->prepare();
$tpl->assign("page_title", "User Edit");

$id = (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) ? $_REQUEST['id']: 0;
$id = (!filter_var($id, FILTER_VALIDATE_INT) === false) ? $id: 0;

if (!empty($_POST)) {
	//sanitize input
	$first_name = isset($_POST['first_name']) ? filter_var($_POST['first_name'], FILTER_SANITIZE_STRING): "";
	$surname = isset($_POST['surname']) ? filter_var($_POST['surname'], FILTER_SANITIZE_STRING): "";
	$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL): "";
	$username = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_STRING): "";
	$password = isset($_POST['password']) ? filter_var($_POST['password'], FILTER_SANITIZE_STRING): "";

	//validate input
	if (!empty($email)) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {		    
		    header("Location: users.php?e=email");
		}		
	}

	if (empty($first_name) || empty($surname) || empty($username) || empty($password)) {
		header("Location: users.php?e=empty");
	}

	updateUser($id, $first_name, $surname, $email, $username, $password);
}


function updateUser($id, $first_name, $surname, $email, $username, $password) {
	global $DB;
	$sql = "UPDATE users SET first_name = '".$first_name."', surname = '".$surname."', username = '".$username."', password = '".$password."' WHERE id = '".$id."'";
	mysql_query($sql, $DB);
	header("Location: users.php");	
}

if ($id > 0) {
	
	$sql = "SELECT * FROM users WHERE id = '".$id."'";

	$qid = mysql_query($sql, $DB);

	while ( ($row = mysql_fetch_array($qid, MYSQL_ASSOC)) !== false )
	{
		$tpl->assign("id", $row['id']);
		$tpl->assign("first_name", $row['first_name']);	
		$tpl->assign("surname", $row['surname']);
		$tpl->assign("email", $row['email']);
		$tpl->assign("username", $row['username']);	
		$tpl->assign("password", $row['password']);	
	}

	$tpl->printToScreen();	
	
} else {
	header("Location: users.php");
}

?>