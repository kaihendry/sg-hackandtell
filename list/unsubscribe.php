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

if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$email = $_POST["email"];
	$id=subscribe($email);
	echo "<h3>Thank you for subscribing $email !</h3>";
}

if (empty($id)) {
	$id = $_GET["id"];
}

?>
<form action="/list/subscribe.php" method=post>
<label for="why">Reason why?</label>
<input id=why name=why placeholder="Any reason why?" value="<?= $_GET["why"] ?>"/>
<input name=id type=hidden value=<?= $id ?>>
<input name=submit type=submit value="Unsubscribe"/>
</form>
<?php
include ("reminder.html");
?>
<small><a href="https://github.com/kaihendry/sg-hackandtell">MIT source</a></small>
</body>
</html>
