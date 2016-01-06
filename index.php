<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title> GuestBook - Index </title>
</head>
<body>
<h1>It works!</h1>
<?php
	//DB Connection
	mysql_connect("localhost", "root", "password");
	mysql_select_db("phpmyadmin");
	
	//----------------Form------------------------
	echo "<h2>Post to the Guestbook</h2>"
	
	if ($_POST['postbtn']){
		$name = strip_tags ($_POST['name']);
		$email = strip_tags ($_POST['email']);
		$message = strip_tags ($_POST['message']);
		
		if ($name && $email && $message){
		
			$time = date("h:i A");
			$date = date("F d, Y");
			$ip = $_SERVER['REMOTE_ADDR'];
			
			//==add to DB==
			mysql_query("INSERT INTO guestbook VALUES ('', '$name', '$email', '$message','$time', '$date', '$ip')");
			echo "Your post has been added.";
		
		}
	}
	//-----------------Display--------------------
	$query = mysql_query("SELECT * FROM guestbook ORDER BY id DESC");
	$numrows = mysql_num_rows($query);
	
	if ($numrows > 0){
		echo "<hr />";
		while ( $row = mysql_fetch_assoc($query) ){
			$id = $row['id'];
			$name = $row['name'];
			$email = $row['email'];
			$message = $row['message'];
			$time = $row['time'];
			$date = $row['date'];
			$ip = $row['ip'];
			
			$message = nl2br($message);
			
			echo "<div>
				By <b>$name</b> at <b>$time</b> on <b>$date</b><br />
				$message
				
			</div> <hr />";
		
	
	
		}
	
	
	
	}
	else
		echo "No Posts were found.";
	
	
	//----------------------------------------
	
	mysql_close();
	?>
	<h1>It works!</h1>
</body>
</html>