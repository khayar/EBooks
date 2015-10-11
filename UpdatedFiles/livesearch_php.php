<?php 
 	session_start();//start the session
// Include database connection
  require_once('global-connect.inc.php');

	$SQL_FROM = 'booklist';
	$SQL_WHERE = 'Title';

	$searchq =	strip_tags($_GET['q']);
	$sql	=	"SELECT * FROM ".$SQL_FROM." WHERE ".$SQL_WHERE." LIKE '".$searchq."%'";
	//print_r("Query".$sql);
	$stmt = OCIParse($db, $sql); 
  
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	  }
	OCIExecute($stmt); 

	$output[] = '<ul>';

	while(OCIFetch($stmt)) {

		$title= OCIResult($stmt,"TITLE");
		$output[] = '<li><small>'.$title.'</small></li>';
	}
	$output[] = '</ul>';
	echo join('',$output);		
	
?>



