<?php
	define("TITLE", "Post a New Topic");
	include("includes/header.php");

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject']) && isset($_POST['body']) && isset($_POST['cat'])) {
		//get user id
		$query = "SELECT id FROM users WHERE username = ?";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $u);
		$stmt->execute();
		$result = $stmt->get_result();
		$author = $result->fetch_assoc();

		//post
		$query = "INSERT INTO topics (title, body, author, category) VALUES (?, ?, ?, ?)";
		$stmt = $dbc->prepare($query);
		$sanitized_subject = ($_POST['subject']);
		$sanitized_body = ($_POST['body']);
		$stmt->bind_param("ssss", $sanitized_subject, $sanitized_body, $author['id'], $_POST['cat']);
		$stmt->execute();
		$result = $stmt->get_result();
		print "		<p>Topic posted. Click <a href=\"topic.php?id={$stmt->insert_id}\">here</a> to view it.</p>\n";
	}

	else {
		if (!isset($_GET['cat'])) 
			print "		<p>Invalid category specified.</p>\n";
		elseif (!isset($u) || !isLoggedin($u,$dbc))
			print "		<p>You must be logged in to create a topic.</p>\n";
		else {
?>
		<form action="post.php" method="post" enctype="multipart/form-data">
			<p><input name="subject" type="text" placeholder="Subject"></p>
			<p><textarea name="body" cols="30" rows="5"></textarea></p>
			<p><input name="" type="submit"></p>
			<input name="cat" type="hidden" value="<?=$_GET['cat']?>">
		</form>
<?php
		}
	}

	include("includes/footer.php");
?>
