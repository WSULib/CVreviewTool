<?php
require_once('db/db.php');
require_once('inc/header.php');

// selected permissions type for report
$perm_type = $_REQUEST['perm_type'];

//get citation info from cookie
$citation_info = unserialize($_COOKIE['citation_info']);

foreach ($citation_info as $key => $value) {		  
	$clean[$key] = filter_var($value, FILTER_SANITIZE_STRING);
}
$citation_text = trim($citation_info['citation_text']);
$issn = strip_tags($citation_info['issn']);

// new citation, journal found, selection made
////////////////////////////////////////////////////////////////////////////////////////////////
if ($perm_type != "in_progress" && empty($clean['reval']) ){	

	//processing for db insert
	$citation_text = trim($citation_info['citation_text']);

	//db insert
	$query = "INSERT INTO citations SET 
		person_id = '{$clean['author_id']}', 
		citation = '$citation_text',
		jtitle = '{$clean['jtitle']}',
		issn = '$issn',
		conditions = '{$clean['conditions']}',
		report_choice = '{$perm_type}',
		preprint = '{$clean['preprint']}',
		postprint = '{$clean['postprint']}',
		preprint_restrictions = '{$clean['pre_restrictions']}',
		postprint_restrictions = '{$clean['post_restrictions']}'
		";


	if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }

	else {
		?>
		<div id="page_content">
			<?php		
				echo "Citation added.</br></br>";
				echo "<a href='citations.php?author_id={$clean['author_id']}'>Add another</a> / ";
				echo "<a href='report.php?author_id={$clean['author_id']}'>View Report</button></a></br>";
		?></div><?php

	}	
}

// udpate citation, journal found, selection made
////////////////////////////////////////////////////////////////////////////////////////////////
if ($perm_type != "in_progress" && !empty($clean['reval'])){

	//processing for db insert
	$citation_text = trim($citation_info['citation_text']);	

	//db insert
	$query = "UPDATE citations SET 
		person_id = '{$clean['author_id']}', 
		citation = '$citation_text',
		jtitle = '{$clean['jtitle']}',
		issn = '$issn',
		conditions = '{$clean['conditions']}',
		report_choice = '{$perm_type}',
		preprint = '{$clean['preprint']}',
		postprint = '{$clean['postprint']}',
		preprint_restrictions = '{$clean['pre_restrictions']}',
		postprint_restrictions = '{$clean['post_restrictions']}'
		WHERE id = {$clean['reval']}";

	if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }

	else{
		?>
		<div id="page_content">
			<p>Citation Updated.</p>
		</div>
		<?php
	}	
}



// new citation, saving for later
////////////////////////////////////////////////////////////////////////////////////////////////
if ($perm_type == "in_progress" && empty($clean['reval']) ) {

	$citation_text = trim($citation_info['citation_text']);	

	//db insert
	$query = "INSERT INTO citations SET 
		person_id = '{$clean['author_id']}', 
		citation = '$citation_text',
		jtitle = '{$clean['jtitle']}',
		issn = '$issn',
		conditions = '{$clean['conditions']}',
		report_choice = '{$perm_type}',
		preprint = '{$clean['preprint']}',
		postprint = '{$clean['postprint']}',
		preprint_restrictions = '{$clean['pre_restrictions']}',
		postprint_restrictions = '{$clean['post_restrictions']}'
		";

	if (!@$CVreviewTool_dbconnect->query($query)) {echo $query; die; }

	else {
		?>
		<div id="page_content">
			<p>Saved for Later.</p>
		</div>
		<?php
	}
}


// updating UNFOUND journal citation, "reval" workflow
////////////////////////////////////////////////////////////////////////////////////////////////
if ($perm_type == "in_progress" && !empty($clean['reval'])) { 
	
	//db update
	$query = "UPDATE citations SET 
		citation = '$citation_text',
		jtitle = '{$clean['jtitle']}',
		issn = '$issn',
		report_choice = '{$perm_type}'
		WHERE id = {$clean['reval']}";	

	if (!@$CVreviewTool_dbconnect->query($query)) {echo "4th option"; echo $query; die; }

	else{
		?>
		<div id="page_content">
			<p>Citation Updated.</p>
		</div>
		<?php
	}	
}

//footer
require_once('footer.php');
?>
