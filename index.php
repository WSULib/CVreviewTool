<?php
require_once('db/db.php');
require_once('inc/header.php');
?>

<!-- remove current author status from header -->
<script type="text/javascript">
	$('#nav').remove();
</script>

<div id="page_content">
	<p>To begin, select an Author / Project below.</p>	
	<form id="author_select" class="forms" name="author_select" action="citations.php" method="GET">
		<select name="author_id" id="author_id">
			<option value="select_def">select a person...</option>
			<?php
				$stmt = $CVreviewTool_dbconnect->prepare("SELECT id, name FROM person ORDER BY lname ASC");
				$stmt->execute(); 
				$stmt->bind_result($author_id, $author_name);
				while ( $row = $stmt->fetch() ) { ?>
					<option value="<?php echo $author_id; ?>">
						<?php echo $author_name; ?>
					</option>
		  		<?php } 
	  		?> 		
		</select>
		<input type="submit" class="btn btn-small" value="Begin" />
	</form>
	</br>
	</br>

	<p>Or, <a href="author_create.php">begin a new CV review</a></p>	
</div>

<?php
require_once('footer.php');
?>