<?php
include_once("config.php");

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

// function committEdit($cite_num,$cite_text) {
// 	global $CVreviewTool_dbconnect;
// 	//db insert
// 	$query = "INSERT INTO citations WHERE id = SET 
// 		person_id = '{$clean['author_id']}', 
// 		citation = '$citation_text',
// 		jtitle = '{$clean['jtitle']}',
// 		issn = '$issn',
// 		conditions = '{$clean['conditions']}',
// 		report_choice = '{$perm_type}',
// 		preprint = '{$clean['preprint']}',
// 		postprint = '{$clean['postprint']}',
// 		preprint_restrictions = '{$clean['pre_restrictions']}',
// 		postprint_restrictions = '{$clean['post_restrictions']}'
// 		";

// 	if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }
// }

?>

