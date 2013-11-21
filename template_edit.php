<?php
require_once('db/db.php');
require_once('inc/header.php');


$template_edit = $_POST['template_edit'];
$template_id = $_POST['template_id'];
$author_id = $_POST['author_id'];

// echo $template_edit;
// echo $template_id;
// echo $author_id;

//db insert
$query = "UPDATE templates SET template_text = '$template_edit' WHERE template_id = '$template_id'";

if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }

else {
	?>
	<div id="page_content">
		<?php
			echo "Template changed.</br></br>";
			echo "<a href='templates.php?author_id=$author_id'>Back to Templates</a></br>";
	?></div><?php

}

//footer
require_once('footer.php');
?>