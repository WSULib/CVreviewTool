<?php 

require_once('db/db.php');

// get row
$citeNum = $_REQUEST['citeNum'];
$query = "UPDATE citations SET status = !status WHERE id = $citeNum";
$result = $CVreviewTool_dbconnect->query($query) or die($CVreviewTool_dbconnect->error.__LINE__);
echo "Great Success.";


?>

