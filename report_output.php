<?php
require_once('db/db.php');
require_once('config/app_config.php');
require_once('report_header.php');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// define function for repeating citation printing
function print_citations($query) {	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (!empty($_REQUEST['author_id'])) {

	$author_id = $_REQUEST['author_id'];
	///////////////////////////////////////////////////////////////////////
	$query = "SELECT name FROM person WHERE id = '$author_id'";
	$result = $CVreviewTool_dbconnect->query($query) or die($selfarchive_dbconnect->error.__LINE__);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				 $author_name = $row['name'];	
			}
		}
		else {
			echo 'No Results Found.';	
		}	 
	///////////////////////////////////////////////////////////////////////
	
	?>

	<div id="page_content">		

		<div id="report_body">			
			<h4>Overview</h4>
			<hr>			
			<div id="overview_text_output" class="report_copy">
				<p>Journal publishers have different policies regarding author archiving in institutional repositories like Digital Commons@WSU.  This document details the versions of your publications that can be archived Digital Commons@WSU. For example, one publisher may allow their final PDF to be deposited, while others specify the final submission manuscript (referred to as the post-print) may only be deposited.</p>
				<p>Books and book chapters require contacting publishers directly. After we determine who to contact, we will pursue permissions for these materials by contacting publishers on your behalf and asking for permission to deposit to Digital Commons.</p>
				<p>Conference papers and presentation are all eligible to be archived. Please let me know if you'd like to make any of those deposited to Digital Commons.</p>				
				<h5>Next Steps</h5>
				<p>The following lists (next page) organize your publications according to the version permissible for depositing to DigitalCommons@WSU. A few notes:</p>
				<ul style="list-style-type:circle;">
					<li>Permissions checks were only conducted for journal articles. We will have to directly contact publishers to get permissions for book chapters.</li>
					</br>
					<li>For publications you do not have PDF copies of, please indicate, we can scan if you have a print copy available.</li>
					</br>
					<li>Where publisher information is unknown for a journal article, we will submit a permissions letter - a basic template of this letter is attached at the end of this document. Please confirm that you would like us to pursue this on your behalf.</li>
				</ul>				
			</div>
			
			<h4>Publications</h4>
			<hr>
			<div id="publications_text" class="report_copy">				
				<div id="publisher_citations" class="citations">
					<h5>Publisher's PDF</h5>
					<p>We will obtain the PDF and deposit immediately.</p>
					<?php genExternalReportCitations($author_id,'publisher',$CVreviewTool_dbconnect); ?>
				</div>				
				<div id="postprint_citations" class="citations">
					<h5>Post-Print/Final Submission Manuscript</h5>
					<p>Please send us the final submission manuscript for each, we will re-format and deposit this file.  We can also provide digitization services for post-print documents, or in some cases, create a document for self-archiving from the published version.<p>
					<?php genExternalReportCitations($author_id,'postprint',$CVreviewTool_dbconnect); ?>
				</div>
				<div id="preprint_citations" class="citations">
					<h5>Pre-Prints</h5>					
					<?php genExternalReportCitations($author_id,'preprint',$CVreviewTool_dbconnect); ?>
				</div>
			</div> <!--closes publications -->
		</div>
	</div>
<?php }

else { ?>
	<div id="page_content">
		<p>Not sure who we are working with, <a href='index.php'>return to author / project selection</a>.</p>
	</div>
<?php }

//footer
include('inc/report_footer.php');

?>
