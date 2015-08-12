<?php
require_once('db/db.php');
require_once('inc/header.php');


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
		<div id="report_tools" class="row">
			<h4>Report Tools</h4>
			<button id="generate_report" class="btn btn-small" onclick="window.location='generate_report.php?author_id=<?php echo $author_id; ?>'">Generate PDF Report</button>
			<img id="generate_loading" src="images/loader.gif" />
				<script type="text/javascript">
					$('#generate_report').click( function() {
						$('#generate_loading').fadeIn();	
					});					
				</script>
			<a target="_blank" href="report_output.php?author_id=<?php echo $author_id; ?>"><button class="btn btn-small">Generate HTML Report</button></a>
			<!-- <button class="btn btn-small disabled" >Merge Journal Titles (soon)</button> -->
			<button class="btn btn-small" onclick='$(".restrictionText").fadeToggle();' >Toggle Restrictions</button>
		</div>

		<div id="report_body">			
			<h4>Overview</h4><a id="show_overview" href="#" onclick="return false">[click to expand]</a>			
			<hr>			
			<div id="overview_text" class="report_copy">
				<p>Journal publishers have different policies regarding author archiving in institutional repositories like Digital Commons@WSU.  This document details the versions of your publications that can be archived Digital Commons@WSU. For example, one publisher may allow their final PDF to be deposited, while others specify the final submission manuscript (referred to as the post-print) may only be deposited.</p>
				<p>Books and book chapters require contacting publishers directly. After we determine who to contact, we will pursue permissions for these materials by contacting publishers on your behalf and asking for permission to deposit to Digital Commons.</p>
				<p>Conference papers and presentation are all eligible to be archived. Please let me know if you'd like to make any of those deposited to Digital Commons.</p>				
				<h5>Next Steps</h5>
				<p>The following lists (next page) organize your publications according to the version permissible for depositing to DigitalCommons@WSU. A few notes:</p>
				<ul style="list-style-type:circle;">
					<li>Permissions checks were only conducted for journal articles. We will have to directly contact publishers to get permissions for book chapters.</li>
					</br>
					<li>PDF's are separated into two lists based on what is electronically available to me. For publications you do not have PDF copies of, please indicate, we can scan if you have a print copy available.</li>
					</br>
					<li>Where publisher information is unknown for a journal article, we will submit a permissions letter – a basic template of this letter is attached at the end of this document. Please confirm that you would like us to pursue this on your behalf.</li>
				</ul>				
			</div>			
			
			<h4>Publications</h4>
			<hr>
				<div id="publications_text" class="report_copy">
					<div id="pub_citations" class="citations">
						<h4>Publisher's PDF</h4>
						<p>We will obtain the PDF and deposit immediately.</p>
							<?php genInternalReportCitations($author_id,'publisher',$CVreviewTool_dbconnect); ?>
					</div>
					<div id="post_ctations" class="citations">
						<h4>Post-Print/Final Submission Manuscript</h4>
						<p>Please send us the final submission manuscript for each, we will re-format and deposit this file.  We can also provide digitization services for post-print documents, or in some cases, create a document for self-archiving from the published version.<p>						
						<?php genInternalReportCitations($author_id,'postprint',$CVreviewTool_dbconnect); ?>
					</div>
					<div id="pre_citations" class="citations">
						<h4>Pre-Prints</h4>						
						<?php genInternalReportCitations($author_id,'preprint',$CVreviewTool_dbconnect); ?>
					</div>
					<div id="in_progress" class="citations">
						<h4>In Progress</h4>						
						<?php genInternalReportCitations($author_id,'in_progress',$CVreviewTool_dbconnect); ?>
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
include('inc/footer.php');
?>
