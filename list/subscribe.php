<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>really simple email list</title>
<style>
<?php
include("../style.css");
?>
</style>
</head>
<body>
<?php
include("list-funcs.php");

// Allow GET for List-Unsubscribe: direct unsubscribes http://news.ycombinator.com/item?id=4930107
if ($_REQUEST['id']) {
if (valid_id($_REQUEST['id'])) {
	$email=unsubscribe($_REQUEST['id']);
	echo "<h3 class=un>$email you have been unsubscribed!</h3>";
} else { die("<h1 class=un>Invalid unsubscription ID</h1>"); }
}

?>
<form action="/list/unsubscribe.php" method=post>
<label for="email">Email address</label>
<input id=email required type=email name=email title="We will never sell or distribute your email address" placeholder="Your email address" value="<?= $email ?>"/>
<input name=submit type=submit value="Subscribe"/>
</form>
<?php
include ("reminder.html");
?>
</body>
</html>
