<?php
require_once('db/db.php');
require_once('config/app_config.php');
require_once('inc/header.php');

$author_name = getAuthorName($author_id);
$author_name_pdf_safe = str_replace(" ", "_", $author_name); 

?>
 	<div id="page_content">
 		<?php
			echo "<p>Report Generated for $author_name. <a target='_blank' href='pdfs/$author_name_pdf_safe.pdf'>View PDF</a></p>";
			echo "<a href='report.php?author_id=$author_id'>Back to Report</a></br>";
?></div>

<?php

//footer
include('inc/footer.php');

// write pdf report
$cmd_string = "./wkhtmltopdf-amd64 $base_url/report_output.php?author_id=$author_id ./pdfs/$author_name_pdf_safe.pdf";
exec($cmd_string);

?>