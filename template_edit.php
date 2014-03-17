<?php
require_once('db/db.php');
require_once('inc/header.php');


$template_edit = $_POST['template_edit'];
$template_id = $_POST['template_id'];
$author_id = $_POST['author_id'];

//db insert
$query = "INSERT INTO templates (template_id, template_text) VALUES ('$template_id','$template_edit') ON DUPLICATE KEY UPDATE template_text = VALUES(template_text)";

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
require_once('inc/footer.php');
?>