<?php
define('FILENAME', 'data/list.txt');


//  open a file process
function open_file($filename) { 
    $handle = fopen($filename, 'r'); // opens file and makes sure its readable
    $contents = fread($handle, filesize($filename)); //checks file size
    fclose($handle); // closes the file
    return explode("\n", $contents); // breaks up the 'string' into a array
}

// 
function save_file($filename, $array) {
		if (is_writable($filename)) {     // checks to see is file is a writable file
			$handle = fopen($filename, 'w'); // writes newly added task the the files
			fwrite($handle, implode("\n", $array));  // takes array w/ new added task then converst to string
			fclose($handle); // closes the file
		}
}

$new_task = open_file(FILENAME);
 
// if get ID in URL   
if (isset($_GET['id'])) {
	unset($new_task[$_GET['id']]); //delete item selected
	save_file(FILENAME,$new_task); //saved changes 
	$new_task = open_file(FILENAME); //reopen new file w/ changes
}	

if (isset($_POST['add_task'])) {
	$item = trim($_POST['add_task']);
	array_push($new_task, $item);
	save_file(FILENAME,$new_task);
}
// Verify there were uploaded files and no errors
if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
    // Set the destination directory for uploads
    $upload_dir = '/vagrant/sites/todo.dev/public/uploads/';
    // Grab the filename from the uploaded file by using basename
    $filename = basename($_FILES['file1']['name']);
    // Create the saved filename using the file's original name and our upload directory
    $saved_filename = $upload_dir . $filename;
    // Move the file from the temp location to our uploads directory
    move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
}

// Check if we saved a file
if (isset($saved_filename)) {
    // If we did, show a link to the uploaded file
    echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Codeup Todo list</title>
	</head>
	<body>
		
		<h1>TODO List</h1>
		<ul>
				<?php
				foreach ($new_task as $key => $item){
					echo "<li>$item<a href = '?id=$key'> -Remove task-</a></li>";				
				}
				
				?>

		</ul>
			<h3>Do you need to add a task to your TODO list?<br>Simply type your task in box below and click ADD task:</h3>
	        <form method="POST" action="todo_list.php">
	            <p>
	              <label for="add_task">Add item to TODO list:</label>
	              <input id="add_task" name="add_task" type="text"placeholder="type task here">
	            </p> 
	            <p>
	              <input type="submit">
	            </p>  
			</form>

		<h1>Upload File</h1>

			<form method="POST" enctype="multipart/form-data" action="/todo_list.php">
			    <p>
			        <label for="file1">File to upload: </label>
			        <input type="file" id="file1" name="file1">
			    </p>
			    <p>
			        <input type="submit" value="Upload">
			    </p>
			</form>
	</body>
</html>