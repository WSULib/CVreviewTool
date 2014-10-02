<?php
require_once('db/db.php');
require_once('inc/header.php');
include('php/fileExt.php');

// get author id
$author_id = $_REQUEST['author_id'];
?>

<div id="page_content">

<?php
// 1) If uploading file, catch that, upload file
if(file_exists($_FILES['authorDoc']['tmp_name']) || is_uploaded_file($_FILES['authorDoc']['tmp_name'])) {
	echo "<div id='file_status'><h4>CV Upload Status</h4><ul>";
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	}
	else {	
		echo "<li>Upload: " . $_FILES["authorDoc"]["name"] . "</li>";
		echo "<li>Type: " . $_FILES["authorDoc"]["type"] . "</li>";
		echo "<li>Size: " . ($_FILES["authorDoc"]["size"] / 1024) . " kB</li>";
		echo "<li>Temp file: " . $_FILES["authorDoc"]["tmp_name"] . "</li>";
		
		// make dir in neccassary
		if (!file_exists("cvs/$author_id")) {
		    mkdir("cvs/$author_id/", 0777, true);
		}

		if (file_exists("cvs/$author_id/" . $_FILES["authorDoc"]["name"])) {
			// echo $_FILES["authorDoc"]["name"] . " already exists. ";
			move_uploaded_file($_FILES["authorDoc"]["tmp_name"], "cvs/$author_id/".$_FILES["authorDoc"]["name"]);
			echo "<li>Overwritten: " . "cvs/$author_id/" . $_FILES["authorDoc"]["name"]."</li>";
		}
		else {
			move_uploaded_file($_FILES["authorDoc"]["tmp_name"], "cvs/$author_id/".$_FILES["authorDoc"]["name"]);
			echo "<li>Stored in: " . "cvs/$author_id/" . $_FILES["authorDoc"]["name"]."</li>";
		}	
	}
	echo "</ul></div>";    
}

// 2) If pushing article URL to download for article

if (isset($_REQUEST['articleNum'])) {

	echo "<div id='file_status'><h4>Article Download / Save Status</h4><ul>";
	
	// get params
	$articleNum = $_REQUEST['articleNum'];
	$url = $_REQUEST['articleURL'];	

	// make dir in neccassary
	if (!file_exists("articles/$author_id")) {
	    mkdir("articles/$author_id/", 0777, true);
	}	

	// if upload file, download and rename
	if(file_exists($_FILES['articleDoc']['tmp_name']) || is_uploaded_file($_FILES['articleDoc']['tmp_name'])) {
		
		$associated_articles = glob("articles/$author_id/$articleNum*.*");
		print_r($associated_articles);		

		echo "Found related articles: ".count($associated_articles);	
		$file_extension = AppUtil::FileExt($_FILES["articleDoc"]["type"]);
		echo "File extension: ".$file_extension;		

		$filename = "articles/$author_id/".$_REQUEST['articleNum']."_".(count($associated_articles)+1).$file_extension;	
		echo "Filename: ".$filename;	
		move_uploaded_file($_FILES["articleDoc"]["tmp_name"], $filename);
	}

	else {		

		$associated_articles = glob("articles/$author_id/$articleNum*.*");
		print_r($associated_articles);

		// using curl to pickup headers
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		$mime = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
		echo "State mime: ".$mime;
		$file_extension = AppUtil::FileExt($mime);
		echo "File extension: ".$file_extension;

		$filename = "articles/$author_id/".$_REQUEST['articleNum']."_".(count($associated_articles)+1).$file_extension;
		echo "Filename: ".$filename;
		$fp = fopen($filename, 'w');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		$data = curl_exec($ch);
		curl_close($ch);
		fclose($fp);

	}
	
	echo "<li><Stored in: " . "articles/$author_id/" . $_FILES["authorDoc"]["name"]."</li>";		
	echo "</ul></div>";    
}

// 3) File removal

if (isset($_REQUEST['fileDelete']) && isset($_REQUEST['filePath'])) {
	
	unlink($_REQUEST['filePath']);
	echo "<div id='file_status'><h4>File Removal</h4><p>Removed: {$_REQUEST['filePath']}</p>";

}


?>

	<div id="uploaded_files">
		<h4>Currently Uploaded CVs</h4>
		<ul>
			<?php
			// 2) Display all uploaded files regardless	
			if (file_exists("cvs/$author_id/")) {
			    $dirf    = "cvs/$author_id";
				$dir = scandir($dirf);
				foreach($dir as $file) {
				   if(($file!='..') && ($file!='.')) {
				      echo "<li><a href='cvs/$author_id/$file'>$file</a> <a href='./upload_documents.php?fileDelete=True&filePath=cvs/$author_id/$file&author_id=$author_id'>(remove)</a></li>";
				   }
				}
			}
			else{
				echo "<li>Empty.</li>";
			}
			
			?>
		</ul>
		<h4>Currently Uploaded Articles</h4>
		<ul>
			<?php
			// 2) Display all uploaded files regardless	
			if (file_exists("articles/$author_id/")) {
			    $dirf    = "articles/$author_id";
				$dir = scandir($dirf);
				foreach($dir as $file) {
				   if(($file!='..') && ($file!='.')) {
				      echo "<li><a href='articles/$author_id/$file'>$file</a> <a href='./upload_documents.php?fileDelete=True&filePath=articles/$author_id/$file&author_id=$author_id'>(remove)</a></li>";
				   }
				}
			}
			else{
				echo "<li>Empty.</li>";
			}
			
			?>
		</ul>
	</div>

	<div id="upload_file">
		<h4>Upload CV</h4>
		<form action="upload_documents.php?author_id=<?php echo $author_id; ?>" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="authorDoc" id="authorDoc"><br>
			<input type="hidden" name="author_id" id="author_id" value="<?php echo $author_id; ?>"/>
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>



</div>

<?php
require_once('inc/footer.php');
?>

