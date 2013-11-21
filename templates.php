<?php
require_once('db/db.php');
require_once('inc/header.php');
$author_id = $_REQUEST['author_id'];


# faculty email text
function templateRetrieve($CVreviewTool_dbconnect, $template_id){
	$query = "SELECT template_text FROM templates WHERE template_id = '$template_id'";	
	$result = $CVreviewTool_dbconnect->query($query) or die($CVreviewTool_dbconnect->error.__LINE__);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				 $template_text = $row['template_text'];	
			}
		echo $template_text;
	}
	else {
		echo 'Template text not found.';	
	}	 	
}



?>

<div id="page_content">

	<h4>Templates for contacting Faculty or Publishers</h4>
	<p>Click to view...</p>
	<ul id="templates_list">
		<li><a href="#" onclick="$('#faculty_template_text').fadeToggle(); return false;">Email to Faculty accompanying Finished CV Review</a> | <a class="orange" href="#" onclick="editTemplate(<?php echo $author_id; ?>,'faculty_template_text');">(edit)</a>
			<ul id="faculty_template" class="template_text">
				<li id="faculty_template_text" class="template_text_show">
					<!-- Get this from DB -->
					<?php templateRetrieve($CVreviewTool_dbconnect,"faculty_template_text"); ?>
				</li>				
			</ul>				
		</li>
		<li><a href="#" onclick="$('#publisher_template_text').fadeToggle(); return false;">Email to Publisher requesting Permission</a> | <a class="orange" href="#" onclick="editTemplate(<?php echo $author_id; ?>,'publisher_template_text');">(edit)</a>
			<ul id="publisher_template" class="template_text">
				<li id="publisher_template_text" class="template_text_show">
					<!-- Get this from DB -->
					<?php templateRetrieve($CVreviewTool_dbconnect,"publisher_template_text"); ?>
				</li>						
			</ul>				
		</li>		
	</ul>
	
</div>




