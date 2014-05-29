<?php
require_once('php/CVreviewTool_functions.php');
require_once('config/app_config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/CVreviewTool.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>	

	<!-- kube stylesheet -->
	<link rel="stylesheet" type="text/css" href="css/kube101/css/kube.css" />
	<!-- local stylesheet -->
	<link rel="stylesheet" href="css/CVreviewTool.css" type="text/css">
</head>

<?php 
if (!empty($_REQUEST['author_id'])) {
	
	//get author_id
	$author_id = $_REQUEST['author_id'];
}
else {
	$author_id = "null";
}
?>

<body>
	<div id="header">
		<div class="container row">
			<div class="half">				
				<a href="." style="text-decoration:none; color:black;"><h3><?php echo $institution_name; ?> - CVreviewTool</h3></a>
			</div>
			<div id="nav" class="half">
				<ul class="inline-list">
					<li><a href=".">home</a></li>
					<li>|</li>
					<li><a href="citations.php?author_id=<?php echo $author_id; ?>">add citations</a></li>
					<li>|</li>
					<li><a href="templates.php?author_id=<?php echo $author_id; ?>">email templates</a></li>
					<li>|</li>
					<li><a href="upload_CV.php?author_id=<?php echo $author_id; ?>">view/upload CV</a></li>
					<li>|</li>
					<li><a href="report.php?author_id=<?php echo $author_id; ?>">view/edit report</a></li>
					</br>
					<li id="current_author">You are working on <strong><?php echo getAuthorName($author_id); ?>'s</strong> report</li>
				</ul>				
			</div>
		</div>		
	</div>
