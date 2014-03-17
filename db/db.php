<?php
include('config/db_config.php');

$CVreviewTool_dbconnect = new mysqli("$hostname", "$username", "$password", "$database");

if ($CVreviewTool_dbconnect->connect_errno) {
    echo "Failed to connect to MySQL: " . $CVreviewTool_dbconnect->connect_error;
}

// get author name from person_id 
function getAuthorName($author_id) {
	global $CVreviewTool_dbconnect;
	$query = "SELECT name FROM person WHERE id = '$author_id'";
	$result = $CVreviewTool_dbconnect->query($query) or die($CVreviewTool_dbconnect->error.__LINE__);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				 $author_name = $row['name'];
				 return $author_name;
			}

		}
		else {
			echo '[PERSON NOT FOUND]';	
		}
}

?>

