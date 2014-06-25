<?

require('classes/filestore.php');

$file = new Filestore('data/list.txt');

// define('FILENAME', 'data/list.txt');
$new_task = $file->read(); 

class UnexpectedTypeException extends Exception {}

// get ID in URL   
if (isset($_GET['id'])) {
	unset($new_task[$_GET['id']]); //delete item selected
	$file->write($new_task); //saved changes 
	$new_task = $file->read(); //reopen new file w/ changes
	header ('Location: /todo_list.php');
}	
// add new items to todo list and will give error if empty or > than 240 chars  


try {
	if (isset($_POST['add_task'])) {
		$item = trim($_POST['add_task']);
		if ($_POST['add_task'] == "" || strlen($_POST['add_task'] > 240)) {
			throw new UnexpectedTypeException("New task can't be empty or exceed 240 characters");
		
			
		
			// if (strlen($item) > 240 || strlen($item) == 0) {
		} else {
			array_push($new_task, $item);  // once checks are complete it will push new task onto array
			$file->write($new_task);
			header ('Location: /todo_list.php');	
		}
	}
		
} catch (UnexpectedTypeException $e) {
	$msg = $e->getMessage() . PHP_EOL;
}

// Verify there were uploaded files and no errors
if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
    $upload_dir = '/vagrant/sites/todo.dev/public/uploads/';
    $filename = basename($_FILES['file1']['name']);
    $saved_filename = $upload_dir . $filename;
    move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
}
//merge the open file w/ the the task
if (isset($saved_filename)) {
    $file_todo = $saved_filename;
    $new_file = $file->read($file_todo);  // turns the string into an array
    $new_task = array_merge($new_task,$new_file);
    $file->write($new_task);
}

// *******echo $msg;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Codeup Todo list</title>
		<link rel="stylesheet" type="text/css" href="./css/todo_list.css">
	</head>
	<body>
		<h1>TODO List</h1>
		<? if (isset($msg)) : ?>
			<?="Sorry, your New task can't be empty or exceed 240 characters"?>
		<? endif; ?>	 
		<ul>
			<? foreach ($new_task as $key => $item): ?>
				<ul><?= htmlspecialchars(strip_tags($item)). "<a href='?id=$key'>  -Remove task-</a>";?></ul>		
			<? endforeach; ?>
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
		<h3>Upload File</h3>
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