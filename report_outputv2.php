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
				<p>Journal publishers have different policies regarding author self-archiving in institutional repositories.  This document details the versions of your publications that can be self-archived. This is sometimes referred to as "Green Open Access."  For example, one publisher may allow their final PDF to be deposited, while others specify the final submission manuscript (referred to as the post-print) may only be deposited.</p>
				<p>Books and book chapters require contacting publishers directly. After we determine who to contact, we will pursue permissions for these materials by contacting publishers on your behalf and asking for permission to deposit.</p>
				<p>Conference papers and presentation are all eligible to be archived. Please let us know if you'd like to deposit any of these.</p>				
				<h5>Next Steps</h5>
				<p>The following lists (next page) organize your publications according to the version permissible for deposit. A few notes:</p>
				<ul style="list-style-type:circle;">
					<li>Permissions checks were only conducted for journal articles. We will have to directly contact publishers to get permissions for book chapters.</li>
					</br>
					<li>For publications you do not have PDF copies of, please indicate, we can scan if you have a print copy available.</li>
					</br>
					<li>Where publisher information is unknown for a journal article, we will submit a permissions letter - a basic template of this letter is attached at the end of this document. Please confirm that you would like us to pursue this on your behalf.</li>
				</ul>				
			</div>
			
			<h4>Publications</h4>
			<p>All publications in green, we have files acceptable for deposit.  <strong>All un-marked publications, we need files from you if possible.</strong></p>
			<hr>
			<div id="publications_text" class="report_copy">				
				<div id="publisher_citations" class="citations">
					<h4>Ready for Deposit</h4>
					<p>We will obtain the publisher PDF and deposit immediately, or already have a post-print / pre-print that is acceptable for deposit.  We just need your okay to go ahead!</p>
					<?php genExternalReportCitationsv2($author_id,'publisher',$CVreviewTool_dbconnect); ?>
				</div>				
				<div id="postprint_citations" class="citations">
					<h4>Rights Cleared, but Need Post-Print Manuscript</h4>
						<p>Publishers allow for deposit, but not the final, publisher produced version.  Please send us the <strong>final submission</strong> manuscript for each, we will re-format and deposit this file.  We can also provide digitization services for post-print documents.<p>
					<?php genExternalReportCitationsv2($author_id,'postprint',$CVreviewTool_dbconnect); ?>
				</div>
				<div id="preprint_citations" class="citations">
					<h4>Pre-Print Manuscript</h4>
						<p>Similarly, rights are cleared.  But for these, we need the <strong>pre-print</strong> version of your publication; before any typsesetting or peer-review process.<p>	
					<?php genExternalReportCitationsv2($author_id,'preprint',$CVreviewTool_dbconnect); ?>					
				</div>
				<div id="in_progress" class="citations">
					<h4>Other</h4>						
					<?php genExternalReportCitationsv2($author_id,'in_progress',$CVreviewTool_dbconnect); ?>
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
