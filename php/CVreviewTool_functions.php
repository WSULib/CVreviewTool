<?php

// generate citations for internal / management report
// includes CRUD and restrictions on
function genInternalReportCitations($author_id, $context, $CVreviewTool_dbconnect){
	$query = "SELECT id, citation, postprint_restrictions, preprint_restrictions, report_choice, jtitle, issn, internalNotes, status FROM citations WHERE (person_id = '$author_id' AND report_choice = '$context')";
	$result = $CVreviewTool_dbconnect->query($query) or die($CVreviewTool_dbconnect->error.__LINE__);
	if($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {	
				// set completed status if true				
				if ( $row['status'] == "1"){
					$citationStatus = "statusComplete";
					$checkStatus = "checked";
				}
				else {
					$citationStatus = "inProcess";	
					$checkStatus = "";
				}


				if($i%2 == 0) {
					echo "<div class='cite_dark citation $citationStatus'>";
				}
				else {
					echo "<div class='cite_light citation $citationStatus'>";	
				}
				echo "<div class='cite_text_box' id='{$row['id']}'>";

				// genereate citation with restrictions (if applicable)	
				$key = $row['report_choice'].'_restrictions';				
				if (!empty($row[$key])){
					$citationText = "{$row['citation']}<ul class='restrictionText'><li><strong>{$row[$key]}</strong></li></ul>";
				}
				else{
					$citationText = $row['citation'];
				}
			 	echo $citationText;
			 	echo "</div>"; // close citation text
			 	echo "<div id='citationIntNotes_{$row['id']}' class='citationIntNotes'>";
			 	echo $row['internalNotes'];
			 	echo "</div>";
				echo "<div class='cite_edit small'><ul class='inline-list'><li><a href='http://www.sherpa.ac.uk/romeo/search.php?issn={$row['issn']}'><em>{$row['jtitle']}:</em></a></li>";
				echo "<li><a class='orange' href='#' onclick='editCitation($author_id,{$row['id']});'><strong>edit</strong></a></li>";											 
				echo "<li><a class='red' href='delete.php?citation_num={$row['id']}&author_id=$author_id'><strong>delete</strong></a></li>";
				echo "<li><a class='blue' href='citations.php?author_id=$author_id&reval={$row['id']}'><strong>re-evaluate</strong></a></li>";
				echo "<li><a class='green' href='#' onclick='editCitationIntNotes($author_id,{$row['id']});'><strong>edit notes</strong></a></li>";
				echo "<li><strong>completed?</strong> <input type='checkbox' $checkStatus onclick='toggleCitationStatus(\"{$row['id']}\");' /></li>";
				echo "</ul></div>";
				echo "</div>";
				// move the counter
				$i++; 
			}
	}
	else {
		echo '<span style="color:red;">No Results Found.</span>';	
	}	
}


// genereates citations for outward facing report
// no CRUD, can toggle restrictions
function genExternalReportCitations($author_id, $context, $CVreviewTool_dbconnect){
	$query = "SELECT id, citation, postprint_restrictions, preprint_restrictions, report_choice, jtitle, issn FROM citations WHERE (person_id = '$author_id' AND report_choice = '$context')";
	$result = $CVreviewTool_dbconnect->query($query) or die($CVreviewTool_dbconnect->error.__LINE__);
	if($result->num_rows > 0) {
		$i = 0;
		while($row = $result->fetch_assoc()) {
				if($i%2 == 0) {
					echo "<div class='cite_dark'>";
				}
				else {
					echo "<div class='cite_light'>";	
				}
				echo "<div class='cite_text_box' id='{$row['id']}'>";
				// genereate citation WITHOUT restrictions					
			 	echo $row['citation'];
			 	echo "</div></div>";								
				// move the counter
				$i++; 
			}
	}
	else {
		echo 'No Results Found.';
		// script to destroy itself
		echo "<script type='text/javascript'>$('#".$context."_citations').hide();</script>";
	}	
}