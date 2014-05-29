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
				$task = ['Laundry','Sweep floors','Clean bathrooms','Wash car','Dust the furniture'];
				foreach ($task as $item){
					echo "<li>$item</li>";				
				}
				?>

		</ul>
			<h3>Do you need to add a task to your TODO list?<br>Simply type your task in box below and click ADD task:</h3>
	        <form method="POST" action="/process-form1.php">
	            <p>
	              <label for="add_item">Add item to TODO list:</label>
	              <input id="add_task" name="add_task" type="text"placeholder="type task here">
	            </p> 
	            <p>
	              <input type="submit" value="ADD task">
	            </p>  
			</form>

	</body>
</html>