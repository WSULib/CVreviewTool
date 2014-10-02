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
				echo "<div class='cite_edit small'><ul class='inline-list'>";
				echo "<li>#{$row['id']} -</li>";
				echo "<li><a href='http://www.sherpa.ac.uk/romeo/search.php?issn={$row['issn']}'><em>{$row['jtitle']}:</em></a></li>";
				echo "<li><a class='orange' href='#' onclick='editCitation($author_id,{$row['id']});'><strong>edit</strong></a></li>";	 
				echo "<li><a class='red' href='delete.php?citation_num={$row['id']}&author_id=$author_id'><strong>delete</strong></a></li>";
				echo "<li><a class='blue' href='citations.php?author_id=$author_id&reval={$row['id']}'><strong>re-evaluate</strong></a></li>";
				echo "<li><a class='green' href='#' onclick='editCitationIntNotes($author_id,{$row['id']});'><strong>edit notes</strong></a></li>";		
				echo "<li><a class='pink' href='#' onclick='uploadArticle($author_id,{$row['id']}); return false;'><strong>upload</strong></a></li>";				
				echo "<li><strong>completed?</strong> <input type='checkbox' $checkStatus onclick='toggleCitationStatus(\"{$row['id']}\");' /></li>";
				echo "</ul></div>";
				echo "<div id='article_files'>";
				foreach (glob("articles/$author_id/{$row['id']}*.*") as $filename) {
					echo " <a class='pink' target='_tab' href='$filename'><strong>(linked file)</strong></a>";	
				}
				// if (file_exists("articles/$author_id/{$row['id']}.pdf")) {
				// 	echo " <a target='_tab' href='articles/$author_id/{$row['id']}.pdf'><strong>(linked file)</strong></a>";
				// }
				echo "</div>";
				echo "<div class='article_upload_form' id='article_upload_{$row['id']}'><h4>Upload article</h4>";				
				echo "<form class='forms' action='upload_documents.php' method='POST' enctype='multipart/form-data'><input name='author_id' type=hidden value='$author_id'/><input name='articleNum' type=hidden value='{$row['id']}'/>";
				echo "<label>File upload:</label><input type='file' name='articleDoc' id='articleDoc'>";
				echo "<label>OR, article URL:</label><input name='articleURL' type='text' size=20/>";				
				echo "<br><input type='submit'/></form></div>";
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
			 	// keeping zebra striping capabilities for future, but switching to only light
				if($i%2 == 0) {
					echo "<div class='cite_light'>";
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