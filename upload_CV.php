<?php
require_once('db/db.php');
require_once('inc/header.php');

// get author id
$author_id = $_REQUEST['author_id'];
?>

<div id="page_content">

<?php

// 1) If uploading file, catch that, upload file
if(file_exists($_FILES['authorDoc']['tmp_name']) || is_uploaded_file($_FILES['authorDoc']['tmp_name'])) {
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	}

	else {	
		echo "Upload: " . $_FILES["authorDoc"]["name"] . "<br>";
		echo "Type: " . $_FILES["authorDoc"]["type"] . "<br>";
		echo "Size: " . ($_FILES["authorDoc"]["size"] / 1024) . " kB<br>";
		echo "Temp file: " . $_FILES["authorDoc"]["tmp_name"] . "<br>";
		
		// make dir in neccassary
		if (!file_exists("cvs/$author_id")) {
		    mkdir("cvs/$author_id/", 0777, true);
		}

		if (file_exists("cvs/$author_id/" . $_FILES["authorDoc"]["name"])) {
			echo $_FILES["authorDoc"]["name"] . " already exists. ";
		}
		else {
			move_uploaded_file($_FILES["authorDoc"]["tmp_name"], "cvs/$author_id/".$_FILES["authorDoc"]["name"]);
			echo "Stored in: " . "cvs/$author_id/" . $_FILES["authorDoc"]["name"];
		}	
	}    
}








?>


	<div id="uploaded_files">
		<h4>Currently Uploaded Files</h4>
		<ul>
			<?php
			// 2) Display all uploaded files regardless	
			$dirf    = "cvs/$author_id";
			$dir = scandir($dirf);
			foreach($dir as $file) {
			   if(($file!='..') && ($file!='.')) {
			      echo "<a href='cvs/$author_id/$file'>$file</a></br>";
			   }
			}
			?>
		</ul>
	</div>

	<div id="upload_file">
		<h4>Upload Files</h4>
		<form action="upload_CV.php?author_id=<?php echo $author_id; ?>" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="authorDoc" id="authorDoc"><br>
			<input type="hidden" name="author_id" id="author_id" value="<?php echo $author_id; ?>"/>
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>








</div>