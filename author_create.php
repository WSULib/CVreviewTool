<?php

require_once('db/db.php');
require_once('inc/header.php');


if ( isset($_REQUEST['submitted']) ) {
	// concat fname,mname,lname for author_name
	$author_name = "{$_REQUEST['author_fname']} {$_REQUEST['author_mname']} {$_REQUEST['author_lname']}";		
	$query = "INSERT INTO person SET 
		name = '{$author_name}',
		fname = '{$_REQUEST['author_fname']}',
		mname = '{$_REQUEST['author_mname']}',
		lname = '{$_REQUEST['author_lname']}',
		department = '{$_REQUEST['author_dept']}',
		school = '{$_REQUEST['author_college']}'
		";	
	// Insert form data
	if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }
	?>
	<div id="page_content">	
		<p style='color:green;'>Author <?php echo $author_name; ?> successfully created.</p>
		<a href='index.php'>Return to Author selection screen...</a>
	</div>
	<?php
}

else {

?>
<div id="page_content">

	<p>Create a new author / project:</p>
	<form id="author_create" class="forms forms-columnar"name="author_create" action="author_create.php" method="POST">
		
		<label>First Name</label>
		<input id="author_fname" class="width-33" name="author_fname" type="text">					
		<label>Middle Name</label>
		<input id="author_mname" class="width-33" name="author_mname" type="text">
		<label>Last Name</label>
		<input id="author_lname" class="width-33" name="author_lname" type="text">		
		<label>Department</label>
		<input id="author_dept" class="width-33" name="author_dept" type="text">
		<label>School / College</label>
		<input id="author_college" class="width-33" name="author_college" type="text">		
		<input type="hidden" name="submitted" value="true"/>
		</br></br></br>
		<input type="submit" value="create" />		
	</form>
</div>

<?php
} //closes else
// require_once('footer.php');
?>