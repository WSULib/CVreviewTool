<?php
require_once('db/db.php');
require_once('inc/header.php');
$author_id = $_REQUEST['author_id'];

// check if selecting for "in_progress"
if(!isset($_REQUEST['in_progress'])){
	// retrieve form data, hit Sherpa API
	// ISSN trumps all, previously entered journal trumps search terms box
	if(!empty($_POST['issn']))
		{
		    $issn = $_POST['issn'];	    
		    $url = 'http://www.sherpa.ac.uk/romeo/api29.php?issn=' . $issn . '&ak=xZXLRaguUXs';	    
		    $encoded_url = urlencode($url);	    
		    $obj = simplexml_load_file($encoded_url);	    	    
		}

	//previously entered journal title provided...
	else if(!empty($_POST['prev_issn']))
		{		
		     $issn = $_POST['prev_issn'];	       
		    $url = 'http://www.sherpa.ac.uk/romeo/api29.php?issn=' . $issn . '&ak=xZXLRaguUXs';	  	    
		    $encoded_url = urlencode($url);	    
		    $obj = simplexml_load_file($encoded_url);	    	    
		}

	//journal title provided...
	else if(!empty($_POST['jtitle']))
		{		
		    $jtitle = $_POST['jtitle'];	    
		    $url = 'http://www.sherpa.ac.uk/romeo/api29.php?jtitle=' . $jtitle . '&ak=xZXLRaguUXs&qtype=exact';	    
		    $encoded_url = urlencode($url);	    
		    $obj = simplexml_load_file($encoded_url);	    	    
		}

	//determine if journal found
	$outcome = $obj->header->outcome;

	// JOURNAL AND CONDITIONS FOUND
	if ($outcome != 'notFound' && !empty($outcome) && isset($obj->publishers->publisher)) {		

		//parse XML for information and permissions
		if (isset($obj->journals->journal)){
			$jtitle = $obj->journals->journal->jtitle;
			$publisher = $obj->journals->journal->romeopub;				
			$issn = $obj->journals->journal->issn;
		}
		if (isset($obj->publishers->publisher)) {			
			$conditions = $obj->publishers->publisher->conditions; //array of "condition"
			$preprint = $obj->publishers->publisher->preprints->prearchiving;
			$preprint_restrictions = $obj->publishers->publisher->preprints->prerestrictions; //array of "prerestrction"
			$postprint = $obj->publishers->publisher->postprints->postarchiving;	
			$postprint_restrictions = $obj->publishers->publisher->postprints->postrestrictions; //array of "postrestrction"
			$pdfversion = $obj->publishers->publisher->pdfversion->pdfarchiving;	
			$pdfversion_restrictions = $obj->publishers->publisher->pdfversion->pdfrestrictions; //array of "postrestrction"
		}		
		?>

		<div id="page_content">
			<?php		
				echo "<b>Journal Title:</b> <a href='http://www.sherpa.ac.uk/romeo/search.php?issn=$issn'>$jtitle</a></br>";
				echo "<b>ISSN:</b> $issn</br>";
				echo "<b>Publisher:</b> $publisher</br>";
				echo "<b>Preprint:</b> $preprint</br>";
				if (sizeof($preprint_restrictions->prerestriction) > 0) {
					echo "<ul>";
					foreach ($preprint_restrictions->prerestriction as $pre) {				
						echo "<li>$pre</li>";
					}
					echo "</ul>";
				}
				echo "<b>Postprint:</b> $postprint</br>";
				if (sizeof($postprint_restrictions->postrestriction) > 0) {
					echo "<ul>";
					foreach ($postprint_restrictions->postrestriction as $post) {				
						echo "<li>$post</li>";
					}
					echo "</ul>";
				}
				echo "<b>Publisher PDF:</b> $pdfversion</br>";
				if (sizeof($pdfversion_restrictions->pdfrestriction) > 0) {
					echo "<ul>";
					foreach ($pdfversion_restrictions->pdfrestriction as $post) {				
						echo "<li>$post</li>";
					}
					echo "</ul>";
				}
				echo "<b>Conditions:</b></br>";
				if (sizeof($conditions->condition) > 0) {
					echo "<ul>";			
					foreach ($conditions->condition as $condition) {				
						echo "<li>$condition</li>";
					}
					echo "</ul>";
				}
				echo "<ul>";
				echo "</ul>";

				echo "<b>Citations to add under this journal:</b>";
				echo "<div id='citation_text_box'>";
				echo $_POST['citation_text'];
				echo "</div>";

				//create param_array for citations db entry
				$citation_info = array(
										'author_id' => $author_id,
										'citation_text' => $_POST['citation_text'],
										'jtitle' => $jtitle->asXML(),
										'issn' => $issn->asXML(),
										'preprint' => $preprint->asXML(),
										'postprint' => $postprint->asXML(),
										'conditions' => $conditions->asXML(),
										'post_restrictions' => $postprint_restrictions->asXML(),
										'pre_restrictions' => $preprint_restrictions->asXML(),
										'reval' => $_POST['reval']
										);
				
				//cookie
				$srz_citation_info = serialize($citation_info);
				setcookie("citation_info", $srz_citation_info);		

			?>		
			</br></br></br>
			<div id="report_decision">		
				<p><b>Select a report section to add citations to, or go back:</b></br>
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=publisher'">Add to Publisher</button>
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=postprint'">Add to PostPrints</button>			
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=preprint'">Add to PrePrints</button>
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=in_progress'">Save for Later</button>				
					<button class="btn btn-small" onClick="javascript:history.back();">Go Back</button>
				</p>
			</div>
		<?php 
	} //closes != notFound conditional

	// JOURNAL FOUND, BUT NOT CONDITIONS
	elseif ($outcome != 'notFound' && !empty($outcome) && !isset($obj->publishers->publisher)) {

		

		//parse XML for information and permissions
		if (isset($obj->journals->journal)){
			$jtitle = $obj->journals->journal->jtitle;
			$publisher = $obj->journals->journal->romeopub;				
			$issn = $obj->journals->journal->issn;
		}				
		?>

		<div id="page_content">
			<?php		
				echo "<b>Journal Title:</b> <a href='http://www.sherpa.ac.uk/romeo/search.php?issn=$issn'>$jtitle</a></br>";
				echo "<b>ISSN:</b> $issn</br>";				

				echo "<b>Citations to add under this journal:</b>";
				echo "<div id='citation_text_box'>";
				echo $_POST['citation_text'];
				echo "</div>";

				//create param_array for citations db entry
				$citation_info = array(
										'author_id' => $author_id,
										'citation_text' => $_POST['citation_text'],
										'jtitle' => $jtitle->asXML(),
										'issn' => $issn->asXML(),										
										'reval' => $_POST['reval']
										);
				
				//cookie
				$srz_citation_info = serialize($citation_info);
				setcookie("citation_info", $srz_citation_info);		

			?>		
			</br></br></br>
			<div id="report_decision">		
				<p><b>Select a report section to add citations to, or go back:</b></br>
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=publisher'">Add to Publisher</button>
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=postprint'">Add to PostPrints</button>			
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=preprint'">Add to PrePrints</button>
					<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=in_progress'">Save for Later</button>				
					<button class="btn btn-small" onClick="javascript:history.back();">Go Back</button>
				</p>
			</div>
		<?php 	

	}

	else {

		// create param_array for citations db entry
		$citation_info = array(
								'author_id' => $author_id,
								'citation_text' => $_REQUEST['citation_text'],
								'jtitle' => $_REQUEST['jtitle'],
								'issn' => $_REQUEST['issn'],								
								'reval' => $_POST['reval']
								);
		
		//cookie
		$srz_citation_info = serialize($citation_info);
		setcookie("citation_info", $srz_citation_info);	


		?>

		<div id='page_content'>
		<p class='red'>Journal not found.</p>
		<div id="report_decision">		
			<p><b>Select a report section to add citations to, or go back:</b></br>
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=publisher'">Add to Publisher</button>
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=postprint'">Add to PostPrints</button>			
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=preprint'">Add to PrePrints</button>
				<button class="btn btn-small" onclick="window.location='citation_inc.php?author_id=<?php echo $author_id; ?>&perm_type=in_progress'">Save for Later</button>				
				<button class="btn btn-small" onClick="javascript:history.back();">Go Back</button>
			</p>
		</div>	
		
		<?php
	} ?>

		</div> <!-- closes page_content div -->
<?php
}

// in the case of a reval
else {	
	//create param_array for citations db entry
	$citation_info = array(
		'author_id' => $author_id,
		'citation_text' => $_REQUEST['citation_text'],
		'jtitle' => $_REQUEST['jtitle'],
		'issn' => $_REQUEST['issn'],
		'reval' => $_REQUEST['reval']
	);

	//cookie
	$srz_citation_info = serialize($citation_info);
	setcookie("citation_info", $srz_citation_info);	

	// redirect with javascript
	echo "<script type='text/javascript'>window.location = 'citation_inc.php?author_id=$author_id&perm_type=in_progress';</script>";

}






