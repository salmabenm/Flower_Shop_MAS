<!DOCTYPE html>
<html>
<head>
	<title>Comments Section</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		.container {
			margin: 50px auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0,0,0,0.3);
			max-width: 600px;
		}

		h1 {
			text-align: center;
			margin-bottom: 30px;
		}

		form {
			display: flex;
			flex-direction: column;
		}

		label {
			font-size: 20px;
			margin-bottom: 10px;
		}

		input[type="text"], textarea {
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			box-shadow: 0 0 5px rgba(0,0,0,0.3);
		}

		textarea {
			height: 150px;
			resize: none;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px;
			border-radius: 5px;
			cursor: pointer;
			font-size: 20px;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		.comment {
			margin-bottom: 20px;
			padding: 10px;
			background-color: #eee;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0,0,0,0.3);
		}

		.comment h3 {
			margin: 0 0 10px 0;
			font-size: 18px;
		}

		.comment p {
			margin: 0;
			font-size: 16px;
			line-height: 1.5;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Comments Section</h1>
		<form action="process_comment.php" method="post">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>

			<label for="comment">Comment:</label>
			<textarea id="comment" name="comment" required></textarea>

			<label for="html">HTML:</label>
			<textarea id="html" name="html"></textarea>

			<label for="css">CSS:</label>
			<textarea id="css" name="css"></textarea>

			<label for="php">PHP:</label>
			<textarea id="php" name="php"></textarea>

			<input type="submit" value="Submit Comment">
		</form>

		
