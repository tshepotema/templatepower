<?php
require_once 'inc.global.php';

// DATA RETRIEVAL:
// NOTES: Refer to the provided TemplatePower manual for help

// 1: Create the TemplatePower object using tpl/global.htm. Name the variable $tpl
$tpl = new TemplatePower( "./tpl/global.htm" );

// 2: Assign tpl/users.htm to the BODY include block in tpl/global.htm
$tpl->assignInclude( "body_block", "./tpl/users.htm" );

// 3: Prepare the template
$tpl->prepare();

// 4: Assign the word 'Users' as the page title
$tpl->assign("page_title", "Users");


// 5: Write the SQL query to retrieve all users from the database and order the results by first name
$sql = 'SELECT * FROM users';

// This will run your query
$qid = mysql_query($sql, $DB);

// This will fetch the rows
while ( ($row = mysql_fetch_array($qid, MYSQL_ASSOC)) !== false )
{

	// 6: Create a new block to assign the user information to
      $tpl->newBlock("user");

	// 7: Assign all necessary information to the template here. Refer to the template for variable names
      $tpl->assign("id", $row['id']);
      $tpl->assign("first_name", $row['first_name']);	
      $tpl->assign("surname", $row['surname']);
      $tpl->assign("email", $row['email']);
      $tpl->assign("username", $row['username']);	
}

// 8: Display the template
$tpl->printToScreen();
?>