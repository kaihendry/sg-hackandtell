<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>foo really simple email list</title>
<style>
<?php
include("../style.css");
?>
</style>
</head>
<body>
<?php
include("list-funcs.php");
if (isset($_POST['id'])) {
	$email=unsubscribe($_POST['id']);
	echo "<h3>We are sorry to see you go $email !</h3>";
}
?>
<form action="/list/unsubscribe.php" method=post>
<input required=required type=email name=email title="We will never sell or distribute your email address" placeholder="Your email address" value="<?= $email ?>"/>
<input name=submit type=submit value="Subscribe"/>
</form>
<?php
include ("reminder.html");
?>
<small><a href="https://github.com/kaihendry/sg-hackandtell">MIT source</a></small>
</body>
</html>
