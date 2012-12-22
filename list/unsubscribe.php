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
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$id=subscribe($email);
	echo "<h3 class=sub>Thank you for subscribing $email !</h3>";
} else { die("<h1 class=un>Invalid email</h1>"); }

if (empty($id)) {
	if (valid_id($_GET["id"])) {
	$id = $_GET["id"];
	} else {
		die("<h1 class=un>Invalid ID</h1>");
	}
}

?>
<form action="/list/subscribe.php" method=post>
<label for="why">Reason why?</label>
<input id=why name=why placeholder="Any reason why?" value="<?= htmlspecialchars($_GET[why], ENT_QUOTES, 'UTF-8'); ?>"/>
<input name=id type=hidden value=<?= $id ?>>
<input name=submit type=submit value="1-click Unsubscribe"/>
</form>
<?php
include ("reminder.html");
?>
</body>
</html>
