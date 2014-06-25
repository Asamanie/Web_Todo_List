<?php

// 1. Establish DB connection 
$dbc = new PDO('mysql:host=127.0.0.1;dbname=todo_db', 'Andrew', 'letmein');
// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

// making table for todo list
// $query = 'CREATE TABLE todo_list (
//     id INT UNSIGNED NOT NULL AUTO_INCREMENT,
//     task VARCHAR(100) NOT NULL,
//     PRIMARY KEY (id)
// )';

// // // Run query, if there are errors they will be thrown as PDOExceptions
// $dbc->exec($query);


//      c. Is list being uploaded? => Add todos
// 3. Query DB for total todo count.
// 4. Determine pagination values.
// 5. Query for todo on current page
//
//	<form id="form delete" method="POST">
//		<input type="hidden" name="remove id">
//	</form>	

// Get new instance of PDO object


// setting the limit and offset
$limit = 10;
$pageNumber = 0;
$offset = 0;


$query = 'SELECT * FROM todo_list LIMIT :limitRecord OFFSET :offset';
$stmt = $dbc->prepare($query);
$stmt->bindValue(':limitRecord', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$todos_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($todos_array);


// 2. Check if something was posted.
// 		a. Is item being added? => Add todo
//      b. Is item being removed? => Remove it
if (!empty($_POST)){	

	// var_dump($_POST);

	if (isset($_POST['add_task'])) {
		$stmt = $dbc->prepare('INSERT INTO todo_list (task) VALUES (:task)');
 		$stmt->bindValue(':task', $_POST['add_task'], PDO::PARAM_STR);
 		$stmt->execute();
 		header ('Location: /todo_insert.php');
 		exit;(0);
 	}	
// deleting task from DB
 	if (isset($_POST['remove'])) {
 		$stmt = $dbc->prepare('DELETE FROM todo_list WHERE id = :id');
 		$stmt->bindValue(':id', $_POST['remove'], PDO::PARAM_INT);
 		$stmt->execute();
 		header ('Location: /todo_insert.php');
 		exit;(0);
	}
}	

		
// Verify there were uploaded files and no errors
// if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
//     $upload_dir = '/vagrant/sites/todo.dev/public/uploads/';
//     $filename = basename($_FILES['file1']['name']);
//     $saved_filename = $upload_dir . $filename;
//     move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
// }
// //merge the open file w/ the the task
// if (isset($saved_filename)) {
//     $file_todo = $saved_filename;
//     $new_file = $file->read($file_todo);  // turns the string into an array
//     $new_task = array_merge($new_task,$new_file);
//     $file->write($new_task);
// }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Todo list</title>
		<link rel="stylesheet" type="text/css" href="./css/todo_list.css">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>
	<body>
		<h1>TODO List</h1>
		<? if (isset($msg)) : ?>
			<?="Sorry, your New task can't be empty or exceed 240 characters"?>
		<? endif; ?>	 
		<ul>
			<? foreach ($todos_array as $item): ?>
				<ul><?= $item['id'] ?>
					<?= $item['task'] ?> 
					<button class="btn btn-danger btn-sm pull-right btn-remove" data-todo="<?= $item['id']; ?>">Remove</button></ul>	
			<? endforeach; ?>
		</ul>
			<h3>Do you need to add a task to your TODO list?<br>Simply type your task in box below and click ADD task:</h3>
	        <form method="POST" action="todo_insert.php">
	            <p>	
	             	<label for="add_task">Add item to TODO list:</label>
	             	<input id="add_task" name="add_task" type="text"placeholder="type task here">	            
	            </p> 
	            <p>
	             	<input type="submit">
	            </p>  
			</form>	
		<!-- <h3>Upload File</h3>
			<form method="POST" enctype="multipart/form-data" action="/todo_list.php">
			    <p>
			        <label for="file1">File to upload: </label>
			        <input type="file" id="file1" name="file1">
			    </p>
			    <p>
			        <input type="submit" value="Upload"> 
			    </p>
			</form> -->

			<form id="remove-form" action="todo_insert.php" method="post">
			    <input id="remove-id" type="hidden" name="remove" value="">
			</form>

			<script>

			$('.btn-remove').click(function () {
			    var todoId = $(this).data('todo');
			    if (confirm('Are you sure you want to remove item ' + todoId + '?')) {
			        $('#remove-id').val(todoId);
			        $('#remove-form').submit();
			    }
			});

			</script>
	</body>
</html>

