<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Handlebars Form</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="default.css">
	<script src="js/jquery.js"></script>
</head>
<body>
<div class="suefeng-demo-navi">
		<a href="http://suefeng.net/?p=165"><strong>&laquo; Previous Demo: </strong>jQuery and jQuery UI Demos</a>
		<span class="right">
			<a href="http://suefeng.net/?p=317"><strong>Back to the Handlebars Article</strong></a>
		</span>
</div>
<h1>Handlebars and Grid Demo</h1>
<p class="navi"><a href="data/entries.js">view data</a> | <a href="index.html">view index</a></p>
<form action="form.php" method="post">
<div class="title">Post an Entry</div>
<p><input type="text" name="title" placeholder="Title" class="field"></p>
<p><input type="email" name="email" class="none"></p>
<p><textarea cols="40" rows="20" name="body" placeholder="Post" class="field"></textarea></p>
<p><input type="submit" value="Submit" name="submit" class="button"></p>
</form>
<?php 
class entry {
    public $title = "";
    public $body  = "";
}
$doc = $_SERVER['DOCUMENT_ROOT']."/demos/handlebars/data/entries.js";
if(isset($_POST['submit']) && $_POST['email'] == "") {
	$entry = new entry();
	$entry->title = stripslashes($_POST['title']);
	$entry->body  = stripslashes($_POST['body']);
	$entry->date = date('l, F jS, Y');
	$outputstring = json_encode($entry);
	//first, obtain the data initially present in the text file 
    $ini_handle = fopen($doc, "r"); 
    $ini_contents = str_replace('{"entry" : [', '', fread($ini_handle, filesize($doc))); 
    fclose($ini_handle); 
    //done obtaining initially present data 
   
    //write new data to the file, along with the old data 
    $handle = fopen($doc, "w+"); 
        $writestring = "{\"entry\" : [\n\t" . $outputstring . "," . $ini_contents; 
        if (fwrite($handle, $writestring) === false) { 
            echo "Cannot write to text file. <br />";           
        } 
		else { echo "<div class=\"entries\">Success!</div>"; }
    fclose($handle); 
}
?>
</body>
</html>