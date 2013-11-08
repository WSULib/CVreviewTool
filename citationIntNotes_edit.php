<?php
require_once('db/db.php');
require_once('inc/header.php');


$citationIntNotes_edit = $_POST['citationIntNotes_edit'];
$cite_num = $_POST['cite_num'];
$author_id = $_POST['author_id'];

//db insert
$query = "UPDATE citations SET internalNotes = '$citationIntNotes_edit' WHERE id = '$cite_num'";

if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }

else {
	?>
	<div id="page_content">
		<?php
			echo "Citation notes changed.</br></br>";
			echo "<a href='report.php?author_id=$author_id'>Back to Report</a></br>";
	?></div><?php

}

//footer
require_once('footer.php');
?>